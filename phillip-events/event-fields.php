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
    'smashing_post_class_meta_box',   // Callback function
    'event',         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );
}



/* Display the post meta box. */
function smashing_post_class_meta_box( $post ) { ?>

<?php wp_nonce_field( basename( __FILE__ ), 'phillip_event_nonce' ); ?>
  <ul>
    <li class="date_input_group">
      <label for="event_start_date">Event Start</label>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker6'>
          <input type='text' class="form-control" name="event_start_date" id="event_start_date" 
          value="<?php echo date('d/m/Y H:i', esc_attr( get_post_meta( $post->ID, 'event_start_date', true ))); ?>"/>
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
          value="<?php echo date('d/m/Y H:i', esc_attr( get_post_meta( $post->ID, 'event_end_date', true ))); ?>"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </li>
    <li class="text_input_group">
      <label for="event_summary">Event Summary</label>
      <input class="form-control" type="text" name="event_summary" id="event_summary" value="<?php echo esc_attr( get_post_meta( $post->ID, 'event_summary', true ) ); ?>"/>
    </li>
    <li>
      <div class="meta">
        <div class="meta-th">
          <span>Event Description</span>
        </div>
        <div class="meta-editor">
          <?php
          $content  = get_post_meta( $post->ID, 'event_description', true);
          $editor   = 'event_description';
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
  </ul>
<?php }

/* Save the meta box's post metadata. */
function phillip_save_meta( $post_id, $post ) {

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
    $input = $_POST['event_start_date'];
    date_default_timezone_set('Australia/Melbourne');

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

    // var_dump($just);
    // $dateTime = new DateTime($just); 
    // echo $dateTime->getTimestamp() . '<br/>';
    echo DateTime::createFromFormat('d-m-Y h:i a', $input)->getTimestamp().' - Input Exact <br/><br/>';
    echo $timestamp = strtotime($just);
    // echo DateTime::createFromFormat('d-m-Y', $just);


    echo '<br/><br/><br/><hr/>';



    // $str_date = 'Thu, 23/02/2012 - 15:18';
    // $obj_date = DateTime::createFromFormat('D, d/m/Y - H:i', $str_date);
    // $new_str_date = '02-12-2018 15:18 PM';
    // $new_obj_date = DateTime::createFromFormat('!d-m-Y H:i A', $new_str_date);
    // $date_new = date('d-m-Y', $new_obj_date->getTimestamp());

    // $t_str_date = '04-12-2018 15:18 PM';
    // $t_obj_date = DateTime::createFromFormat('d-m-Y H:i A', $date_input, new DateTimeZone('Australia/Brisbane'));
    // $just_date = $t_obj_date->format('d-m-Y');
    // // $getTimezone = $t_obj_date->setTimeZone(new DateTimeZone('Australia/Melbourne'));
    // $just_obj_date = DateTime::createFromFormat('d-m-Y', $just_date, new DateTimeZone('Australia/Brisbane'));
    
    // echo $str_date .'<br/>';
    // echo $obj_date->getTimestamp().' - Example <br/><br/>'; // prints 1330010280
    // echo $new_str_date .'<br/>';
    // echo $new_obj_date->getTimestamp().' - Test <br/><br/>'; // prints 1330010280
    // echo $date_input .'<br/>';
    // echo $t_obj_date->getTimestamp().' - Data Input <br/><br/>'; // prints 1330010280
    // echo $just_date .'<br/>';
    // echo $just_obj_date->getTimestamp().' - Just <br/><br/>'; // prints 1330010280
    // echo $date_new . '<br/>';


    // echo '<hr/><br/>';

    // $date = new DateTime;
    // $ex = '02-12-2018 15:18 PM';

    // $new_date = DateTime::createFromFormat('d-m-Y H:i A', $ex);
    // $new_date = $new_date->getTimestamp();

    // echo '<pre>';
    // var_dump($new_date);
    // echo '</pre>';


    // echo $date->format('d-m-Y');
    // echo '<br/>';
    // echo $date->getTimestamp();
    // echo '<br/>';
    // echo $date->getTimezone()->getName();
    // echo '<br/>';
    // echo $new_date->setTimestamp();
    // echo '<br/>';
    // echo $date_input->format('d-m-Y');


    die();



    
    update_post_meta( $post_id, 'event_start_date', $timestamp );
    update_post_meta( $post_id, 'event_day_start_timestamp', $event_day_timestamp );
    update_post_meta( $post_id, 'event_start_timestamp', $event_time_timestamp );
  }
  if( isset( $_POST['event_end_date'] )){
    $date_input = (string) sanitize_text_field( $_POST['event_end_date']);
    $timestamp = strtotime($date_input);
    update_post_meta( $post_id, 'event_end_date', $timestamp );
  }
  if( isset( $_POST['event_description'] )){
    update_post_meta( $post_id, 'event_description', sanitize_text_field( $_POST['event_description']) );
  }
  if( isset( $_POST['event_description'] )){
    update_post_meta( $post_id, 'event_description', $_POST['event_description'] );
  }





}
