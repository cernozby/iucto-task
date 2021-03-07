<?php
namespace uctoApi\Model\Customer;
/**
 * Class Customer
 * @package uctoApi\Model\Customer
 */
final class Customer
{
  /**
   * @var int
   */
  private int $id;
  /**
   * @var string
   */
  private string $name;
  /**
   * @var string|null
   */
  private ?string $comid;
  /**
   * @var string|null
   */
  private ?string $email;
  /**
   * @var string|null
   */
  private ?string $phone;
  /**
   * @var string|null
   */
  private ?string $cellphone;
  /**
   * @var int|null
   */
  private ?int $customer_group_id;
  /**
   * @var bool
   */
  private bool $vat_payer;
  /**
   * @var string|null
   */
  private ?string $vatId;
  
  
  /**
   * Customer constructor.
   * @param array $array
   */
  public function __construct(array $array) {
    foreach ($array as $key => $value) {
      $this->$key = $value;
    }
  }
  
  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }
  
  /**
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }
  
  /**
   * @return string
   */
  public function getComid(): string {
    return $this->comid;
  }
  
  /**
   * @return string
   */
  public function getEmail(): string {
    return $this->email;
  }
  
  /**
   * @return string
   */
  public function getPhone(): string {
    return $this->phone;
  }
  
  /**
   * @return string
   */
  public function getCellphone(): string {
    return $this->cellphone;
  }
  
  /**
   * @return int
   */
  public function getCustomerGroupId(): int {
    return $this->customer_group_id;
  }
  
  /**
   * @return bool
   */
  public function isVatPayer(): bool {
    return $this->vat_payer;
  }
  
  /**
   * @return string
   */
  public function getVatId(): string {
    return $this->vatId;
  }
  
  /**
   * @return array
   */
  public function toArray() : array {
    return get_object_vars($this);
  }
}
?>