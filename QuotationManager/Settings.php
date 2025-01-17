<?php

/*
    Copyright License GPL
    Written by Pieter Hoekstra, pieterhoekstra@gmail.com, july 2020
*/

namespace QuotationManager;

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class Settings{

    // The menu-slug
    private $page = null;

    // The parent menu-slug
    private $underneath = null;

    // The options as defined by the constructor
    // Example: 
    /*array(
            "edit.php" => array(
                __( "Attachments", QUOTATION_MANAGER_TEXT_DOMAIN ) => array(
                    "path_to_attachments" => array(
                        "type" => 'text',
                        "default" => ABSPATH,
                        "label" => __( 'Path to attachments : ', QUOTATION_MANAGER_TEXT_DOMAIN )
                        'help_message' => __( 'Create a folder and assign write permission to it for system user : ', QUOTATION_MANAGER_TEXT_DOMAIN ) . get_current_user() . "."
                    )
                ),
                __( "Salesforce", QUOTATION_MANAGER_TEXT_DOMAIN ) => array(
                    "salesforce_url" => array(
                        'type' => 'text',
                        'label' => 'Salesforce URL :'
                    )
                )
            )
        );*/
    private $options_setting = null;

    // The current options
    private $options;

    // The root id of all options
    // Use get_option( options_root )[ option1 ]
    // to get the value of the option with name = option1
    private $options_root = QUOTATION_MANAGER_TEXT_DOMAIN;

    private $fieldsHad = array();

    public function __construct( $options, $page = null, $subUnderneath = null ){

        $this->options_setting = $options;

        $this->page = $page ? $page : QUOTATION_MANAGER_POST_TYPE;
        
        $this->underneath = $subUnderneath;
        
        add_action( 'admin_init', array( $this, 'page_init' ));

        add_action( 'admin_menu', array( $this, 'register_settings_page' ));

        add_action( 'admin_enqueue_scripts', array( $this, 'backend_scripts' )); 

        add_filter( 'plugin_action_links_' . QUOTATION_MANAGER_TEXT_DOMAIN . '/' . QUOTATION_MANAGER_TEXT_DOMAIN . '.php', array( $this, 'add_links_to_listed_plugin' ));

    }

    /*
        Always check with this function if NULL is returned for a 
        setting like ::get_option()['option1'] for options which
        dont't have a default value and wich aren't saved with the form.
        Checkbox settings get value '0' or '1'
    */
    public function get_option( $root = null ){

        if( empty( $root ) ) $root = QUOTATION_MANAGER_TEXT_DOMAIN;

        $saved = get_option( $root );

        $defaults = $this->get_options_setting_defaults( $this->page );
        $ret = array();

        // Iterate over the defaults to get a default setting if needed
        foreach( $defaults as $key => $value ){
            if( ! empty( $saved[ $key ] ) )
                $ret[ $key ] = $saved[ $key ];
            else if( isset( $defaults[ $key ] ))
                $ret[ $key ] = $defaults[ $key ];
        }

        // Add the options which are saved but don't have a default
        foreach( $saved as $key => $value ){
            if( isset( $saved[ $key ] ) && ! isset( $ret[ $key ]) )
                $ret[ $key ] = $value;
        }

        return $ret;
    }

    public function backend_scripts( $pageHook ){
        if( $pageHook == "toplevel_page_" . QUOTATION_MANAGER_POST_TYPE ){
            wp_enqueue_style( 'admin_css', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . '/css/settings.css' );

            wp_enqueue_script( 'settings', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . '/js/settingsPage.js', array( 'jquery' )  );
        }
    }

    public function register_settings_page(){

        if( $this->user_has_rights() ){
            $callable = array( $this, 'render_settings_page' );

            // Make a menu item at bottom with the gear icon
            if( $this->underneath == null && $this->page == QUOTATION_MANAGER_POST_TYPE ){
                add_menu_page( 
                    __( 'Quotation Manager', QUOTATION_MANAGER_TEXT_DOMAIN ), 
                    __( 'Quotation Manager', QUOTATION_MANAGER_TEXT_DOMAIN ), 
                    'manage_options', 
                    $this->page,
                    $callable,
                    'dashicons-admin-generic'
                );
            }
    
            // Make a menu item within Wordpress Settings menu
            else if( $this->underneath == null)
                add_options_page( 
                    __( 'Quotation Manager', QUOTATION_MANAGER_TEXT_DOMAIN ), 
                    __( 'Quotation Manager', QUOTATION_MANAGER_TEXT_DOMAIN ), 
                    'manage_options', 
                    $this->page, 
                    $callable
                );
    
            // Make a page underneath the custom post type menu item
            // ( show_in_menu should be set with register_QUOTATION_MANAGER_POST_TYPE() 
            // and $this->page can only be set to 'edit.php' and when
            // following the link this results in expansion of the 
            // Posts admin menu )
            else
                add_submenu_page(
                    $this->underneath,
                    __( 'Settings', QUOTATION_MANAGER_TEXT_DOMAIN ),
                    __( 'Settings', QUOTATION_MANAGER_TEXT_DOMAIN ),
                    'manage_options',
                    $this->page,
                    $callable
                );
        }
    }

    public function sanitize( $input )
    {
        foreach( $input as $key => $value ){
            $optionArray = $this->get_option_from_options_settings( $this->page, $key );
            if( $optionArray ) {
                $input[ $key ] = esc_attr( $value );
            }
        }

        return $input;
    }

    public function page_init(){
        if( $this->user_has_rights() ){

            register_setting(
                'qm_options', 
                $this->options_root, 
                array(
                    "sanitize_callback" => array( $this, 'sanitize' ),
                    'default' => $this->get_options_setting_defaults( $this->page )
                )
            );

            $options_settings = $this->options_setting[ $this->page ];
            $sections = $this->get_all_sections_options_setting( $this->page );
    
            foreach( $sections as $section => $sectionValue){
                
                add_settings_section(
                    $section, 
                    $section, 
                    array( $this, 'print_section_info' ), 
                    $section . '_admin_' . QUOTATION_MANAGER_TEXT_DOMAIN 
                );  

                foreach( $sectionValue as $key => $value ){
                    add_settings_field(
                        $key, 
                        $value[ 'label' ],  
                        array( $this, 'input_callback' ), 
                        $section . '_admin_' . QUOTATION_MANAGER_TEXT_DOMAIN, 
                        $section 
                    ); 
                }
            }
        }
    }

    public function print_section_info(){
        //echo __( 'Settings : ', QUOTATION_MANAGER_TEXT_DOMAIN );
    }

    public function input_callback( ){

        $options = $this->get_all_sections_options_setting( $this->page );

        foreach( $options as $section => $sectionDef ){
            foreach( $sectionDef as $key => $value ){
                if( ! in_array( $key, $this->fieldsHad )){
                    if( $value[ 'type' ] == 'text')
                        printf(
                            '<input type="text" class="regular-text" name="' . $this->options_root . '[' . $key . ']" value="%s" />',
                            ! empty( $this->options[ $key ] ) ? esc_attr( $this->options[ $key ]) : '' 
                        );
                    else if( $value['type'] == 'select' ){
                        $options = '';
                        foreach( $value['options'] as $option => $translated )
                            $options .= '<option value="'. $option . '" ' . ($this->options[$key] == $option ? 'selected' : '') . '>'. $translated . '</option>';
                        printf(
                            '<select name="' . $this->options_root . '[' . $key . ']' . '">%s</select>',
                            $options
                        );
                    }
                    else if( $value[ 'type' ] == 'checkbox')
                        printf(
                            '<input type="checkbox" class="regular-text" name="' . $this->options_root . '[' . $key . ']" %s value="%s"/>',
                            ! empty( $this->options[ $key ] ) ? ( $this->options[ $key ] === '1'? 'checked' : '') : '',
                            ! empty( $this->options[ $key ] ) ? ( $this->options[ $key ] === '1'? '1' : '0') : '0'
                        );
                    if( !empty( $value[ 'help_message' ]) )
                        echo "<p><i>" . $value[ 'help_message' ] . "</i></p>";

                    array_push( $this->fieldsHad, $key);

                    break 2;
                }
            }
        }
    }

    public function render_settings_page(){
        $this->options = $this->get_option( $this->options_root );

        include( QUOTATION_MANAGER_DIR . "/templates/admin-settings.php" );
    }

    public function add_links_to_listed_plugin( $links ){
        if( $this->user_has_rights() ){
            array_push( $links, $this->build_settings_link() );
        }
        return $links;
    }

    private function user_has_rights(){
        return user_can( get_current_user_id(), 'manage_options' );
    }

    private function get_all_sections_options_setting( $page ){
        $sections = array();
        foreach( $this->options_setting as $key => $value ){
            if( $key == $page ){
                foreach( $value as $var => $def){
                    $sections[ $var ] = $def;
                }
            }
        }
        return $sections;
    }

    private function get_all_sections( $page ){
        $sections = array();
        foreach( $this->options_setting as $key => $value ){
            if( $key == $page ){
                foreach( $value as $var => $def ){
                    array_push( $sections, $var );
                }
            }
        }
        return $sections;
    }

    private function get_option_from_options_settings( $page, $option ){
        foreach( $this->get_all_sections_options_setting( $page ) as $key => $value ){
            foreach( $value as $k => $v ){
                if( $k == $option )
                    return $v;
            }
        }
    }

    private function get_options_setting_defaults( $page ){

        $defaults = array();
        foreach( $this->get_all_sections_options_setting( $page ) as $key => $value ){
            foreach( $value as $k => $v ){
                if( isset( $v[ 'default' ] ))
                    $defaults[ $k ] = $v[ 'default' ];
            }
        }
        return $defaults;
    }
    
    private function build_settings_link(){
        if( $this->underneath )
            $wp_page = $this->underneath;
        else if( $this->page && $this->page != QUOTATION_MANAGER_TEXT_DOMAIN )
            $wp_page = 'options-general.php?';
        else
            $wp_page = 'admin.php?';

        if( $this->page )
            $page = $this->page;
        else if( $this->underneath == null)
            $page = QUOTATION_MANAGER_POST_TYPE;

        $lnk = '<a href="' . get_admin_url() . $wp_page . '&page=' . $page . '">' . __( 'Settings', QUOTATION_MANAGER_TEXT_DOMAIN ) . '</a>';

        return $lnk;
    }
}
?>