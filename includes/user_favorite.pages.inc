<?php

/**
 * @file
 * Save  share data.
 */

/**
 * callback for the favorite save.
 */
function user_favorite_page(){
  global $user;

  $query = db_select('node', 'n')->extend('PagerDefault')->extend('TableSort');
  $query->fields('n', array('nid'));

  $query->InnerJoin('field_data_field_tags', 'tags', "n.`nid` = tags.`entity_id`");

  $query->condition('n.`type`', 'share_element');
  $query->condition('n.`uid`', $user->uid);
  //$query->condition('tags.`field_tags_tid`', $user->uid);

  $query->orderBy('n.changed', 'DESC');

  //$query->orderByHeader($header);
  $query->limit(50);

  $nids = $query->execute()->fetchCol();
  $nodes = node_load_multiple($nids);
  //dsm($nodes);
  $favor_arr = array();
  foreach ($nodes as $node) {

    $image = array_shift(field_get_items('node', $node, 'field_image'));
    $favor_arr[] = array(
      'nid' => $node->nid,
      'title' => $node->title,
      'image' => $image,
      'description' => $node->body,
    );
  }
  $blocks = array();
  if (!empty($favor_arr)){
    $blocks['favorite-grid'] = array(
      '#theme' => 'favorite_grid',
      '#items' => $favor_arr,
      '#options' => array('all_categories' => l(t('All Categories'). '»', '#'), 'by_line' => 1 ),
    );
  }

  dsm($blocks);

  return $blocks;
}