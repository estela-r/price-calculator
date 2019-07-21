<?php

namespace Store;

use Store\SellableInterface;
use DomainException;

class TotalPriceCalculator
{

	/**
	 * A collection of sellable items.
	 * 
	 * @var array 
	 */
	private $items;

	public function __construct(array $sellable)
	{
		foreach ($sellable as $item) {

			if (!($item instanceof SellableInterface)) {

				throw new DomainException("Item is not valid for price calculation");
			}

			$this->items[] = $item;
		}
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
