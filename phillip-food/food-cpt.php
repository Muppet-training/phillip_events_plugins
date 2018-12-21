<?php
// A custom function that calls register_post_type
function phillip_register_food_post_type() {

  $singluar = 'Food'; 
  $plural   = 'Foods';

  // Set various pieces of text, $labels is used inside the $args array
  // Set the labels, this variable is used in the $args array
  $labels = array(
    'name'               => $plural . ' & Drink',
    'singular_name'      => $singluar,
    'add_new'            => 'Add New ',
    'add_new_item'       => 'Add New ' . $singluar,
    'edit_item'          => 'Edit ' . $singluar,
    'new_item'           => 'New ' . $singluar,
    'all_items'          => 'All ' . $plural,
    'view_item'          => 'View ' . $singluar,
    'search_items'       => 'Search ' . $plural,
    'not_found'          => 'No ' .$singluar . ' Found',
    'featured_image'     => $singluar . ' Image',
    'set_featured_image' => 'Add ' .$singluar . ' Image',
    'not_found_in_trash' => 'No ' .$singluar . ' in Trash',
  );

  // Set various pieces of information about the post type
  $args = array(
    'labels' => $labels,
    'public' => true,
    'description' => 'Custom Food & Drink Post Type',
    'publicly_querable'   => true,
    'exclude_from_search' => false,
    'show_in_nav_menu'   => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
		'menu_position'       => 4,
    'menu_icon'           => 'dashicons-carrot',
    'can_export'          => true,
    'delete_with_user'    => false,
    'hierarchical'        => false,
    'has_archive'         => true,
    'query_var'           => true,
    'capability_type'     => 'page',
    'map_meta_cap'        => true,
    'rewrite'             => array(
      'slug' => 'business',
      'with_front' => true,
      'pages' => true,
      'feeds' => false
    ),
    'supports'            => array (
      'title', 'thumbnail', //'editor', 'author', 'custom-fields', '
    ),
    'taxonomies'          => array( 'category')
  );

  // Register the event post type with all the information contained in the $arguments array
  register_post_type( $singluar, $args );
}

 // The custom function MUST be hooked to the init action hook
 add_action( 'init', 'phillip_register_food_post_type' );
