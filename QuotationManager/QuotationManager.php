<?php

/*
    Copyright License GPL
    Written by Pieter Hoekstra, pieterhoekstra@gmail.com, july 2020
*/

namespace QuotationManager;

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class QuotationManager{

    private $settings;


    public function __construct(){

        add_action( 'init', array( $this, 'register_post_type' )); 

        add_action( 'admin_menu', array( $this, 'add_quotations_menu_bubble' ));

        add_action( 'admin_notices', array( $this, 'add_admin_notice' ));
 
        $options = array(
            QUOTATION_MANAGER_POST_TYPE => array(
                __( "General", QUOTATION_MANAGER_TEXT_DOMAIN ) => array(
                    "no_auth_needed" => array(
                        "type" => 'checkbox',
                        "default" => '1',
                        "label" => __( 'Anybody can send a quotation request&nbsp;:', QUOTATION_MANAGER_TEXT_DOMAIN ),
                        'help_message' => __( 'Check this option to make quotation requests possible for visitors who are not logged in to WordPress.' )
                    ),
                    /*"email_quotations" => array(
                        "type" => 'text',
                        'label' => __( 'Email address to send quotations to&nbsp;: ', QUOTATION_MANAGER_TEXT_DOMAIN ),
                    )*/
                ),
                __( "Attachments", QUOTATION_MANAGER_TEXT_DOMAIN ) => array(
                    "path_to_attachments" => array(
                        "type" => 'text',
                        "default" => wp_upload_dir()['path'], 
                        "label" => __( 'Path to attachments :', QUOTATION_MANAGER_TEXT_DOMAIN ),
                        'help_message' => sprintf( 
                            __( 'Create a folder and assign write permission to it for system user&nbsp;: %1$s ', QUOTATION_MANAGER_TEXT_DOMAIN ), 
                            get_current_user()
                            ) . "."
                    )
                ),
                __( "Salesforce",  QUOTATION_MANAGER_TEXT_DOMAIN ) => array(
                    "salesforce_url" => array(
                        'type' => 'text',
                        'label' => 'Salesforce URL&nbsp;:'
                    )
                )
            )
        );

        $this->settings = new Settings( $options );

        new Blocks( $this->settings );

        new Quotation( $this->settings );

        //new BulkActions( $this->settings );

        register_activation_hook( __FILE__, array( $this, 'plugin_activate' ));
        
        register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivate' )); 

    }

    public function add_admin_notice( ){


        $msg = get_user_option( 'admin-notice' );
        update_user_option( get_current_user_id(), 'admin-notice', '');

        if( isset( $msg[ 'info' ]) ){
            // classes: notice-info updated notice-warning
            echo "<div class='notice notice-info qm-notice'>" . $msg[ 'warning' ] . "</div>";
        }
    }

    public function register_post_type(){
        //Labels for post type
        $labels = array(
             'name'               => __( 'Quotations', QUOTATION_MANAGER_TEXT_DOMAIN ),
             'singular_name'      => __( 'Quotations', QUOTATION_MANAGER_TEXT_DOMAIN ),
             'menu_name'          => __( 'Quotations', QUOTATION_MANAGER_TEXT_DOMAIN ),
             'name_admin_bar'     => __( 'Quotations', QUOTATION_MANAGER_TEXT_DOMAIN ),
             'add_new'            => 'New quotation', 
             'add_new_item'       => 'New quotation',
             'new_item'           => 'New quotation', 
             'edit_item'          => 'Edit quotation',
             'view_item'          => 'Activiteit bekijken',
             'all_items'          => 'Alle activiteiten',
             'search_items'       => 'Activiteit zoeken',
             'parent_item_colon'  => 'Activiteit', 
             'not_found'          => 'Niets gevonden.', 
             'not_found_in_trash' => 'Niets gevonden',
         );
         //arguments for post type
         $args = array(
             'labels'            => $labels,
             'capability_type'   => 'post',
             'capabilities'      => array(
                //'create_posts' => 'do_not_allow', 
             ),
             'map_meta_cap'         => true,  
             'public'               => false,
             'publicly_queryable'   => false,
             'exclude_from_search'  => true,
             'show_ui'              => true,
             'show_in_nav'          => true,
             'query_var'            => true,
             'hierarchical'         => false,
             'supports'             => false,
             'register_meta_box_cb' => false,
             'has_archive'          => true,
             'menu_position'        => 40,
             'show_in_menu'         => true,
             //'show_in_admin_bar'    => true,
             //'menu_icon'            => 'dashicons-format-audio',
             'menu_icon'            => "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIgogICB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgeG1sbnM6c29kaXBvZGk9Imh0dHA6Ly9zb2RpcG9kaS5zb3VyY2Vmb3JnZS5uZXQvRFREL3NvZGlwb2RpLTAuZHRkIgogICB4bWxuczppbmtzY2FwZT0iaHR0cDovL3d3dy5pbmtzY2FwZS5vcmcvbmFtZXNwYWNlcy9pbmtzY2FwZSIKICAgc29kaXBvZGk6ZG9jbmFtZT0iYmFsbG9uLnN2ZyIKICAgaW5rc2NhcGU6dmVyc2lvbj0iMS4wICg0MDM1YTRmYjQ5LCAyMDIwLTA1LTAxKSIKICAgaWQ9InN2ZzgiCiAgIHZlcnNpb249IjEuMSIKICAgdmlld0JveD0iMCAwIDE0NC4zODcwNSAxMTkuMjY1NCIKICAgaGVpZ2h0PSIxMTkuMjY1NG1tIgogICB3aWR0aD0iMTQ0LjM4NzA1bW0iPgogIDxkZWZzCiAgICAgaWQ9ImRlZnMyIiAvPgogIDxzb2RpcG9kaTpuYW1lZHZpZXcKICAgICBpbmtzY2FwZTp3aW5kb3ctbWF4aW1pemVkPSIxIgogICAgIGlua3NjYXBlOndpbmRvdy15PSItMTEiCiAgICAgaW5rc2NhcGU6d2luZG93LXg9Ii0xMSIKICAgICBpbmtzY2FwZTp3aW5kb3ctaGVpZ2h0PSIyMDY2IgogICAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iMzg0MCIKICAgICBmaXQtbWFyZ2luLWJvdHRvbT0iMCIKICAgICBmaXQtbWFyZ2luLXJpZ2h0PSIwIgogICAgIGZpdC1tYXJnaW4tbGVmdD0iMCIKICAgICBmaXQtbWFyZ2luLXRvcD0iMCIKICAgICBzaG93Z3JpZD0iZmFsc2UiCiAgICAgaW5rc2NhcGU6ZG9jdW1lbnQtcm90YXRpb249IjAiCiAgICAgaW5rc2NhcGU6Y3VycmVudC1sYXllcj0ibGF5ZXIxIgogICAgIGlua3NjYXBlOmRvY3VtZW50LXVuaXRzPSJtbSIKICAgICBpbmtzY2FwZTpjeT0iMjIwLjg0MzQzIgogICAgIGlua3NjYXBlOmN4PSIzMzcuMTQyNTgiCiAgICAgaW5rc2NhcGU6em9vbT0iMS45Nzk4OTkiCiAgICAgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIKICAgICBpbmtzY2FwZTpwYWdlb3BhY2l0eT0iMC4wIgogICAgIGJvcmRlcm9wYWNpdHk9IjEuMCIKICAgICBib3JkZXJjb2xvcj0iIzY2NjY2NiIKICAgICBwYWdlY29sb3I9IiNmZmZmZmYiCiAgICAgaWQ9ImJhc2UiIC8+CiAgPG1ldGFkYXRhCiAgICAgaWQ9Im1ldGFkYXRhNSI+CiAgICA8cmRmOlJERj4KICAgICAgPGNjOldvcmsKICAgICAgICAgcmRmOmFib3V0PSIiPgogICAgICAgIDxkYzpmb3JtYXQ+aW1hZ2Uvc3ZnK3htbDwvZGM6Zm9ybWF0PgogICAgICAgIDxkYzp0eXBlCiAgICAgICAgICAgcmRmOnJlc291cmNlPSJodHRwOi8vcHVybC5vcmcvZGMvZGNtaXR5cGUvU3RpbGxJbWFnZSIgLz4KICAgICAgICA8ZGM6dGl0bGU+PC9kYzp0aXRsZT4KICAgICAgPC9jYzpXb3JrPgogICAgPC9yZGY6UkRGPgogIDwvbWV0YWRhdGE+CiAgPGcKICAgICB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTYuNjMxMDI2LC04Ni45MzQ3NDUpIgogICAgIGlkPSJsYXllcjEiCiAgICAgaW5rc2NhcGU6Z3JvdXBtb2RlPSJsYXllciIKICAgICBpbmtzY2FwZTpsYWJlbD0iTGFhZyAxIj4KICAgIDxwYXRoCiAgICAgICBzb2RpcG9kaTpub2RldHlwZXM9ImNjY2NjY3NjIgogICAgICAgdHJhbnNmb3JtPSJzY2FsZSgwLjI2NDU4MzMzKSIKICAgICAgIGQ9Ik0gMzM1LjI0NjA5LDMyOC41NzIyNyBDIDE4NC43MzUyNywzMjguNzM1OTggNjIuODU4NjYzLDQwNi4wNzc4IDYyLjg1NzQyMiw1MDEuNDI3NzMgNjMuMTE4ODYzLDY2My45MDE4MiAyNDMuNDM5ODUsNzAxLjA2NTAxIDM2OS4yMTExMSw2NzQuNzgyMDEgYyAwLDAgMTI3Ljc4MzQxLDEwNS41NjA0MSAxNjguNjk0NjEsMTA0LjU1MDI1IDAsMCAtNzIuMjM4MjksLTEzMy4wMjY3MyAtMzguNTk5NjEsLTE0Mi4xNzMyMSA5MS4yNDUyOCwtMjkuNTQ4OTkgMTA5LjI2NjY2LC03MC44MTIwMiAxMDkuMjY2MTYsLTEzNS43MzEzMiAtMTBlLTQsLTk1LjQ2NTc4IC0xMjIuMTYzNTIsLTE3Mi44NTU1NiAtMjcyLjg1NzQzLC0xNzIuODU1NDYgeiIKICAgICAgIHN0eWxlPSJmaWxsOiNlNmU2ZTY7c3Ryb2tlLXdpZHRoOjMuNzc5NTM7c3Ryb2tlLWxpbmVjYXA6cm91bmQiCiAgICAgICBpZD0icGF0aDg0MiIgLz4KICA8L2c+Cjwvc3ZnPgo=",
             //'rewrite'              => true,
             //'show_in_rest'         => true
         );

         //register post type
         register_post_type( QUOTATION_MANAGER_POST_TYPE, $args );

         register_block_type( 'quotation-manager/row', array(
            'editor_script'   => 'inner_blocks-cgb-block-js',
            'editor_style'    => 'inner_blocks-cgb-block-editor-css',
           // 'render_callback' => array( $this, 'inner_blocks_render_content' ),
        ) );
  
     }

     public function inner_blocks_render_content( $attributes, $content ){
         return $content;
     }

     public function add_quotations_menu_bubble(){
         global $menu, $wpdb;

         $results = $wpdb->get_results( 
             "SELECT COUNT(ID) as count FROM " . $wpdb->posts . 
             " WHERE post_type = '" . QUOTATION_MANAGER_POST_TYPE . "' AND post_status = 'draft'" );

         foreach ( $menu as $key => $value ) {

            if ( $menu[$key][0] == __( 'Quotations', QUOTATION_MANAGER_TEXT_DOMAIN )) {

                $menu[$key][2] .= '&post_status=draft';

                if( $results[0]->count > 0)
                    $menu[$key][0] .= " <span class='update-plugins'><span class='update-count'>" . $results[0]->count . "</span></span>";

                return;
            }
        }
     } 

    public function plugin_activate(){  
        $this->register_post_type();
        do_action( 'admin_init' );
        flush_rewrite_rules();
    }

    public function plugin_deactivate(){
        flush_rewrite_rules();
    }

}

?>