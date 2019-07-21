<?php

namespace Store;

use Store\SellableInterface;

class TotalPriceCalculator
{

	/**
	 * A collection of sellable items.
	 * 
	 * @var array 
	 */
	private $items;

	public function __construct(SellableInterface ...$items)
	{

		$this->items = $items;
	}

	/**
	 * Calculates the total price of all the products and bundles.
	 * 
	 * @return float
	 */
	public function getTotal(): float
	{
		$total = 0;

		foreach ($this->items as $item) {

			$total += $item->getPrice();
		}

		return $total;
	}

}
