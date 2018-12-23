<?php
// Set Timezone
// date_default_timezone_set('Austalia/Sydney');
// echo 



add_action( 'init', 'phillip_meta_boxes_setup' );

/* Meta box setup function. */
function phillip_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'phillip_add_event_meta_boxes' );

  /* Save post meta on the 'save_post' hook. */
  add_action( 'save_post', 'phillip_save_meta', 10, 2 );
  
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function phillip_add_event_meta_boxes() {

  add_meta_box(
    'phillip_name',      // Unique ID
    esc_html__( 'Event Details', 'event' ),    // Title
    'event_post_class_meta_box',   // Callback function
    'event',         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );
  
  add_meta_box(
    'phillip_organiser',      // Unique ID
    esc_html__( 'Event Organiser', 'organiser' ),    // Title
    'organiser_post_class_meta_box',   // Callback function
    'event',         // Admin page (or post type)
    'side',         // Context
    'high'         // Priority
  );
}



/* Display the post meta box. */
function event_post_class_meta_box( $post ) { ?>

<?php wp_nonce_field( basename( __FILE__ ), 'phillip_event_nonce' ); ?>
  <ul>
    <li class="date_input_group">
      <label for="event_start_date">Start Date & Time</label>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker6'>
          <input type='text' class="form-control" name="event_start_date" id="event_start_date"  value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_start_date', true )); ?>"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </li>
    <li class="date_input_group">
      <label for="event_start_date">End Date & Time</label>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker7'>
          <input type='text' class="form-control" name="event_end_date" id="event_end_date"  value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_end_date', true )); ?>"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </li>
    <li class="text_input_group">
      <label for="event_place">Place or Venue</label>
      <input class="form-control" type="text" name="event_place" id="event_place" value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_place', true ) ); ?>"/>
    </li>
    <li class="text_input_group">
      <label for="event_town">Town</label>
      <input class="form-control" type="text" name="event_town" id="event_town" value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_town', true ) ); ?>"/>
    </li>
    <li class="text_input_group">
      <label for="event_lat">Google Map Lat</label>
      <input class="form-control" type="text" name="event_lat" id="event_lat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_lat', true ) ); ?>"/>
    </li>
    <li class="text_input_group">
      <label for="event_lng">Google Map Lng</label>
      <input class="form-control" type="text" name="event_lng" id="event_lng" value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_lng', true ) ); ?>"/>
    </li>
    <li class="text_input_group">
      <label for="event_price">Price From</label>
      <input class="form-control" type="number" step=".01" name="event_price" id="event_price" value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_price', true ) ); ?>"/>
    </li>
    <li class="text_input_group">
      <label for="event_summary">Summary</label>
      <input class="form-control" type="text" name="event_summary" id="event_summary" value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_summary', true ) ); ?>"/>
    </li>
    <li>
      <div class="meta">
        <div class="meta-th">
          <span>Description</span>
        </div>
        <div class="meta-editor">
          <?php
          $content  = get_post_meta( $post->ID, 'event_description', true);
          $editor   = 'event_description';
          $settings = array(
            'textarea_rows' => 35,
            'media_buttons' => false
          );
          wp_editor(
            $content, $editor, $settings
          )
          ?>
      </div>
    </li>
  </ul>
<?php }

function organiser_post_class_meta_box( $post ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'phillip_event_nonce' ); ?>
    <ul class="side">
      <li class="side_text_input_group">
        <label for="o_name">Organiser / Business Name</label>
        <input class="form-control" type="text" name="o_name" id="o_name" value="<?php echo esc_attr( get_post_meta( $post->ID, 'o_name', true ) ); ?>"/>
      </li>
      <li class="side_text_input_group">
        <label for="o_number">Customer Contact Number</label>
        <input class="form-control" type="number" name="o_number" id="o_number" value="<?php echo esc_attr( get_post_meta( $post->ID, 'o_number', true ) ); ?>"/>
      </li>
      <li class="side_text_input_group">
        <label for="o_email">Customer Contact Email</label>
        <input class="form-control" type="text" name="o_email" id="o_email" value="<?php echo esc_attr( get_post_meta( $post->ID, 'o_email', true ) ); ?>"/>
      </li>
      <li class="side_text_input_group">
        <label for="o_link">Event Link / URL</label>
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

/* Save the meta box's post metadata. */
function phillip_save_meta( $post_id, $post ) {
  date_default_timezone_set('Australia/Melbourne');
  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['phillip_event_nonce'] ) || !wp_verify_nonce( $_POST['phillip_event_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  if( isset( $_POST['event_summary'] )){
    update_post_meta( $post_id, 'event_summary', sanitize_text_field( $_POST['event_summary']) );
  }
  if( isset( $_POST['event_start_date'] )){
    $input_datetime = sanitize_text_field($_POST['event_start_date']);
    $input_date = DateTime::createFromFormat('d-m-Y h:i a', $input_datetime)->format('d-m-Y');
    $event_datetime_timestamp = DateTime::createFromFormat('d-m-Y h:i a', $input_datetime)->getTimestamp();
    $event_date_timestamp = strtotime($input_date);
    update_post_meta( $post_id, 'event_start_date', $input_datetime );
    update_post_meta( $post_id, 'event_start_timestamp', $event_datetime_timestamp );
    update_post_meta( $post_id, 'event_start_midnight_timestamp', $event_date_timestamp );
  }
  if( isset( $_POST['event_end_date'] )){
    $date_input = sanitize_text_field($_POST['event_end_date']);
    // $timestamp = strtotime($date_input);
    $event_time_timestamp = DateTime::createFromFormat('d-m-Y h:i a', $date_input)->getTimestamp();
    update_post_meta( $post_id, 'event_end_date', $date_input );
    update_post_meta( $post_id, 'event_end_timestamp', $event_time_timestamp );
  }
  if( isset( $_POST['event_place'] )){
    update_post_meta( $post_id, 'event_place', sanitize_text_field( $_POST['event_place']) );
  }
  if( isset( $_POST['event_town'] )){
    update_post_meta( $post_id, 'event_town', sanitize_text_field( $_POST['event_town']) );
  }
  if( isset( $_POST['event_lat'] )){
    update_post_meta( $post_id, 'event_lat', sanitize_text_field( $_POST['event_lat']) );
  }
  if( isset( $_POST['event_lng'] )){
    update_post_meta( $post_id, 'event_lng', sanitize_text_field( $_POST['event_lng']) );
  }
  if( isset( $_POST['event_price'] )){
    update_post_meta( $post_id, 'event_price', sanitize_text_field( $_POST['event_price']) );
  }
  if( isset( $_POST['event_summary'] )){
    update_post_meta( $post_id, 'event_summary', sanitize_text_field( $_POST['event_summary']) );
  }
  if( isset( $_POST['event_description'] )){
    update_post_meta( $post_id, 'event_description', $_POST['event_description'] );
  }

  // Save Organiser
  if( isset( $_POST['o_name'] )){
    update_post_meta( $post_id, 'o_name', $_POST['o_name'] );
  }
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
