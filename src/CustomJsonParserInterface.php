<?php

namespace Drupal\custom_json_parser;
/**
 * Interface CustomJsonParserInterface.
 *
 * @package Drupal\custom_json_parser
 */
interface CustomJsonParserInterface {
  /**
   * Provides json parse nodes.
   *
   * @param string $parse_url
   *
   * @return mixed
   */
  public function parsenodes($parse_url);

}
