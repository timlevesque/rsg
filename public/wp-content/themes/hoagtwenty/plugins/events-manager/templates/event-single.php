<?php
/* 
 * Remember that this file is only used if you have chosen to override event pages with formats in your event settings!
 * You can also override the single event page completely in any case (e.g. at a level where you can control sidebars etc.), as described here - http://codex.wordpress.org/Post_Types#Template_Files
 * Your file would be named single-event.php
 */
/*
 * This page displays a single event, called during the the_content filter if this is an event page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 * 
 * $args - the args passed onto EM_Events::output() 
 */
global $EM_Event, $EM_Events;
/* @var $EM_Event EM_Event */
//echo $EM_Event->output_single();

?>
<p>
<?php print $EM_Event->post_content; ?>
</p>
<?php 
$format_classes = '<div class="row p-4 rounded bg-light">';
$format_classes .= '<div class=" px-0 align-self-center col date">#_{l\, F j\, Y h:i A}</div>';
if (is_user_logged_in()){
    $format_classes .= '<div class="col text-right">#_BOOKINGBUTTON</div>';
}else{
    $format_classes .= '<div class="col text-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login to Register &rarr;</button></div>';
}
$format_classes .= '</div>';
if (class_exists('EM_Events')) {
    print EM_Events( array('search' => $EM_Event->event_name,'limit'=>10,'orderby'=>'event_start_date', 'order'=>'ASC','format'=>$format_classes) );
}
?>
<pre>
<?php // print_r($EM_Event);  ?>
</pre>