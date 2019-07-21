<?php

namespace Store;

use Store\SellableInterface;
use InvalidArgumentException;

class ProductBundle implements SellableInterface
{

	/**
	 * A collection of sellable items.
	 * @var array 
	 */
	private $sellable;

	/**
	 * @param array $sellable Array of objects that implement SellableInterface.
	 * 
	 * @throws InvalidArgumentException
	 */
	public function __construct(array $sellable)
	{
		foreach ($sellable as $item) {

			if (!($item instanceof SellableInterface)) {

				throw new InvalidArgumentException('Unsupported item type');
			}
		}

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
