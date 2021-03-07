<?php
namespace uctoApi\repository;

require_once __DIR__ . '\BaseRepository.php';

use GuzzleHttp\Exception\GuzzleException;
use uctoApi\model\Currency\Currency;
use uctoApi\Model\Currency\CurrencyCollection;

/**
 * Class CurrencyRepository
 * @package uctoApi\repository
 */
class CurrencyRepository extends BaseRepository {
  
  
  /**
   * @param string $url
   * @param string $apiKey
   * @return CurrencyCollection
   * @throws GuzzleException
   */
  public function getCurrencyList(string $url, string $apiKey) : CurrencyCollection {
      $result = array();
      $res = $this->client->request('GET', $url . '/api/1.2/currency', ['X-Auth-Key' => $apiKey]);
      if ($res->getStatusCode() === 200) {
        $array = json_decode($res->getBody(), true);
        foreach ($array as $item) {
          $result[] = new Currency($item);
        }
      } else {
        throw new \RuntimeException('Operace se nepovedla');
      }

      return new CurrencyCollection($result);
    }
  }
?>