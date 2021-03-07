<?php
namespace uctoApi\Model\Currency;
/**
 * Class Currency
 * @package uctoApi\Model\Currency
 */
final class Currency

{
  /**
   * @var string
   */
  private string $currency;
  
  /**
   * Currency constructor.
   * @param string $currency
   */
  public function __construct(string $currency) {
    $this->currency = $currency;
  }
  
  /**
   * @return string
   */
  public function getCurrency(): string {
    return $this->currency;
  }
  
  
}
?>