<?php
// A custom function that calls register_post_type
function phillip_register_event_post_type() {

  $singluar = 'Event'; 
  $plural   = 'Events';

  // Set various pieces of text, $labels is used inside the $args array
  // Set the labels, this variable is used in the $args array
  $labels = array(
    'name'               => $plural,
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
    'description' => 'Custom Events Post Type',
    'publicly_querable'   => true,
    'exclude_from_search' => false,
    'show_in_nav_menu'   => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
		'menu_position'       => 2,
    'menu_icon'           => 'dashicons-calendar-alt',
    'can_export'          => true,
    'delete_with_user'    => false,
    'hierarchical'        => false,
    'has_archive'        => true,
    'query_var'           => true,
    'capability_type'     => 'page',
    'map_meta_cap'        => true,
    'rewrite'             => array(
      'slug' => 'event',
      'with_front' => true,
      'pages' => true,
      'feeds' => false
    ),
    'supports'            => array (
      'title', 'thumbnail', 'editor' //'editor', 'author', 'custom-fields', '
    )
  );

  // Register the event post type with all the information contained in the $arguments array
  register_post_type( $singluar, $args );
}

 // The custom function MUST be hooked to the init action hook
 add_action( 'init', 'phillip_register_event_post_type' );
