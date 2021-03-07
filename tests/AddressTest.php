<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use uctoApi\Model\Address\Address;

require_once __DIR__ .'/../loader.php';

class AddressTest extends TestCase
{
  
  public function testProperlyCreated() : void {
    $address = new Address('adasd', 'asdasda', 'adadad', 'CZ');
    self::assertInstanceOf(Address::class, $address );
  }
  
  public function  testWrongStateEnum(): void {
    $this->expectException(\GuzzleHttp\Exception\InvalidArgumentException::class);
    $address = new Address('adasd', 'asdasda', 'adadad', 'POP');
  }
  
  public function testWrongDataType(): void {
      $this->expectException(TypeError::class);
      $address = new Address(111, 'asdasda', 'adadad', 'CZ');
  }
  
  public function testEmptyAddress(): void {
    $address = new Address();
    self::assertInstanceOf(Address::class, $address );
    self::assertSame($address->toArray(), ['street' => null, 'city' => null, 'postalcode' => null, 'country' => null]);
    self::assertNull($address->getCountryFullName());
  }
  

}

















?>
