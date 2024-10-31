<?php

/*
    Copyright License GPL
    Written by Pieter Hoekstra, pieterhoekstra@gmail.com, july 2020
*/

namespace QuotationManager;

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class Quotation{

    private $columns = array();

    private $settings = null;

    function __construct( $settings ){

        $this->settings = $settings;

        $no_auth = $settings->get_option()['no_auth_needed'];
        if( $no_auth && $no_auth === '1')
            add_action( 'admin_post_nopriv_save_quotation', array( $this, 'saveQuotation') );

        add_action( 'admin_post_save_quotation', array( $this, 'saveQuotation') );

        add_action( 'admin_post_edit_quotation', array( $this, 'editQuotation'));

        add_action( 'parse_request', array( $this, 'getUploadedFile') );

        add_action( 'edit_post_' . QUOTATION_MANAGER_POST_TYPE , array( $this, 'editQuotation') );

//        add_action( 'edit_form_after_title', array( $this, 'qm_template') );

        add_action( 'edit_form_after_title', array( $this, 'qm_template') );

        add_action( 'admin_menu', array( $this, 'remove_meta_boxes') );

        add_filter( 'manage_' . QUOTATION_MANAGER_POST_TYPE . '_posts_columns', array( $this, 'add_columns'));

        add_action( 'manage_' . QUOTATION_MANAGER_POST_TYPE . '_posts_custom_column' , array( $this, 'custom_column_value'), 10, 2 );

        add_action( 'manage_edit-' . QUOTATION_MANAGER_POST_TYPE . '_sortable_columns', array( $this, 'sortable_columns') );

        add_action( 'pre_get_posts', array( $this, 'sort_by_column' ));


        //add_filter( 'screen_settings', array( $this, 'addGroupColumnsSettingsScreen') );

        //add_action( 'manage_posts_extra_tablenav', array( $this, 'showGroupColumns') );

    }


    public function showGroupColumns( $var ){

        if( $var == 'top'){

            $screen = get_current_screen();
            //var_dump( get_user_option( "manage" . $screen->id . "columnshidden" ) );
            update_user_option( get_current_user_id(), "manage" . $screen->id . "columnshidden", array( "price" ) );

            $hidden  = get_hidden_columns( get_current_screen() );
            $columns = get_column_headers( get_current_screen() );

            array_push( $hidden, "title");

            unset( $columns[ 'cb' ] );
            unset( $columns[ 'title' ] );
            unset( $columns[ 'date' ] );

            foreach( $columns as $col => $label){
                if( ! in_array( $col, $hidden ) )
                    echo $col . " ";
            }
        }
    }

    public function qm_template( $var ){
        if( $var->post_type == QUOTATION_MANAGER_POST_TYPE )
            include( QUOTATION_MANAGER_DIR . "/templates/admin-qm_quotation.php" );
    }

    public function remove_meta_boxes(){
        remove_meta_box( "slugdiv", QUOTATION_MANAGER_POST_TYPE, "default" );
        remove_meta_box( "submitdiv", QUOTATION_MANAGER_POST_TYPE, "side" );
    }

    public function add_columns( $columns ){

        $metas = $this->get_latest_post_metas();

        foreach( $metas as $key => $value)
            if( ! preg_match("/^_/", $key))
                if( $key == 'price')
                    $columns[ $key ] = __( 'Price', QUOTATION_MANAGER_TEXT_DOMAIN );
                else if( $key == 'formName')
                    $columns[ $key ] = __( 'FormName', QUOTATION_MANAGER_TEXT_DOMAIN );
                else
                    $columns[ $key ] = ucfirst( $key );

        $this->columns = $columns;

        return $columns;
     }

     public function custom_column_value( $column, $post_id ){
        array_push( $this->columns, $column );
        echo get_post_meta( $post_id, $column, true );
     }

     public function sortable_columns( $columns ){
        $columns[ 'formName' ] = __( 'FormName', QUOTATION_MANAGER_TEXT_DOMAIN );
        $columns[ 'price' ] = __( 'Price',  QUOTATION_MANAGER_TEXT_DOMAIN );
        return $columns;
     }

     public function sort_by_column( $query ){
        $orderby = $query->get( 'orderby' );

        //if ( 'formName' == $orderby ) {

            $meta_query = array(
                'relation' => 'OR',
                array(
                    'key' => $orderby,
                    'compare' => 'NOT EXISTS', // see note above
                ),
                array(
                    'key' => $orderby,
                ),
            );

            $query->set( 'meta_query', $meta_query );
            $query->set( 'orderby', 'meta_value' );
        //}
    }

    public function editQuotation(){

        $title = sanitize_textarea_field( $_POST[ '_postTitle' ] );

        $id = sanitize_text_field( $_POST[ 'post_ID' ] );
        
        if( !empty( $title ))
            wp_update_post( array( 'ID' => $id, 'post_title' => $title . '_title' ) );
        
        $metas = get_post_meta( $id );

        foreach( $metas as $key => $value ){

            if( isset( $_POST[ $key ]) ){
                $content = sanitize_textarea_field( $_POST[ $key ] );
                if( !empty( $content ))
                    update_post_meta( $id, $key, $content);
            }
        }
        
    }

    public function getUploadedFile(){
        if( is_user_logged_in() && isset( $_GET[ 'getUploadedFile' ])){
            $path = $this->settings->get_option()[ 'path_to_attachments' ];
            if( ! preg_match("/\//", $_GET[ 'file' ])){
                
                if( preg_match('/[.]php$/', $_GET['file'])) 
                    die();

                $file = $_GET[ 'file' ];
                $pInfo = pathinfo( $path . '/' . $file  );
                $ext = strtolower($pInfo['extension']);
                switch( $ext ){
                    case 'png':
                        header ('Content-Type: image/png');
                        echo file_get_contents( $path . '/' . $file );
                    break;
                    case 'jpg':
                    case 'jpeg':
                        header ('Content-Type: image/jpeg');
                        echo file_get_contents( $path . '/' . $file );
                    break;
                    case 'pdf':
                        header("Content-type:application/pdf");
                        header('Content-disposition: inline; filename="' . $file . '"');
                        echo file_get_contents( $path . '/' . $file );
                    break;
                }
                die();
            }
        }
    }

    public function saveQuotation(){

        global $wpdb;

        $post_id = wp_insert_post( 
            array( 
                'post_type' => QUOTATION_MANAGER_POST_TYPE, 
                'post_title' => date( 'Y-m-d H:i:s' ), 
                'post_content' => '' 
                ) 
            );

        unset( $_POST['action'] );

        $_POST[ 'price' ] = '';

        if( wp_verify_nonce( $_POST[ 'nonce' ], QUOTATION_MANAGER_NONCE ) ){

            $inpAr = $_POST;
            if( count( $inpAr ) < 1000){
                foreach( $inpAr as $name => $value){

                    if( preg_match( '/[_]textarea[_]input\d*$/', $name) ){
                        $value = sanitize_textarea_field( $value );
                        add_post_meta( $post_id, $name, sanitize_meta( $name, $value, 'post' ));
                    }
                    else if( preg_match( '/[_]select[_]input\d*$/', $name ) ){
                        $value = sanitize_text_field( $value );
                        $ar = array();
                        if( isset( $_POST[ $name ][0])){
    
                            foreach( $_POST[ $name ] as $key => $value)
                                array_push( $ar, sanitize_text_field( $value ));
                        }
                        else{
                            $ar[] = sanitize_text_field( $_POST[ $name ] );
                        }
                        add_post_meta( $post_id, $name, implode( '|', $ar ));
                    }
                    else if( preg_match( '/[_]file[_]input\d*$/', $name )){

                    }
                    else{
                        $value = sanitize_text_field( $value );
                        add_post_meta( $post_id, $name, $value );
                    }
                }

                if( count( $_FILES) > 0 ){
                    $path = $this->settings->get_option()[ 'path_to_attachments' ];
                    $allowed = array( 'pdf', 'png', 'jpg', 'jpeg' );
                    $names = '';

                    foreach( $_FILES as $name => $fields ){
                        foreach( $fields['name'] as $key => $value){
                            $ext = strtolower( array_pop( explode( ".", $value )));
                            $fileName = uniqid('', false) . "." . $ext;
                            $tmp_name = $fields[ 'tmp_name' ][ $key ];
                            if( in_array( $ext, $allowed )){
                                move_uploaded_file( $tmp_name, "$path/$fileName");
                                $names .= $fileName . '/' . $fields[ 'name' ][ $key ] . '|';
                            }
                        }
                        add_post_meta( $post_id, $name, $names );
                        $names = '';
                    }
                }
            }

        }

        wp_redirect( site_url('/') ); 

        die;
    }

    private function get_latest_post_metas(){
        global $wpdb;

        return array( 'formName' => '', 'price' => '');

        /*$results = $wpdb->get_results( "SELECT ID FROM " . $wpdb->posts . " posts LEFT JOIN " . 
            $wpdb->postmeta . " meta ON meta.post_id = posts.ID " .
            " WHERE posts.post_type = '" . QUOTATION_MANAGER_POST_TYPE . "' AND meta.meta_key = 'uniqueID' ORDER BY post_date desc LIMIT 0,1" );

        $model = $results[0]->ID;

        return get_post_meta( $model );*/
    }
}

?>