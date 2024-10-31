<?php

/*
    Copyright License GPL
    Written by Pieter Hoekstra, pieterhoekstra@gmail.com, july 2020
*/

namespace QuotationManager;

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class Blocks{

    public function __construct( $settings ){

        $this->settings = $settings;

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ));

        add_action( 'admin_enqueue_scripts', array( $this,'enqueue_admin_scripts' )); 

        add_action( 'plugins_loaded', array( $this, 'quotationManager_blocks_loader' ) );
    }

    public function enqueue_frontend_scripts(){

        wp_enqueue_style( 'frontEndAll', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . '/css/frontEndAll.css');

        wp_enqueue_script( 'frontEnd', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . 'js/frontEnd.js' );

        wp_enqueue_script( 'html5Polyfill', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . 'js/html5Polyfill.js' );

        wp_enqueue_script( 'cloneNodeRow', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . 'js/mainFrontend.js' );

        $nonce = wp_create_nonce( QUOTATION_MANAGER_NONCE );

        wp_localize_script( 'frontEnd', 'nonce', $nonce );

    }

    public function enqueue_admin_scripts( $pageHook ){

        wp_enqueue_style( 'admin_css', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . '/css/admin.css' );

        wp_enqueue_style( 'frontend_css', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . '/css/frontEndAll.css' );

        $required_js_files = array(
            'wp-blocks',
            'wp-i18n',
            'wp-element',
            'wp-editor'
        );


        if( $pageHook == 'post.php' ||
            $pageHook == 'post-new.php'){
            //wp_enqueue_script( 'quotation-manager-register-blocks', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . 'js/main.js' );

            wp_enqueue_script( 'quotation-manager-register-blocks', plugin_dir_url( QUOTATION_MANAGER__PLUGIN_FILE ) . '/js/mainAdmin.js', $required_js_files );

            $urls = array( 'admin_url' => admin_url( 'admin-post.php' ) );
    
            wp_localize_script( 'quotation-manager-register-blocks', 'urls', $urls );
    
            wp_set_script_translations( 'quotation-manager-register-blocks', QUOTATION_MANAGER_TEXT_DOMAIN );
        }
    }

    public function quotationManager_blocks_loader(){

        add_filter( 'block_categories', array($this, 'add_custom_block_category') );
        
        load_plugin_textdomain( QUOTATION_MANAGER_TEXT_DOMAIN, false, dirname( plugin_basename( QUOTATION_MANAGER__PLUGIN_FILE ) ) . '/languages/' );
    }

    /**
     * Adds the Quotation Manager block category.
     *
     * @param array $categories Existing block categories.
     *
     * @return array Updated block categories.
     */
    public function add_custom_block_category( $categories ) {
        
        return array_merge(
            $categories,
            array(
                array(
                    'slug'  => 'quotation-manager',
                    'title' => __('Quotation Manager', QUOTATION_MANAGER_TEXT_DOMAIN)
                ),
            )
        );
    }
}
?>