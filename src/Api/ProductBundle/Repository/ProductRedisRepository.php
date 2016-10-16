<?php

namespace Api\ProductBundle\Repository;

use Api\ProductBundle\Entity\Product;
use Predis\Client;

class ProductRedisRepository
{
	/**
	 * Client
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Constructor
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @param $id
	 * @return Product
	 */
	public function find($id)
	{
		$key = "product_" . $id;

		$product = $this->client->exists($key)
			? json_decode($this->client->get($key), true)
			: false
		;

		return new Product(
			$product['id'],
			$product['name'],
			$product['description'],
			$product['price']
		);
	}

	/**
	 * @param Product $product
	 * @return Product
	 */
	public function create(Product $product)
	{
		$key = "product_" . $product->getId();

		$this->client->set($key, json_encode([
			'id'            => $product->getId(),
			'name'          => $product->getName(),
			'description'   => $product->getDescription(),
			'price'         => $product->getPrice(),
		]));

		return $product;
	}
}