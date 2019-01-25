<?php

// Get our list of feed items to display
function get_xml_feed() {
  $feeds = get_feed_urls();
  $items = array();
  // unordered list of feed items
  foreach( $feeds as $feed ) {
    $feed_items = get_xml_feed_item( $feed );
    $feed_array = xml_feed_to_array( $feed_items );
    $items      = array_merge( $items, $feed_array ); 
  }
  // order our feed items
  $items = sort_feed_array( $items );
  return $items;
}

// cURL request for an individual feed
function get_xml_feed_item( $feed_url ) {
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $feed_url );
  curl_setopt( $ch, CURLOPT_POST, 0 );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
  curl_setopt( $ch, CURLOPT_USERAGENT, "SomeUserAgent" );
  curl_setopt( $ch, CURLOPT_COOKIE, 'AspxAutoDetectCookieSupport=1' );
  $output = curl_exec( $ch );
  curl_close( $ch );
  return trim( $output );
}

function get_feed_urls() {
  $feeds_obj = db_get_first_entry( 'theme_options', array(
    'name' => FEED_URLS_OPTION
  ));
  $feeds = $feeds_obj ? $feeds_obj['value'] : '';
  $feeds = explode( "\n", $feeds );
  return $feeds;
}