<?php

namespace Drupal\custom_json_parser\Controller;

use Drupal\Core\Controller\ControllerBase;


/**
 * An Json Parse controller.
 */
class CustomJsonParserController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    $parsenodes = \Drupal::service('custom_json_parser.parser');
    $url = "https://www.supplychaindigital.com/api/v1/topic";
    $parser = $parsenodes->parsenodes($url);
    //  Get 5 last items from array.
    $items = array_slice($parser, 0, 5, true);

    $nodes = [];
    foreach ($items as $item) {
      $nodes[] = [
        'title' => $item['node_title'],
        'img' => $item['node_img'],
        'url' => $item['node_url']
      ];
    }

    return [
      '#theme' => 'custom_json_parser_controller',
      '#nodes' => $nodes
    ];
  }

}
