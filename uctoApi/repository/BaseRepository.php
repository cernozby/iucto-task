<?php


namespace uctoApi\repository;

use GuzzleHttp\Client;

/**
 * Class BaseRepository
 * @package uctoApi\repository
 */
class BaseRepository
{
  
  /**
   * @var Client
   */
  protected Client $client;
  
  /**
   * BaseRepository constructor.
   */
  public function __construct() {
    $this->client = new Client();
  }
  
  /**
   * @param array $oldArr
   * @param array $newArr
   * @return array
   */
  protected function actualizeArray(array $oldArr, array $newArr) : array {
    foreach ($oldArr as $key => $value) {
      if (isset($newArr[$key])) {
        $oldArr[$key] = $newArr[$key];
      } else {
        unset($oldArr[$key]);
      }
    }
    return $oldArr;
  }
  
}