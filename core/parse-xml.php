<?php

/**
 * This is to help parse XML into a readable/parsable object
 */

function xml_feed_to_array( $xml_feed ) {
  // Gives us the full SimpleXMLElement object
  $feed_object = simplexml_load_string( $xml_feed );
  if( false === $feed_object ) { 
    return array();
  }
  // Turn the object into an array of items
  $items     = array();
  $raw_items = $feed_object->channel->item;
  foreach( $raw_items as $item ) {
    $to_add            = (array) $item;
    $to_add['pubDate'] = strtotime( $to_add['pubDate'] );
    $to_add['channel'] = $feed_object->channel->title;
    $items[]           = $to_add;
  }
  return $items;
}

/*
 * Sort the array of feed items by the publish date (newest first)
 */

function sort_feed_array( $feed_array ) {
  usort( $feed_array, 'sort_feed_array_helper' );
  return $feed_array;
}

function sort_feed_array_helper( $a, $b ) {
  return $b['pubDate'] - $a['pubDate'];
}