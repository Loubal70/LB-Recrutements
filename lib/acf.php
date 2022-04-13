<?php

/**
 *  Option Menu Recrutements
 */

function Apase_register_post_types() {

    // CPT Portfolio
    $labels = array(
        'name' => 'Recrutements',
        'singular_name' => 'Recrutement',
        'all_items' => 'Tous les offres',  // affiché dans le sous menu
        'add_new_item' => 'Ajouter une offre',
        'edit_item' => 'Modifier une offre',
        'menu_name' => 'Recrutements',
        
    );

	$args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail' ),
        'menu_position' => 2,
        'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 66 66" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><g><path d="m42.8238 37.9175c6.48-8.84 5.73-21.31-2.26-29.3-8.8199-8.82-23.1199-8.82-31.95 0-8.8201 8.82-8.8201 23.12 0 31.94 7.99 7.99 20.47 8.75 29.3 2.27.9299-.68 1.8199-1.44 2.6499-2.27.8301-.83 1.5901-1.72 2.2601-2.64zm-4.2801-2.6431v-.637c0-4.11-3.33-7.4399-7.45-7.4399h-2.4099l-4.04 7.71c-.02.05-.1001.05-.1101 0l-4.0399-7.71h-2.42c-4.11 0-7.4399 3.33-7.4399 7.4399v.6296c-2.3436-3.0528-3.63-6.764-3.63-10.6796 0-4.7 1.83-9.11 5.15-12.44 3.3199-3.32 7.74-5.15 12.4399-5.15 4.6899 0 9.11 1.83 12.4299 5.15 6.1801 6.18 6.9301 15.78 1.77 22.81-.0788.1087-.1684.2102-.25.317z" fill="#000000" data-original="#000000" class=""></path><path d="m62.4038 54.6675-13.6101-13.59-1.4099 1.4-3.14-3.14c-.67.92-1.4401 1.81-2.27 2.63-.8199.83-1.7001 1.59-2.63 2.29l3.13 3.1299-1.41 1.4 13.6101 13.62c2.1399 2.12 5.5898 2.12 7.73 0 2.1298-2.1399 2.1298-5.5999-.0001-7.7399z" fill="#000000" data-original="#000000" class=""></path><path d="m24.5898 9.8124c-3.871 0-7.009 3.1381-7.009 7.009 0 3.871 3.1381 9.7378 7.009 9.7378s7.0092-5.8668 7.0092-9.7378c-.0001-3.8709-3.1383-7.009-7.0092-7.009z" fill="#000000" data-original="#000000" class=""></path></g></g></g></svg>'),
	);

	register_post_type( 'recrutements', $args );
}
add_action( 'init', 'LB-recrutements_register_post_types' ); // Le hook init lance la fonction
