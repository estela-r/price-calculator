<?php

namespace Tests\Store;

use PHPUnit\Framework\TestCase;
use Store\Product;
use Store\Exceptions\InvalidPriceException;

/**
 * Run tests: vendor\bin\phpunit tests
 */
class ProductTest extends TestCase
{

	/**
	 * @test that product cannot have negative price.
	 */
	public function negative_price()
	{
		$this->expectException(InvalidPriceException::class);
		$mouse = new Product("Mouse", -2);
	}

	/**
	 * @test that product can have zero price.
	 */
	public function zero_price()
	{
		$mouse = new Product("Mouse", 0);
		$this->assertEquals(0, $mouse->getPrice());
	}

}
