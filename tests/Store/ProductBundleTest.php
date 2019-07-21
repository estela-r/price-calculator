<?php

namespace Tests\Store;

use PHPUnit\Framework\TestCase;
use Store\{
	Product,
	ProductBundle
};

class ProductBundleTest extends TestCase
{

	/**
	 * @test price calculation of empty bundle.
	 */
	public function empty_bundle()
	{
		$bundle = new ProductBundle();
		$this->assertEquals(0, $bundle->getPrice());
	}

	/**
	 * @test that getPrice() will throw exception if there is an invalid item
	 * in the array of products and bundles.
	 */
	public function invalid_arg_exception()
	{
		$this->expectException(\TypeError::class);

		$bundle = new ProductBundle('asdf');
		$bundle->getPrice();
	}

	/**
	 * @test price calculation of bundle with:
	 * 	- 1 product
	 */
	public function one_product()
	{
		$keyboard = new Product('Keyboard', 10);

		$bundle = new ProductBundle($keyboard);
		$this->assertEquals(10, $bundle->getPrice());
	}

	/**
	 * @test price calculation of bundle with:
	 * 	- 2 products
	 */
	public function two_products()
	{
		$mouse = new Product('Mouse', 5);
		$keyboard = new Product('Keyboard', 10);

		$bundle = new ProductBundle($mouse, $keyboard);
		$this->assertEquals(15, $bundle->getPrice());
	}

	/**
	 * @test price calculation with floats:
	 */
	public function two_products_float()
	{
		$mouse = new Product('Mouse', 5.20);
		$keyboard = new Product('Keyboard', 10.21);

		$bundle = new ProductBundle($mouse, $keyboard);
		$this->assertEquals(15.41, $bundle->getPrice());
	}

	/**
	 * @test price calculation of bundle with:
	 * 	- 1 bundle with:
	 * 		- 1 product
	 */
	public function one_bundle()
	{
		$keyboard = new Product('Keyboard', 10);
		$firstBundle = new ProductBundle($keyboard);

		$secondBundle = new ProductBundle($firstBundle);
		$this->assertEquals(10, $secondBundle->getPrice());
	}

	/**
	 * @test price calculation of bundle with:
	 * 	- 2 products
	 * 	- 1 bundle with:
	 * 		- 1 bundle with:
	 * 			- 1 product
	 */
	public function nested_bundle()
	{
		$mouse = new Product('Mouse', 5);
		$keyboard = new Product('Keyboard', 10);
		$firstBundle = new ProductBundle($keyboard);

		$secondBundle = new ProductBundle($firstBundle, $mouse);
		$this->assertEquals(15, $secondBundle->getPrice());
	}

	/**
	 * @test price calculation of bundle with:
	 * 	- 1 product
	 * 	- 1 bundle with:
	 * 		- 2 products
	 */
	public function product_and_bundle_of_two_products()
	{
		$mouse = new Product('Mouse', 5);
		$keyboard = new Product('Keyboard', 10);
		$headphones = new Product('Headphones', 15);
		$firstBundle = new ProductBundle($mouse, $keyboard);

		$secondBundle = new ProductBundle($firstBundle, $headphones);
		$this->assertEquals(30, $secondBundle->getPrice());
	}

	/**
	 * @test price calculation of bundle with:
	 * 	- 2 products
	 * 	- 1 bundle with:
	 * 		- 2 products
	 * 	- 1 bundle with:
	 * 		- 1 bundle with:
	 * 			- 2 products
	 * 		- 1 product
	 */
	public function two_products_two_bundles()
	{
		$keyboard = new Product('Keyboard', 10);
		$mouse = new Product('Mouse', 5);
		$headphones = new Product('Headphones', 15);
		$firstBundle = new ProductBundle($mouse, $keyboard);
		$secondBundle = new ProductBundle($firstBundle, $headphones);

		$thirdBundle = new ProductBundle($keyboard, $mouse, $firstBundle, $secondBundle);
		$this->assertEquals(60, $thirdBundle->getPrice());
	}

	/**
	 * @test price calculation of bundle with:
	 * 	- 1 product
	 * 	- 1 bundle with:
	 * 		- 2 products
	 * 		- 1 bundle with:
	 * 			- 2 products
	 * 		- 1 bundle with:
	 * 			- 2 products
	 */
	public function two_nested_bundles()
	{
		$keyboard = new Product('Keyboard', 10);
		$mouse = new Product('Mouse', 5);
		$headphones = new Product('Headphones', 15);
		$firstBundle = new ProductBundle($mouse, $keyboard);
		$secondBundle = new ProductBundle($firstBundle, $headphones);
		$thirdBundle = new ProductBundle($keyboard, $mouse, $firstBundle, $secondBundle);

		$fourthBundle = new ProductBundle($thirdBundle, $mouse);
		$this->assertEquals(65, $fourthBundle->getPrice());
	}

}
