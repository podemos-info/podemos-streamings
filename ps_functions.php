<?php

define("PM_NOW", time() + 3600);
define("PM_TIME_BEFORE", 60*60);
define("PM_TIME_AFTER", 60*60);


function pm_streaming_current( $sid ){
  $streaming_starts_at = intval( get_post_meta($sid, "streaming_starts_at", true) );
  $streaming_ends_at = intval( get_post_meta($sid, "streaming_ends_at", true) );
  return (PM_NOW > $streaming_starts_at-PM_TIME_BEFORE && PN_NOW < $streaming_ends_at-PM_TIME_AFTER);
}

function pm_get_current_streaming_id(){
  $args = [ 'post_type' => 'streaming', 'order' => 'DESC', 'posts_per_page' => 50, 'meta_key'=> 'streaming_ends_at', 'orderby' => 'meta_value',
	    'meta_query'=> [ 'OR',
			     [ 'key' => 'streaming_starts_at', 'compare' => '<', 'value' => PM_NOW - PM_TIME_BEFORE, 'type'=>'numeric' ],
	                     [ 'key' => 'streaming_ends_at', 'compare' => '>', 'value' => PM_NOW + PM_TIME_AFTER, 'type'=>'numeric' ]] ];
  $streamings = get_posts($args);
  $sids = array();
  if(count($streamings)){
    foreach($streamings as $streaming){
      $sids[] = $streaming->ID;
    }
  }
  return $sids;
}

function pm_current_streaming_html( $atts=[] ){
  // current streaming html
  $current_streaming_id = pm_get_current_streaming_id();
  if(count($current_streaming_id)){
  wp_register_style( 'podemos-streamings', plugins_url( 'podemos-streamings/ps-style.css' ) );
  wp_enqueue_style( 'podemos-streamings' );
    $current_streaming = get_post($current_streaming_id[0]);
    $current_streaming_youtube_title = $current_streaming->post_title;
    $current_streaming_youtube_title = wp_trim_words( $current_streaming->post_title, 9 );
    $ps_html .= '<div class="ps-head"><i class="fa fa-circle intermittent-light" aria-hidden="true""></i><a href="/directo/">'._x('EN DIRECTO','podemos-streaming','podemos-streaming').': ' . $current_streaming_youtube_title . '</a></div>';
  }
  return $ps_html;
}

function ps_directo_archive_loop( $query ) {
  if ($query->is_post_type_archive('streaming') && $query->is_main_query()) {
    $query->set( 'order', 'DESC' );
    $query->set( 'meta_key', 'streaming_ends_at' );
    $query->set( 'orderby', 'streaming_ends_at' );
    $query->set( 'posts_per_page', 300 );
  }
}

// set the streaming loop order
add_action( 'pre_get_posts', 'ps_directo_archive_loop'); 

