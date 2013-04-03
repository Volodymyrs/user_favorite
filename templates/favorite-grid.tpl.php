<?php

/*
 * block
 */
print_r($item);
?>
<div class="clearfix">
  <?php if (isset($options['title'])) { ?>
    <div class="section-head-centered">
      <div class="section-head-block">
        <h2><?php print t($options['title']); ?></h2>
      </div>
    </div>
  <?php }; ?>
  <?php foreach($items as $key => $item): ?>
    <div class="story<?php ($key % 2 != 0) ? print ' odd' : ''; ?>">
      <div class="image">
        <?php
        $params = array(
          'style_name' => '300w225h',
          'path' => $item['image']['uri'],
          'alt' => $item['image']['alt'],
          'title' => $item['image']['title'],
          'getsize' => TRUE,
        );
        $image = theme('image_style', $params);
        print l($image, 'node/' . $item['nid'], array('html' => TRUE));
        ?>
      </div>
      <?php if (!empty($item['slideshow'])) { ?>
        <div class="overlay">
          <div class="slideshow">
            <?php print l(t('Slideshow'), 'node/' . $item['nid']);  ?>
          </div>
        </div>
      <?php }; ?>
      <?php if ($item['type'] == 'video') { ?>
        <div class="overlay">
          <div class="video">
            <?php print l(t('Video'), 'node/' . $item['nid']);  ?>
          </div>
        </div>
      <?php }; ?>
      <?php if ((isset($item['category'])) && ($options['show_category'] == 1)) { ?>
        <div class="category">
          <?php print implode($item['category'], ', '); ?>
        </div>
      <?php }; ?>
      <div class="title">
        <?php print l(t($item['title']), $item['alias']); ?>
      </div>
      <?php if (!empty($item['author'])) { ?>
        <div class="submitted t-a-11 author">
          <?php print '<em>' . t('by') . '</em> ' . t($item['author']); ?>
        </div>
      <?php }; ?>
    </div>
  <?php endforeach; ?>
  <div class="more">
    <?php if (!empty($options['more_link'])) { print $options['more_link']; }; ?>
  </div>

</div>