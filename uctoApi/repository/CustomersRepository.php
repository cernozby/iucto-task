<?php
namespace uctoApi\repository;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\InvalidArgumentException;
use uctoApi\Model\Address\Address;
use uctoApi\Model\Customer\Customer;
use uctoApi\Model\Customer\CustomerCollection;
use uctoApi\Model\Customer\CustomerDetail;

/**
 * Class CustomersRepository
 * @package uctoApi\repository
 */
final class CustomersRepository extends BaseRepository {
  
  /**
   * @return string[]
   */
  private function getArrayNewCustomer() : array {
    return array (
      'comid' => '',
      'email' => '',
      'phone' => '',
      'cellphone' => '',
      'customer_group_id' => '',
      'name_display' => '',
      'external_code' => '',
      'www' => '',
      'usual_maturity' => '',
      'note' => '',
      'account_number1' => '',
      'account_number2' => '',
      'account_number3' => '',
      'account_number4' => '',
      'default_department_id' => '',
      'default_contract_id' => '',
      'vatid' => '',
    );
  }
  
  /**
   * @return string[]
   */
  private function getCustomerListArray() : array {
    return array (
      'page' => '',
      'pageSize' => '',
      'name' => '',
      'comid' => '',
      'vatid' => '',
      'vat_payer' => '',
      'phone' => '',
      'account_number' => '',
      'customer_group_id' => '',
      'external_code' => '',
    );
  }
  

  /**
   * @param string $url
   * @param string $apiKey
   * @param string $name
   * @param string $preferred_payment_method
   * @param string $invoice_language
   * @param bool $vat_payer
   * @param Address $address
   * @param array $params
   * @return bool
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function newCustomer(string $url, string $apiKey, string $name, string $preferred_payment_method, string $invoice_language, bool $vat_payer, Address $address, array $params = array()) : bool {
    $array = $this->getArrayNewCustomer();
    if ($vat_payer && !isset($params['vatid'])) {
      throw new InvalidArgumentException('Vatid je poviny parametr');
    }
    
    if (!array_key_exists($invoice_language, CustomerDetail::$invoice_language_enum)) {
      throw new InvalidArgumentException("Hodnota {$invoice_language} neni v promene invoice_language povolena");
    }
    
    if (!array_key_exists($preferred_payment_method, CustomerDetail::$prefer_payment_method_enum)) {
      throw new InvalidArgumentException("Hodnota {$preferred_payment_method} neni v promene prefer payment method povolena");
    }
  
    $array['name'] = $name;
    $array['preferred_payment_method'] = $preferred_payment_method;
    $array['invoice_language'] = $invoice_language;
    $array['vat_payer'] = $vat_payer;
    $array['address'] = $address->toArray();
    $array = $this->actualizeArray($array, $params);
  
    $res = $this->client->request('POST',$url . '/api/1.2/customer', ['form_params' => $array, 'X-Auth-Key' => $apiKey ]);
    if ($res->getStatusCode() !== 201) {
      throw new \RuntimeException('Operace se nepovedla');
    }
    
    return true;
  }

  /**
   * @param string $url
   * @param string $apiKey
   * @param int $customerId
   * @return CustomerDetail
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function getCustomerDetail(string $url, string $apiKey, int $customerId) : CustomerDetail {
    $res = $this->client->request('GET', $url . '/api/1.2/customer/'. $customerId, ['X-Auth-Key' => $apiKey]);
    if ($res->getStatusCode() === 200) {
      $jsonArray = json_decode($res->getBody(), true);
      unset($jsonArray['_link']);
    } else {
      throw new \RuntimeException('Operace se nepovedla');
    }
    
    return new CustomerDetail($jsonArray);
  }
  
  
  /**
   * @param string $url
   * @param string $apiKey
   * @param array $params
   * @return CustomerCollection
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function getCustomersList(string $url, string $apiKey, array $params = []) : CustomerCollection {
    $result = array();
    $urlParams = '';
    $iterator = 0;
    
    $array = $this->getCustomerListArray();
    $array = $this->actualizeArray($array, $params);
    
    foreach ($array as $key => $value) {
      if ($iterator === 0){
        $urlParams  .= '?';
      } else {
        $urlParams .= '&';
      }
      $urlParams .= $key .'='. $value;
    }
    $res = $this->client->request('GET', $url . '/api/1.2/customer' . $urlParams, ['X-Auth-Key' => $apiKey]);
    
    if ($res->getStatusCode() === 200) {
      $jsonArray = json_decode($res->getBody(), true);
      if (isset($jsonArray['_embedded']['customer'])) {
        foreach ($jsonArray['_embedded']['customer'] as $customer) {
          unset($customer['_link']);
          $result[] = new Customer($customer);
        }
      }
    } else {
      throw new \RuntimeException('Operace se nepovedla');
    }
    return new CustomerCollection($result);
  }
  
}
?>