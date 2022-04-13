<?php

/**
 * @package LB-Recrutements
 * @version 1.0.0
 */
/*
Plugin Name: LB-Recrutements
Plugin URI: https://github.com/Loubal70/LB-Recrutements
Description: Plugin de gestion de recrutements
Author: Louis Boulanger
Version: 1.0.0
Author URI: https://louis-boulanger.fr
*/

define('PLUGIN_NAME', 'LB-Recrutements');
define('PLUGIN_DEPENDENCIES', 'advanced-custom-fields-pro');

require_once  plugin_dir_path(__FILE__) . 'lib/acf.php';

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

    // Add GROUP FIELDS
    if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_61e2b1b32d344',
            'title' => 'Recrutements',
            'fields' => array(
                array(
                    'key' => 'field_61e2b21533ea6',
                    'label' => 'Type de poste',
                    'name' => 'type_de_poste',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'CDI' => 'CDI',
                        'CDD' => 'CDD',
                        'STAGE' => 'Stage',
                        'ALTERNANCE' => 'Alternance',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'default_value' => 'CDI',
                    'layout' => 'horizontal',
                    'return_format' => 'label',
                    'save_other_choice' => 0,
                ),
                array(
                    'key' => 'field_61e2b30f5d046',
                    'label' => 'Temps de travail',
                    'name' => 'temps_de_travail',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'tps_plein' => 'Temps plein',
                        'tps_partiel' => 'Temps partiel',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'default_value' => 'tps_plein',
                    'layout' => 'horizontal',
                    'return_format' => 'label',
                    'save_other_choice' => 0,
                ),
                array(
                    'key' => 'field_6242d9af5de79',
                    'label' => 'Compétences',
                    'name' => 'competences',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'debutant' => 'Débutant',
                        'junior' => 'Junior',
                        'senior' => 'Senior',
                    ),
                    'allow_null' => 1,
                    'other_choice' => 1,
                    'save_other_choice' => 1,
                    'default_value' => '',
                    'layout' => 'horizontal',
                    'return_format' => 'label',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'lb_recrutements',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ));
        
    endif;

}

add_action( 'admin_init', 'plugin_init_dependencies' );

/*
*   Creation Page Recrutement On activate plugin
*/

function LB_recrutement_plugin_activation() {
  
    if ( ! current_user_can( 'activate_plugins' ) ) return;
    
    global $wpdb;
    
    if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'recrutement'", 'ARRAY_A' ) ) {
       
      $current_user = wp_get_current_user();
      
      // create post object
      $page = array(
        'post_title'  => __( 'Recrutement' ),
        'post_status' => 'publish',
        'post_author' => $current_user->ID,
        'post_type'   => 'page',
      );
      
      // insert the post into the database
      wp_insert_post( $page );
    }
}

register_activation_hook( __FILE__, 'LB_recrutement_plugin_activation' );

/**
 *  Fonctions pour faire des timeAgo
 */

function timeago($date) {
    $timestamp = strtotime($date);	
    
    $strTime = array("seconde", "minute", "heure", "jour", "mois", "an");
    $length = array("60","60","24","30","12","10");
 
    $currentTime = time();
    if($currentTime >= $timestamp) {
         $diff     = time()- $timestamp;
         for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
         $diff = $diff / $length[$i];
         }
 
         $diff = round($diff);
         // Condition mettre un s
         ($diff >= 2 && $strTime[$i] !== "mois") ? $pluriel = "s" : $pluriel = "";
         return "Publié il y a ". $diff . " " . $strTime[$i] . $pluriel;
    }
}

/**
 *  Ajout du CSS Custom
 */
function my_enqueued_assets() {
    wp_enqueue_style('LB-recrutement', plugin_dir_url(__FILE__) . '/style.css', '', time());
}
add_action('wp_enqueue_scripts', 'my_enqueued_assets');
