<?php

namespace Store;

use Store\SellableInterface;

class ProductBundle implements SellableInterface
{

	/**
	 * A collection of sellable items.
	 * @var array 
	 */
	private $sellable;

	public function __construct(SellableInterface ...$sellable)
	{
		$this->sellable = $sellable;
	}

	/**
	 * Calculates the total price of the bundle.
	 * 
	 * @return float
	 */
	public function getPrice(): float
	{
		$bundlesPrice = 0;

		foreach ($this->sellable as $bundle) {

			$bundlesPrice += $bundle->getPrice();
		}

		return $bundlesPrice;
	}

}
