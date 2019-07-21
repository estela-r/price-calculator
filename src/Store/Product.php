<?php

namespace Store;

use Store\SellableInterface;
use Store\Exceptions\InvalidPriceException;

class Product implements SellableInterface
{

	private $name;
	private $price;

	public function __construct(string $name, float $price)
	{
		$this->name = $name;

		if ($price < 0) {

			throw new InvalidPriceException(sprintf("Price of %s cannot be negative", $name));
		}

		$this->price = $price;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

}
