<?php

function phillip_register_taxonomy() {

  $pural = 'locations';
  $singluar = 'location';

  $labels = array (
    'name'                        => $pural,
    'singular_name'               => $singluar,
    'search_items'                => 'Search ' . $pural,
    'popular_items'               => 'Popular ' . $pural,
    'all_items'                   => 'All ' . $pural,
    'parent_item'                 => null,
    'parent_item_colon'           => null,
    'edit_item'                   => 'Edit ' . $singluar,
    'update_item'                 => 'Update ' . $singluar,
    'add_new_item'                => 'Add New ' . $singluar,
    'add_new_name'                => 'New ' . $singluar . 'Name',
    'separated_items_with_commas' => 'Separate ' . $plural . ' with commas',
    'add_or_remove_items'         => 'Add or remove ' . $plural,
    'choose_from_most_used'       => 'Choose from the most used ' . $pural,
    'not_found'                   => 'No ' . $pural . ' found',
    'menu_name'                   => $pural,
  );

  $args = array (
    'hierarchical'        => true,
    'labels'              => $labels,
    'show_ui'             => true,
    'show_admin_column'   => true,
    'update_count_calback'=> '_update_post_term_count',
    'query_var'           => true,
    'rewrite'             => array('slug' => 'location'),
  );
  register_taxonomy('location', 'event', $args);
}

add_action('init', 'phillip_register_taxonomy');