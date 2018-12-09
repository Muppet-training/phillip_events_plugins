<?php

function phillip_add_custom_metabox() {

  add_meta_box(
    'phillip_meta', // Unique name for meta box
    'Event Details', // Metabox Name
    'phillip_meta_callback', // Callback
    'event', // post_type
    'normal', // Where on the screen - Context: 'side', 'normal', 'advanced',
    'high' // Priority: 'low', 'middle', 'high', 'core'
  );  

}

add_action('add_meta_boxes', 'phillip_add_custom_metabox');

function phillip_meta_callback( $post ){
  wp_nonce_field( basename( __FILE__ ), 'phillip_events_nonce');
  $phillip_stored_meta = get_post_meta( $post->ID );
  ?>
  <div>
    <div class="meta-row">
      <div class="meta-th">
        <label for="event-id" class="phillip-row_title">Event ID</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event_id" id="event-id" value="<?php if( ! empty ($phillip_stored_meta['event_id']) ) echo esc_attr( $phillip_stored_meta['event_id'][0] ); ?>"/>          
      </div>
    </div>

    <div class="meta-row">
      <div class="meta-th">
        <label for="event-name" class="phillip-row_title">Event Name</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event-name" id="event-name" value="">
      </div>
    </div>

    <div class="meta-row">
      <div class="meta-th">
        <label for="event-location" class="phillip-row_title">Location</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event-location" id="event-location" value="">
      </div>
    </div>

    <div class="meta-row">
      <div class="meta-th">
        <label for="event-start" class="phillip-row_title">Date Start</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event-start" id="event-start" value="">
      </div>
    </div>

    <div class="meta-row">
      <div class="meta-th">
        <label for="event-end" class="phillip-row_title">Date End</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event-end" id="event-end" value="">
      </div>
    </div>

    <div class="meta-row">
      <div class="meta-th">
        <label for="event-time-start" class="phillip-row_title">Time Start</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event-time-start" id="event-time-start" value="">
      </div>
    </div>

    <div class="meta-row">
      <div class="meta-th">
        <label for="event-time-end" class="phillip-row_title">Time End</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event-time-end" id="event-time-end" value="">
      </div>
    </div>

    <div class="meta-row">
      <div class="meta-th">
        <label for="event-url" class="phillip-row_title">Event URL</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event-url" id="event-url" value="">
      </div>
    </div>
  </div>

  <div class="meta-row">
    <div class="meta-th">
      <span>Event Description</span>
    </div>
  </div>
  <div class="meta-editor">
  <?php
    $content  = get_post_meta( $post->ID, 'event-details', true);
    $editor   = 'event-details';
    $settings = array(
      'textarea_rows' => 5,
      'media_buttons' => false
    );
    wp_editor(
      $content, $editor, $settings
    )
  ?>
  </div>
  <?php
}

function phillip_meta_save( $post_id ){
  //Check save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST['phillip_events_nonce'] ) && wp_verify_nonce( $_POST['phillip_events_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

  // Exits script depending on save status
  if($is_autosave || $is_revision || $is_valid_nonce){
    return;
  }
 
  if( isset( $_POST['event_id'] )){
    update_post_meta( $post_id, 'event_id', sanitize_text_field($_POST['event_id'] ) );
  }
} 
add_action('save_post', 'phillip_meta_save');




// 
// 
// /
// /
// /
// /
// /
// /
// /
// /
// /

<?php

function phillip_add_custom_metabox() {

  add_meta_box(
    'phillip_meta', // Unique name for meta box
    'Event Details', // Metabox Name
    'phillip_meta_callback', // Callback
    'event', // post_type
    'normal', // Where on the screen - Context: 'side', 'normal', 'advanced',
    'high' // Priority: 'low', 'middle', 'high', 'core'
  );  

}

add_action('add_meta_boxes', 'phillip_add_custom_metabox');

function phillip_meta_callback( $post ){

  wp_nonce_field( basename( __FILE__ ), 'phillip_events_nonce');
  $phillip_stored_meta = get_post_meta( $post->ID );
  var_dump($phillip_stored_meta);
  ?>

  <div>
    <div class="meta-row">
      <div class="meta-th">
        <label for="event-id" class="phillip-row_title">Event ID</label>
      </div>
      <div class="meta-td">
        <input type="text" name="event_id" id="event-id" value="<?php if(!empty($phillip_stored_meta['event_id'])) echo esc_attr($phillip_stored_meta['event_id'][0]); ?>"/>          
      </div>
    </div>
  </div>

  <div class="meta">
    <div class="meta-th">
      <span>Event Description</span>
    </div>
    <div class="meta-editor">
      <?php
      $content  = get_post_meta( $post->ID, 'event-details', true);
      $editor   = 'event-details';
      $settings = array(
        'textarea_rows' => 5,
        'media_buttons' => false
      );
      wp_editor(
        $content, $editor, $settings
      )
      ?>
  </div>
  <?php
}

function phillip_meta_save($post_id){
  //Check save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = (isset($_POST['phillip_events_nonce']) && wp_verify_nonce($_POST['phillip_events_nonce'], basename(__FILE__))) ? 'true' : 'false';

  // Exits script depending on save status
  if($is_autosave || $is_revision || $is_valid_nonce){
    return;
  }

  if (isset($_POST['event_id'])){
    update_post_meta($post_id, 'event_id', sanitize_text_field($_POST['event_id']));
  }
}

add_action('save_post', 'phillip_meta_save');
// /





  // if( isset( $_POST['event_name'] )){

  //   $new_meta_value =  sanitize_text_field( $_POST['event_name'] );

  //   /* Get the meta key. */
  //   $meta_key = 'event_name';

  //   /* Get the meta value of the custom field key. */
  //   $meta_value = get_post_meta( $post_id, $meta_key, true );

  //   /* If a new meta value was added and there was no previous value, add it. */
  //   if ( $new_meta_value && ’ == $meta_value )
  //     add_post_meta( $post_id, $meta_key, $new_meta_value, true );

  //   /* If the new meta value does not match the old value, update it. */
  //   elseif ( $new_meta_value && $new_meta_value != $meta_value )
  //     update_post_meta( $post_id, $meta_key, $new_meta_value );

  //   /* If there is no new meta value but an old value exists, delete it. */
  //   elseif ( ’ == $new_meta_value && $meta_value )
  //     delete_post_meta( $post_id, $meta_key, $meta_value );
  // }


  <li>
  <div class="meta">
    <div class="meta-th">
      <span>Event Description</span>
    </div>
    <div class="meta-editor">
      <?php
      $content  = get_post_meta( $post->ID, 'event_details', true);
      $editor   = 'event_details';
      $settings = array(
        'textarea_rows' => 5,
        'media_buttons' => false
      );
      wp_editor(
        $content, $editor, $settings
      )
      ?>
  </div>
</li>

<li class="textarea_input_group">
<label class="input_title" for="event_description">Event Description</label>
<textarea class="textarea_grid" name="event_description" id="event_description" rows="5"><?php echo esc_attr( get_post_meta( $post->ID, 'event_description', true ) ); ?> </textarea>
</li>



$date = "04-12-2018 12:59 PM";
$date_input = "04-12-2018 13:00";
$another_date = "04-12-2018 01:00 PM" ;

echo $input . ' - input <br>';
echo $date . ' - date <br>';
echo $date_input . ' - date_input <br>';
echo $another_date . ' - another_date <br>';

var_dump($input);
echo '<br/>';
var_dump($date);
echo '<br/>';
var_dump($date_input);
echo '<br/>';
var_dump($another_date);
echo '<br/>';

// echo $date->format('d-m-Y h:i A');

$just = DateTime::createFromFormat('d-m-Y h:i a', $input)->format('d-m-Y');
echo $just  . '<br/>';
echo DateTime::createFromFormat('d-m-Y H:i A', $date)->format('d-m-Y') . '<br/>';
echo DateTime::createFromFormat('d-m-Y H:i', $date_input)->format('d-m-Y') . '<br/>';
echo DateTime::createFromFormat('d-m-Y h:i A', $another_date)->format('d-m-Y') . '<br/><hr/>';



<li class="date_input_group">
<label for="event_start_date">Event Start</label>
<div class="form-group">
  <div class='input-group date' id='datetimepicker6'>
    <input type='text' class="form-control" name="event_start_date" id="event_start_date" 
    value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_start_date', true )); ?>"/>
    <span class="input-group-addon">
      <span class="glyphicon glyphicon-calendar"></span>
    </span>
  </div>
</div>
</li>
<li class="date_input_group">
<label for="event_start_date">Event End</label>
<div class="form-group">
  <div class='input-group date' id='datetimepicker7'>
    <input data-format="dd/MM/yyyy hh:mm:ss" type='text' class="form-control" name="event_end_date" id="event_end_date"
    value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_end_date', true )); ?>"/>
    <span class="input-group-addon">
      <span class="glyphicon glyphicon-calendar"></span>
    </span>
  </div>
</div>
</li>

    // echo $input  . '<br/><hr/>';
    // echo $event_time_timestamp . ' - Input Exact <br/>';
    // echo $midnight_stamp . ' - Input Midnight <br/>';
    // echo $tomorrow = strtotime('+1 day', $midnight_stamp) . ' - Input Tomorrow';
    // echo '<hr/>';
    // die();
   
    // update_post_meta( $post_id, 'event_start_date', $timestamp );
    // update_post_meta( $post_id, 'event_day_start_timestamp', $midnight_stamp );