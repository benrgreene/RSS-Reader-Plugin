<?php

// Get the day's meme
API_Register::get_instance()->add_endpoint( 
  'get/rss/reader',
  'brg_api_get_rss_reader_content'
);

function brg_api_get_rss_reader_content( $data ) {
  $feed = get_xml_feed(); ?>
  <div class="feed">
    <?php foreach( $feed as $item ) { ?>
      <div class="item">
        <h3 class="item__title"><?php echo $item['title']; ?></h3>
        <p class="item__date"><?php echo date( 'M dS, Y', $item['pubDate'] ); ?></p>
        <p class="item__excerpt"><?php echo ((string) $item['description']); ?></p>
        <a class="item__link" href="<?php echo $item['link']; ?>">View Full Article</a>
      </div>
    <?php } ?>
  </div>
  <?php die();
}