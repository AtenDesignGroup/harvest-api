<?php

namespace Drupal\harvest_api;

use GuzzleHttp\Client;

/**
 * Generic RESTful client for Harvest API.
 */
class HarvestApiClient {

  /**
   * Base URI for requests.
   *
   * @var string
   */
  protected $baseUri = 'https://api.harvestapp.com/v2/';

  /**
   * HTTP Client for making API requests.
   *
   * @var GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * Harvest Account ID.
   *
   * @var int
   */
  protected $accountId;

  /**
   * Harvest Personal Access Token.
   *
   * @var string
   */
  protected $accessToken;

  /**
   * HarvestAPI constructor.
   *
   * @param \GuzzleHttp\Client $http_client
   *   The http client service.
   */
  public function __construct(
    Client $http_client
  ) {
    $this->httpClient = $http_client;
  }

  /**
   * Store authorization credentials for requests.
   *
   * Uses personal access token.
   * See https://help.getharvest.com/api-v2/authentication-api/authentication/authentication/.
   *
   * @param string $access_token
   *   The access token.
   * @param int $account_id
   *   The account id.
   */
  public function setCredentials($access_token, $account_id) {
    $this->accessToken = $access_token;
    $this->accountId = $account_id;
  }

  /**
   * Generic request method.
   */
  public function request($method, $endpoint, $query_params = []) {

    $params = [
      'headers' => [
        'Harvest-Account-ID' => $this->accountId,
        'Authorization' => 'Bearer ' . $this->accessToken,
        'User-Agent' => 'Aten Dashboard',
      ],
      'query' => $query_params,
    ];

    $result = $this->httpClient->{$method}(
      $this->baseUri . $endpoint,
      $params
    );
    $json_response = json_decode((string) $result->getBody(), TRUE);

    return $json_response;
  }

  /**
   * Get request method.
   */
  public function get($endpoint, $params = []) {
    return $this->request('GET', $endpoint, $params);
  }

}
