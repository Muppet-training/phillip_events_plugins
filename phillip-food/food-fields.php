<?php

add_action( 'init', 'phillip_food_meta_boxes_setup' );

/* Meta box setup function. */
function phillip_food_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'phillip_add_food_meta_boxes');

  add_action( 'save_post', 'phillip_food_save_meta', 10, 2 );
  
}



/* Create one or more meta boxes to be displayed on the post editor screen. */
function phillip_add_food_meta_boxes() {

  add_meta_box(
    'phillip_food',      // Unique ID
    esc_html__( 'Food Details', 'food' ),    // Title
    'food_post_class_meta_box',   // Callback function
    'food',         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );

  add_meta_box(
    'phillip_options',      // Unique ID
    esc_html__( 'Quick View Options', 'food' ),    // Title
    'food_post_options_class_meta_box',   // Callback function
    'food',         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );

  add_meta_box(
    'wp_custom_attachment',      // Unique ID
    esc_html__( 'Upload PDF', 'food' ),    // Title
    'wp_custom_attachment',   // Callback function
    'food',         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );
  
  add_meta_box(
    'phillip_food_organiser',      // Unique ID
    esc_html__( 'Food & Drink Owner', 'food_o' ),    // Title
    'organiser_food_post_class_meta_box',   // Callback function
    'food',         // Admin page (or post type)
    'side',         // Context
    'high'         // Priority
  );
  
}

/* Display the post meta box. */
function food_post_class_meta_box( $post ) { ?>

<?php wp_nonce_field( basename( __FILE__ ), 'phillip_food_nonce' ); ?>
  <ul>
      <li class="text_input_group">
        <label for="food_street">Street Address</label>
        <input class="form-control" type="text" name="food_street" id="food_street" value="<?php echo esc_attr( get_post_meta( $post->ID, 'food_street', true ) ); ?>"/>
      </li>
      <li class="text_input_group">
        <label for="food_town">Town</label>
        <input class="form-control" type="text" name="food_town" id="food_town" value="<?php echo esc_attr( get_post_meta( $post->ID, 'food_town', true ) ); ?>"/>
      </li>
      <li class="text_input_group">
        <label for="food_map">Google Map Link</label>
        <input class="form-control" type="text" name="food_map" id="food_map" value="<?php echo esc_attr( get_post_meta( $post->ID, 'food_map', true ) ); ?>"/>
      </li>
      <li class="text_input_group">
        <label for="food_travel_check">Travels To Customer</label>
        <input class="form-control" type="checkbox" name="food_travel_check" id="food_travel_check" value="1" <?php 
          if(esc_attr( get_post_meta( $post->ID, 'food_travel_check', true )) == 1){
            echo 'checked';
          }
        ?>/>
      </li>
      <li class="text_input_group">
        <label for="food_summary">Summary 120 Characters</label>
        <input class="form-control" type="text" name="food_summary" id="food_summary" value="<?php echo esc_attr( get_post_meta( $post->ID, 'food_summary', true ) ); ?>"/>
      </li>
      <!-- <li>
        <div class="meta">
          <div class="meta-th">
            <span>Description</span>
          </div>
          <div class="meta-editor">
            <?php
            // $content  = get_post_meta( $post->ID, 'food_description', true);
            // $editor   = 'food_description';
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
function food_post_options_class_meta_box( $post ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'phillip_food_nonce' ); ?>
    <ul >
      <li class="text_input_group">
        <label for="vegan_check">Vegan Options Avaliable</label>
        <input class="form-control" type="checkbox" name="vegan_check" id="vegan_check" value="1" <?php 
          if(esc_attr( get_post_meta( $post->ID, 'vegan_check', true )) == 1){
            echo 'checked';
          }
        ?>/>
      </li>
      <li class="text_input_group">
        <label for="takeaway_check">Takeaway Avaliable</label>
        <input class="form-control" type="checkbox" name="takeaway_check" id="takeaway_check" value="1" <?php 
          if(esc_attr( get_post_meta( $post->ID, 'takeaway_check', true )) == 1){
            echo 'checked';
          }
        ?>/>
      </li>
      <li class="text_input_group">
        <label for="gf_check">GF Options Avaliable</label>
        <input class="form-control" type="checkbox" name="gf_check" id="gf_check" value="1" <?php 
          if(esc_attr( get_post_meta( $post->ID, 'gf_check', true )) == 1){
            echo 'checked';
          }
        ?>/>
      </li>
      <li class="text_input_group">
        <label for="alcohol_check">Alcohol Avaliable</label>
        <input class="form-control" type="checkbox" name="alcohol_check" id="alcohol_check" value="1" <?php 
          if(esc_attr( get_post_meta( $post->ID, 'alcohol_check', true )) == 1){
            echo 'checked';
          }
        ?>/>
      </li>
    </ul>
  <?php
}

function wp_custom_attachment() {  
  wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');
  $html = '<p class="description">';
  $html .= 'Upload your PDF here.';
  $html .= '</p>';
  $html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25">';
  echo $html;
}

function organiser_food_post_class_meta_box( $post ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'phillip_food_nonce' ); ?>
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
function phillip_food_save_meta( $post_id, $post ) {

  // echo '<pre>';
  // echo print_r($_POST);
  // echo '</pre>';


  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['phillip_food_nonce'] ) || !wp_verify_nonce( $_POST['phillip_food_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  if( isset( $_POST['food_street'] )){
    update_post_meta( $post_id, 'food_street', sanitize_text_field( $_POST['food_street']) );
  }
  if( isset( $_POST['food_town'] )){
    update_post_meta( $post_id, 'food_town', sanitize_text_field( $_POST['food_town']) );
  }
  if( isset( $_POST['food_map'] )){
    update_post_meta( $post_id, 'food_map', sanitize_text_field( $_POST['food_map']) );
  }
  if( isset( $_POST['food_lng'] )){
    update_post_meta( $post_id, 'food_lng', sanitize_text_field( $_POST['food_lng']) );
  }
  if( isset( $_POST['food_travel_check'] )){
    update_post_meta( $post_id, 'food_travel_check', $_POST['food_travel_check'] );
  }else{
    update_post_meta( $post_id, 'food_travel_check', 0 );
  }
  if( isset( $_POST['food_summary'] )){
    $cut = substr($_POST['food_summary'], 0, 120);
    update_post_meta( $post_id, 'food_summary', sanitize_text_field( $cut) );
  }
  if( isset( $_POST['food_description'] )){
    update_post_meta( $post_id, 'food_description', $_POST['food_description'] );
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

  // Save Venue Options
  if( isset( $_POST['vegan_check'] )){
    update_post_meta( $post_id, 'vegan_check', $_POST['vegan_check'] );
  }else{
    update_post_meta( $post_id, 'vegan_check', 0 );
  }

  if( isset( $_POST['takeaway_check'] )){
    update_post_meta( $post_id, 'takeaway_check', $_POST['takeaway_check'] );
  }else{
    update_post_meta( $post_id, 'takeaway_check', 0 );
  }

  if( isset( $_POST['gf_check'] )){
    update_post_meta( $post_id, 'gf_check', $_POST['gf_check'] );
  }else{
    update_post_meta( $post_id, 'gf_check', 0 );
  }

  if( isset( $_POST['alcohol_check'] )){
    update_post_meta( $post_id, 'alcohol_check', $_POST['alcohol_check'] );
  }else{
    update_post_meta( $post_id, 'alcohol_check', 0 );
  }

  if(!empty($_FILES['wp_custom_attachment']['name'])) {
      $supported_types = array('application/pdf');
      $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
      $uploaded_type = $arr_file_type['type'];

      if(in_array($uploaded_type, $supported_types)) {
          $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
          if(isset($upload['error']) && $upload['error'] != 0) {
              wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
          } else {
              update_post_meta($post_id, 'wp_custom_attachment', $upload);
          }
      }
      else {
          wp_die("The file type that you've uploaded is not a PDF.");
      }
  }
  

add_action('save_post', 'save_custom_meta_data');

}

