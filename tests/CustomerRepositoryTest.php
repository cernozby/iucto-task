<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use uctoApi\Model\Address\Address;
use uctoApi\Model\Customer\CustomerDetail;
use uctoApi\repository\CustomersRepository;
use uctoApi\UctoApi;


require_once __DIR__ .'/../loader.php';

class CustomerRepositoryTest extends TestCase
{
  
  public function GetUrl() {
    $uctoApi = new UctoApi('adasdasd', UctoApi::MOCK_SERVER);
    return $uctoApi->getUrl();
    
  }
  public function testNewCustomer() : void {
    
    $customer = new CustomersRepository();
    $result = $customer->newCustomer($this->getUrl(),
                           'adasdasd',
                           'Jan',
                           'cash',
                           'cs',
                           false,
                           new Address(),
                           []);
    self::assertTrue($result);
  }
  
  public function testNewCustomerException() : void {
    $customer = new CustomersRepository();
  
    $this->expectException(\GuzzleHttp\Exception\InvalidArgumentException::class);
    $customer->newCustomer($this->getUrl(),
                           'adasdasd',
                           'adasdasd',
                           'cashsssss',
                           'cs',
                           false,
                           new Address(),
                           []);
    
    $this->expectException(\GuzzleHttp\Exception\InvalidArgumentException::class);
    $customer->newCustomer($this->getUrl(),
                           'adasdasd',
                           'adasdasd',
                           'cash',
                           'cssdadasd',
                           false,
                           new Address(),
                           []);
  
    $this->expectException(\GuzzleHttp\Exception\InvalidArgumentException::class);
    $customer->newCustomer($this->getUrl(),
                           'adasdasd',
                           'adasdasd',
                           'cash',
                           'cs',
                           true,
                           new Address(),
                           []);
  }
  
}

















?>
