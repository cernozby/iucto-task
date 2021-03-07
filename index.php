<?php
declare(strict_types = 1);


use uctoApi\Model\Address\Address;
use uctoApi\UctoApi;

//require_once 'vendor/autoload.php';

spl_autoload_register(function ($class_name) {
  include __DIR__ . '\\' . $class_name . '.php';
});

$uctoApi = new UctoApi('adasdasdad', UctoApi::MOCK_SERVER);
dump($uctoApi->getCustomersList());
dump($uctoApi->getCustomerDetail(123));
dump($uctoApi->getCurrencyList());
$address = new Address('B. Nemocove','Praha', '80091','CZ');
$customers = $uctoApi->newCustomer('Pepa', 'cash', 'cs', false, $address);
?>