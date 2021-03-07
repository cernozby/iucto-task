<?php
namespace uctoApi;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\InvalidArgumentException;
use uctoApi\Model\Address\Address;
use uctoApi\Model\Currency\CurrencyCollection;
use uctoApi\Model\Customer\CustomerCollection;
use uctoApi\Model\Customer\CustomerDetail;
use uctoApi\repository\CurrencyRepository;
use uctoApi\repository\CustomersRepository;

/**
 * Class UctoApi
 * @package uctoApi
 */
class UctoApi {
  
  /**
   *
   */
  public const MOCK_SERVER = 0;
  /**
   *
   */
  public const PRODUCTION = 1;
  
  /**
   * @var array|string[]
   */
  public static array $urls = array(
    self::MOCK_SERVER => 'https://private-anon-d74a31524d-iucto.apiary-mock.com',
    self::PRODUCTION => 'https://online.iucto.cz'
  );
  
  /**
   * @var CurrencyRepository
   */
  private CurrencyRepository $currencyRepository;
  /**
   * @var CustomersRepository
   */
  private CustomersRepository $customersRepository;
  /**
   * @var string
   */
  private string $apiKey;
  /**
   * @var mixed|string
   */
  private string $url;
  
  /**
   * @return mixed|string
   */
  public function getUrl() {
    return $this->url;
  }
  
  /**
   * UctoApi constructor.
   * @param string $apiKey
   * @param int $url
   */
  public function __construct(string $apiKey, int $urlKey = self::MOCK_SERVER ) {
    if (!isset(self::$urls[$urlKey])) {
      throw new InvalidArgumentException('Wrong key of url');
    }
    
    $this->apiKey = $apiKey;
    $this->url = self::$urls[$urlKey];
    $this->currencyRepository = new currencyRepository();
    $this->customersRepository = new CustomersRepository();
    
  }
  
  /**
   * @return CurrencyCollection
   */
  public function getCurrencyList () : CurrencyCollection {
    return $this->currencyRepository->getCurrencyList($this->url, $this->apiKey);
  }
  
  /**
   * @param array $params
   * @return CustomerCollection
   * @throws GuzzleException
   */
  public function getCustomersList($params = []) : CustomerCollection {
    return $this->customersRepository->getCustomersList($this->url, $this->apiKey, $params);
  }
  
  /**
   * @param int $idCustomer
   * @return CustomerDetail
   * @throws GuzzleException
   */
  public function getCustomerDetail(int $idCustomer) : CustomerDetail {
    return $this->customersRepository->getCustomerDetail($this->url, $this->apiKey, $idCustomer);
  }
  
  /**
   * @param string $name
   * @param string $preferred_payment_method
   * @param string $invoice_language
   * @param bool $vat_payer
   * @param Address $address
   * @param array $params
   * @return bool
   * @throws GuzzleException
   */
  public function newCustomer(string $name, string $preferred_payment_method, string $invoice_language, bool $vat_payer, Address $address, array $params = array()) : bool {
    return $this->customersRepository->newCustomer($this->url, $this->apiKey, ...func_get_args());
  }
  
}
?>