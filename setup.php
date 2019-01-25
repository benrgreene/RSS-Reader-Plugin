<?php

include 'rss-config.php';

add_action( 'load-apis', function() {
  include 'core/get-xml-feed.php';
  include 'core/parse-xml.php';
  include 'api/api-get-rss-feed.php';
});

// Want to ensure that our plugin settings are installed
add_action( 'admin_set_defaults', function() {
  $option_exists = does_row_exist( 'theme_options', 'name', FEED_URLS_OPTION );
  if( !$option_exists ) {
    add_theme_option( FEED_URLS_OPTION, '' );
  }
});