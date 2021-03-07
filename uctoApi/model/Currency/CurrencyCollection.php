<?php
namespace uctoApi\Model\Currency;

use uctoApi\Model\GenericCollection;

require_once __DIR__ . '\..\GenericCollection.php';

/**
 * Class CurrencyCollection
 * @package uctoApi\Model\Currency
 */
final class CurrencyCollection extends GenericCollection
{
  /**
   * CurrencyCollection constructor.
   * @param array $currency
   */
  public function __construct(array $currency)
  {
    $this->values = $currency;
  }
}


?>