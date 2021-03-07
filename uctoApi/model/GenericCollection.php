<?php

namespace uctoApi\Model;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * Class GenericCollection
 * @package uctoApi\Model
 */
abstract class GenericCollection implements IteratorAggregate
{
  /**
   * @var
   */
  protected $values;
  
  /**
   * @return array
   */
  public function toArray(): array {
    return $this->values;
  }
  
  /**
   * @return ArrayIterator|Traversable
   */
  public function getIterator() {
    return new ArrayIterator($this->values);
  }
}
?>