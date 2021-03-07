<?php
namespace uctoApi\Model\Customer;
use uctoApi\Model\Address\Address;

/**
 * Class CustomerDetail
 * @package uctoApi\Model\Customer
 */
final class CustomerDetail {
  /**
   * @var string[]
   */
  public static $prefer_payment_method_enum = array (
    'transfer' => 'Bankovním převodem',
    'cash' => 'v hotovosti',
    'proforma' => 'Proforma',
    'chedck' => 'Šekem',
    'creditcard' => 'Platební kartou'
  );
  
  /**
   * @var string[]
   */
  public static $invoice_language_enum = array (
    'cs' => 'česky',
    'en' => 'slovensky',
    'sk' => 'anglicky',
    'de' => 'německy'
  );
  
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
   * @var string|null
   */
  private ?string $name_display;
  /**
   * @var string|null
   */
  private ?string $external_code;
  /**
   * @var string|null
   */
  private ?string $www;
  /**
   * @var int
   */
  private int $usual_maturity;
  /**
   * @var string
   */
  private string $preferred_payment_method;
  /**
   * @var string
   */
  private string $invoice_language;
  /**
   * @var Address
   */
  private Address $address;
  /**
   * @var string|null
   */
  private ?string $note;
  /**
   * @var string|null
   */
  private ?string $account_number1;
  /**
   * @var string|null
   */
  private ?string $account_number2;
  /**
   * @var string|null
   */
  private ?string $account_number3;
  /**
   * @var string|null
   */
  private ?string $account_number4;
  /**
   * @var int|null
   */
  private ?int $default_department_id;
  /**
   * @var int|null
   */
  private ?int $default_contract_id;
  /**
   * @var string|null
   */
  private ?string $vatid;
  /**
   * @var bool
   */
  private bool $vat_payer;
  
  
  /**
   * CustomerDetail constructor.
   * @param array $array
   */
  public function __construct(array $array) {
    foreach ($array as $key => $value) {
      if ($key === 'address') {
        $this->$key = new Address(...array_values($value));
      } else {
        $this->$key = $value;
      }
    }
  }
  
  /**
   * @return string
   */
  public function getInvoiceLanguageFull() {
    return self::$invoice_language_enum[$this->invoice_language];
  }
  
  /**
   * @return string
   */
  public function getPreferPaymentMethodCzech() {
    return self::$prefer_payment_method_enum[$this->preferred_payment_method];
  }
  
  /**
   * @return array
   */
  public function toArray(): array {
    return get_object_vars($this);
  }
  
}
?>


