<?php

/*
    Copyright License GPL
    Written by Pieter Hoekstra, pieterhoekstra@gmail.com, july 2020
*/

namespace QuotationManager;

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class BulkActions{

    private $settings;

    function __construct( $settings ){

        $this->settings = $settings;

        add_filter( 'bulk_actions-edit-' . QUOTATION_MANAGER_POST_TYPE, array( $this, 'register_bulk_actions' ) );

        add_filter( 'handle_bulk_actions-edit-' . QUOTATION_MANAGER_POST_TYPE, array( $this, 'bulk_action_handler' ), 10, 3 );

        add_action( 'quick_edit_custom_box', array( $this, 'quick_edit_add'), 10, 2 );

        add_action( 'save_post', array( $this, 'save_quick_edit_data' ));

        add_action( 'admin_enqueue_scripts', array( $this,'enqueue_admin_scripts' )); 

    }

    public function enqueue_admin_scripts( $pageHook ){
        if( $pageHook == 'edit.php')
           ;// wp_enqueue_script( 'populatequickedit', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . '/js/inlineEdit.js' );
    }

    public function quick_edit_add( $column_name, $post_type ){
        if( $column_name == 'price' && $post_type == QUOTATION_MANAGER_POST_TYPE ){
            echo  "<fieldset class='inline-edit-col-left'><div class='inline-edit-col'><div class='inline-edit-group wp-clearfix'>" . 
            "<label class='inline-edit-status alignleft'><span class='title'>" . __('Price', QUOTATION_MANAGER_TEXT_DOMAIN) . 
            "</span> <input type='text' name='price'></div></div></fieldset>";
        }
     }

     public function save_quick_edit_data( $post_id ){

        if( isset( $_POST['QUOTATION_MANAGER_POST_TYPE'] )){
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }
        
            if ( ! current_user_can( 'edit_post', $post_id ) || QUOTATION_MANAGER_POST_TYPE != $_POST['QUOTATION_MANAGER_POST_TYPE'] ) {
                return $post_id;
            }
        
            $price = sanitize_post_meta( $_POST['price'] );
            update_post_meta( $post_id, 'price',  $price );
        }
     }

     public function register_bulk_actions( $actions ){

        $actions[ 'export_to_salesforce' ] = __( 'Export to Salesforce', QUOTATION_MANAGER_TEXT_DOMAIN );

        // Detect Woocommerce installed and activated
        // ...
        $actions[ 'make_shop_product' ] = __( 'Make Shop Product', QUOTATION_MANAGER_TEXT_DOMAIN );

        $actions[ 'download_csv' ] = __( 'Download as CSV', QUOTATION_MANAGER_TEXT_DOMAIN );

        return $actions;
    }

    public function bulk_action_handler( $redirect_to, $doaction, $post_ids ){
        if( $doaction == 'export_to_salesforce' ){
            $salesUrl = $this->settings->get_option()[ 'salesforce_url' ];
            if( ! $salesUrl || empty( $salesUrl ) ){
                update_user_option( get_current_user_id(), 'admin-notice', array( "info" => __( "Please provide a URL to Salesforce.", QUOTATION_MANAGER_TEXT_DOMAIN )));
            }
        }
        else if( $doaction == 'make_shop_product'){

        }
        else if( $doaction == 'download_csv'){

        }

        $status = sanitize_key( $_GET['post_status'] );
        wp_redirect( admin_url( 'edit.php?post_type=' . QUOTATION_MANAGER_POST_TYPE . '&post_status=' . $status )); 

    }
}

?>