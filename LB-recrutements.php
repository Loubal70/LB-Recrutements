<?php

/**
 * @package LB-Recrutements
 * @version 1.0.0
 */
/*
Plugin Name: LB-Recrutements
Plugin URI: https://localhost
Description: Plugin de gestion de l'entreprise Fabrik
Author: Louis Boulanger
Version: 1.0.0
Author URI: https://louis-boulanger.fr
*/

define('PLUGIN_NAME', 'LB-Recrutements');
define('PLUGIN_DEPENDENCIES', 'advanced-custom-fields-pro');

function plugin_init_dependencies() { // Enable plugin if update checker github is enabled

    if ( current_user_can( 'activate_plugins' ) && !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
        add_action( 'admin_init', 'my_plugin_deactivate' );
        add_action( 'admin_notices', 'my_plugin_admin_notice' );

        // Deactivate the Child Plugin
        function my_plugin_deactivate() {
          deactivate_plugins( plugin_basename( __FILE__ ) );
        }

        // Throw an Alert to tell the Admin why it didn't activate
        function my_plugin_admin_notice() {
            
            echo '<div class="error"><p>'
                . '<strong>' . esc_html( PLUGIN_NAME ) . '</strong> a besoin de ' . '<strong>' . esc_html( PLUGIN_DEPENDENCIES ) . '</strong> pour fonctionner' 
                . '</p></div>';

           if ( isset( $_GET['activate'] ) )
                unset( $_GET['activate'] );
        }

    }
}

add_action( 'admin_init', 'plugin_init_dependencies' );

require_once  plugin_dir_path(__FILE__) . 'lib/acf.php';