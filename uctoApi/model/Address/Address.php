<?php
namespace uctoApi\Model\Address;

use GuzzleHttp\Exception\InvalidArgumentException;

/**
 * Class Address
 * @package uctoApi\Model\Address
 */
final class Address
{
  
  /**
   * @var string[]
   */
  public static $stateEnum = array(
    'CZ' => 'Čerská Republika',
    'AE' => 'Spojené Arabské Emiráty',
    'AF' => 'Afgánistán',
    'AG' => 'Antigua a Barbuda'
  );
  
  /**
   * @var string|null
   */
  private ?string $street;
  /**
   * @var string|null
   */
  private ?string $city;
  /**
   * @var string|null
   */
  private ?string $postalcode;
  /**
   * @var string|null
   */
  private ?string $country;
  
  /**
   * Address constructor.
   * @param string|null $street
   * @param string|null $city
   * @param string|null $postalcode
   * @param string|null $country
   */
  public function __construct(?string $street = null, ?string $city = null,  ?string $postalcode = null, ?string $country = null ) {
    if ($country && !array_key_exists($country, self::$stateEnum)) {
      throw new InvalidArgumentException("Hodnota {$country} neni v promene country povolena");
    }
    $this->street = $street;
    $this->city = $city;
    $this->postalcode = $postalcode;
    $this->country = $country;
    
  }
  
  /**
   * @return string[]
   */
  public static function getStateEnum(): array {
    return self::$stateEnum;
  }
  
  /**
   * @return string|null
   */
  public function getStreet(): ?string {
    return $this->street;
  }
  
  /**
   * @return string|null
   */
  public function getCity(): ?string {
    return $this->city;
  }
  
  /**
   * @return string|null
   */
  public function getPostalcode(): ?string {
    return $this->postalcode;
  }
  
  /**
   * @return string|null
   */
  public function getCountry(): ?string {
    return $this->country;
  }
  
  /**
   * @return array
   */
  public function toArray() : array {
    return get_object_vars($this);
  }
  
  /**
   * @return string|null
   */
  public function getCountryFullName() :? string {
    return $this->country === null ? null : self::$stateEnum[$this->country];
  }
  
}
?>