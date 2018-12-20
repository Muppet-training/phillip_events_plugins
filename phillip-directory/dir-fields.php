<?php

add_action( 'init', 'phillip_dir_meta_boxes_setup' );

/* Meta box setup function. */
function phillip_dir_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'phillip_add_dir_meta_boxes');

  add_action( 'save_post', 'phillip_dir_save_meta', 10, 2 );
  
}



/* Create one or more meta boxes to be displayed on the post editor screen. */
function phillip_add_dir_meta_boxes() {

  add_meta_box(
    'phillip_dir',      // Unique ID
    esc_html__( 'Listing Details', 'listing' ),    // Title
    'dir_post_class_meta_box',   // Callback function
    'listing',         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );
  
  add_meta_box(
    'phillip_dir_organiser',      // Unique ID
    esc_html__( 'Listing Owner', 'listing_o' ),    // Title
    'organiser_dir_post_class_meta_box',   // Callback function
    'listing',         // Admin page (or post type)
    'side',         // Context
    'high'         // Priority
  );
  
}

/* Display the post meta box. */
function dir_post_class_meta_box( $post ) { ?>

<?php wp_nonce_field( basename( __FILE__ ), 'phillip_dir_nonce' ); ?>
  <ul>
      <li class="text_input_group">
        <label for="dir_street">Street Address</label>
        <input class="form-control" type="text" name="dir_street" id="dir_street" value="<?php echo esc_attr( get_post_meta( $post->ID, 'dir_street', true ) ); ?>"/>
      </li>
      <li class="text_input_group">
        <label for="dir_town">Town</label>
        <input class="form-control" type="text" name="dir_town" id="dir_town" value="<?php echo esc_attr( get_post_meta( $post->ID, 'dir_town', true ) ); ?>"/>
      </li>
      <li class="text_input_group">
        <label for="dir_map">Google Map Link</label>
        <input class="form-control" type="text" name="dir_map" id="dir_map" value="<?php echo esc_attr( get_post_meta( $post->ID, 'dir_map', true ) ); ?>"/>
      </li>
      <li class="text_input_group">
        <label for="dir_travel_check">Travels To Customer</label>
        <input class="form-control" type="checkbox" name="dir_travel_check" id="dir_travel_check" value="1" <?php 
          if(esc_attr( get_post_meta( $post->ID, 'dir_travel_check', true )) == 1){
            echo 'checked';
          }
        
        ?>/>
      </li>
      <li class="text_input_group">
        <label for="dir_summary">Summary 120 Characters</label>
        <input class="form-control" type="text" name="dir_summary" id="dir_summary" value="<?php echo esc_attr( get_post_meta( $post->ID, 'dir_summary', true ) ); ?>"/>
      </li>
      <!-- <li>
        <div class="meta">
          <div class="meta-th">
            <span>Description</span>
          </div>
          <div class="meta-editor">
            <?php
            // $content  = get_post_meta( $post->ID, 'dir_description', true);
            // $editor   = 'dir_description';
            // $settings = array(
              // 'textarea_rows' => 35,
              // 'media_buttons' => false
            // );
            // wp_editor(
              // $content, $editor, $settings
            // )
            ?>
        </div>
      </li> -->
    </ul>

  <?php 
}

function organiser_dir_post_class_meta_box( $post ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'phillip_dir_nonce' ); ?>
    <ul class="side">
      <li class="side_text_input_group">
        <label for="o_number">Customer Contact Number</label>
        <input class="form-control" type="number" name="o_number" id="o_number" value="<?php echo esc_attr( get_post_meta( $post->ID, 'o_number', true ) ); ?>"/>
      </li>
      <li class="side_text_input_group">
        <label for="o_email">Customer Contact Email</label>
        <input class="form-control" type="text" name="o_email" id="o_email" value="<?php echo esc_attr( get_post_meta( $post->ID, 'o_email', true ) ); ?>"/>
      </li>
      <li class="side_text_input_group">
        <label for="o_link">Link / URL</label>
        <input class="form-control" type="text" name="o_link" id="o_link" value="<?php echo esc_attr( get_post_meta( $post->ID, 'o_link', true ) ); ?>"/>
      </li>
      <hr>
      <li class="side_text_input_group">
        <label for="p_name">Your Full name</label>
        <input class="form-control" type="text" name="p_name" id="p_name" value="<?php echo esc_attr( get_post_meta( $post->ID, 'p_name', true ) ); ?>"/>
      </li>
      <li class="side_text_input_group">
        <label for="p_number">Personal Contact Number</label>
        <input class="form-control" type="number" name="p_number" id="p_number" value="<?php echo esc_attr( get_post_meta( $post->ID, 'p_number', true ) ); ?>"/>
      </li>
      <li class="side_text_input_group">
        <label for="p_email">Personal Contact Email</label>
        <input class="form-control" type="text" name="p_email" id="p_email" value="<?php echo esc_attr( get_post_meta( $post->ID, 'p_email', true ) ); ?>"/>
      </li>      
    </ul>
  <?php
}




// /* Save the meta box's post metadata. */
function phillip_dir_save_meta( $post_id, $post ) {

  // echo '<pre>';
  // echo print_r($_POST);
  // echo '</pre>';


  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['phillip_dir_nonce'] ) || !wp_verify_nonce( $_POST['phillip_dir_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  if( isset( $_POST['dir_street'] )){
    update_post_meta( $post_id, 'dir_street', sanitize_text_field( $_POST['dir_street']) );
  }
  if( isset( $_POST['dir_town'] )){
    update_post_meta( $post_id, 'dir_town', sanitize_text_field( $_POST['dir_town']) );
  }
  if( isset( $_POST['dir_map'] )){
    update_post_meta( $post_id, 'dir_map', sanitize_text_field( $_POST['dir_map']) );
  }
  if( isset( $_POST['dir_lng'] )){
    update_post_meta( $post_id, 'dir_lng', sanitize_text_field( $_POST['dir_lng']) );
  }
  if( isset( $_POST['dir_travel_check'] )){
    update_post_meta( $post_id, 'dir_travel_check', $_POST['dir_travel_check'] );
  }else{
    update_post_meta( $post_id, 'dir_travel_check', 0 );
  }
  if( isset( $_POST['dir_summary'] )){
    $cut = substr($_POST['dir_summary'], 0, 120);
    update_post_meta( $post_id, 'dir_summary', sanitize_text_field( $cut) );
  }
  if( isset( $_POST['dir_description'] )){
    update_post_meta( $post_id, 'dir_description', $_POST['dir_description'] );
  }

  // Save Organiser
  if( isset( $_POST['o_number'] )){
    update_post_meta( $post_id, 'o_number', $_POST['o_number'] );
  }
  if( isset( $_POST['o_email'] )){
    update_post_meta( $post_id, 'o_email', $_POST['o_email'] );
  }
  if( isset( $_POST['o_link'] )){
    update_post_meta( $post_id, 'o_link', $_POST['o_link'] );
  }
  if( isset( $_POST['p_name'] )){
    update_post_meta( $post_id, 'p_name', $_POST['p_name'] );
  }
  if( isset( $_POST['p_number'] )){
    update_post_meta( $post_id, 'p_number', $_POST['p_number'] );
  }
  if( isset( $_POST['p_email'] )){
    update_post_meta( $post_id, 'p_email', $_POST['p_email'] );
  }

}

