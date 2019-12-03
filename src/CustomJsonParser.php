<?php


namespace Drupal\custom_json_parser;

use GuzzleHttp\Client;
use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\Component\Serialization\Json;


/**
 * Class JsonPlaceholderParser.
 *
 * @package Drupal\json_placeholder_parser
 */
class CustomJsonParser implements CustomJsonParserInterface {

  /**
   * The Guzzle HTTP Client service.
   *
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * The logger service.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactory
   */
  protected $logger;

  /**
   * The json serialization service.
   *
   * @var \Drupal\Component\Serialization\Json
   */
  protected $json;

  /**
   * JsonPlaceholderParser constructor.
   *
   * @param \GuzzleHttp\Client $http_client
   *   The HTTP client.
   * @param \Drupal\Core\Logger\LoggerChannelFactory $logger
   *   The logger.
   * @param \Drupal\Component\Serialization\Json $json
   *   The json.
   */
  public function __construct(
    Client $http_client,
    LoggerChannelFactory $logger,
    Json $json
  ) {
    $this->httpClient = $http_client;
    $this->logger = $logger->get('json_placeholder_parser');
    $this->json = $json;
  }

  /**
   * Provides json parse nodes.
   *
   * {@inheritdoc}
   *
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function parsenodes($parse_url) {
    try {
      $response = $this->httpClient->request(
        'GET',
        $parse_url,
        []
      );
      $response = $this->json->decode($response->getBody());
    } catch (\Exception $e) {
      echo "Exception: " . $e->getMessage() . "\n";
    }

    return $response;
  }

}
