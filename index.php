<?php

require 'vendor/autoload.php';

use Store\{
	Product,
	ProductBundle,
	TotalPriceCalculator
};

$keyboard = new Product('Keyboard', 100.45);
$mouse = new Product('Mouse', 25.68);
$headphones = new Product('Headphones', 25.68);
$firstBundle = new ProductBundle(...[$keyboard, $mouse]);
$secondBundle = new ProductBundle(...[$firstBundle, $headphones]);
$calculator = new TotalPriceCalculator(...[$keyboard, $mouse, $secondBundle, $firstBundle]);
$total = $calculator->getTotal();
print_r($total);



