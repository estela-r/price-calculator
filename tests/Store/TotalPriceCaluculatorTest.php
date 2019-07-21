<?php

namespace Tests\Store;

use PHPUnit\Framework\TestCase;
use Store\TotalPriceCalculator;
use Store\ProductBundle;
use Store\Product;

class TotalPriceCalculatorTest extends TestCase
{

	/**
	 * @test total price calculation with 1 product
	 */
	public function one_product()
	{
		$calculator = new TotalPriceCalculator(new Product('Keyboard', 10.23));
		$this->assertEquals(10.23, $calculator->getTotal());
	}

	/**
	 * @test total price calculation with 2 products and 2 bundles.
	 */
	public function two_products_two_bundles()
	{
		$keyboard = new Product('Keyboard', 100.45);
		$mouse = new Product('Mouse', 25.68);
		$headphones = new Product('Headphones', 25.68);
		$firstBundle = new ProductBundle($keyboard, $mouse);
		$secondBundle = new ProductBundle($firstBundle, $headphones);

		$calculator = new TotalPriceCalculator($keyboard, $mouse, $secondBundle, $firstBundle);
		$this->assertEquals(404.07, $calculator->getTotal());
	}

}
