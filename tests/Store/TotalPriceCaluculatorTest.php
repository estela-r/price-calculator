<?php

namespace Tests\Store;

use PHPUnit\Framework\TestCase;
use Store\TotalPriceCalculator;
use Store\SellableInterface;

class TotalPriceCalculatorTest extends TestCase
{

	/**
	 * @test that type error is raised
	 * when wrong parameter type is passed to constructor.
	 */
	public function error_on_wrong_parameter_type()
	{
		$this->expectException(\TypeError::class);
		new TotalPriceCalculator(...[123]);
	}

	/**
	 * @test that total price is 0 when no items are passed to the calculator.
	 */
	public function no_product()
	{
		$calculator = new TotalPriceCalculator(...[]);
		$this->assertEquals(0, $calculator->getTotal());
	}

	/**
	 * @test total price calculation with 1 item.
	 */
	public function one_product()
	{
		$product = $this->createMock(SellableInterface::class);
		$product->method('getPrice')
				->willReturn(10.23);
		$calculator = new TotalPriceCalculator($product);
		$this->assertEquals(10.23, $calculator->getTotal());
	}

	/**
	 * @test total price calculation with multiple items.
	 */
	public function one_product_one_bundle()
	{
		$keyboard = $this->createMock(SellableInterface::class);
		$keyboard->method('getPrice')
				->willReturn(100.45);

		$firstBundle = $this->createMock(SellableInterface::class);
		$firstBundle->method('getPrice')
				->willReturn(200.45);

		$calculator = new TotalPriceCalculator($keyboard, $firstBundle);
		$this->assertEquals(300.90, $calculator->getTotal());
	}

}
