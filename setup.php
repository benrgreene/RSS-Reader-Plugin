<?php

add_action( 'load-apis', function() {
  include 'core/get-xml-feed.php';
  include 'core/parse-xml.php';
  include 'api/api-get-rss-feed.php';
});