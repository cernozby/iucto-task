<?php
namespace uctoApi\Model\Customer;


require_once __DIR__ . '\CustomerCollection.php';
use uctoApi\Model\GenericCollection;


/**
 * Class CustomerCollection
 * @package uctoApi\Model\Customer
 */
final class CustomerCollection extends GenericCollection
{
  /**
   * CustomerCollection constructor.
   * @param array $customers
   */
  public function __construct(array $customers)
  {
    $this->values = $customers;
  }
}


?>