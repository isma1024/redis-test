<?php

namespace Api\ProductBundle\Handler;

use Api\ProductBundle\Repository\ProductRedisRepository;
use Api\ProductBundle\Repository\ProductRepository;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductHandler
 * @package Api\ProductBundle\Handler
 */
class ProductHandler
{
	/**
	 * @var ProductRepository
	 */
	protected $productRepository;

	/**
	 * @var ProductRedisRepository
	 */
	protected $productRedisRepository;

	/**
	 * @var Serializer
	 */
	protected $serializer;

	/**
	 * ProductHandler constructor.
	 * @param ProductRepository $productRepository
	 * @param ProductRedisRepository $productRedisRepository
	 * @param Serializer $serializer
	 */
	public function __construct(ProductRepository $productRepository, ProductRedisRepository $productRedisRepository, Serializer $serializer)
	{
		$this->productRepository        = $productRepository;
		$this->productRedisRepository   = $productRedisRepository;
		$this->serializer               = $serializer;
	}

	/**
	 * @return Response
	 */
	public function productList($page)
	{
		$limit = [
			'limit'     => 9 * $page,
			'offset'    => 0,
		];

		$products = $this->productRepository->all($limit);

		$response = array(
			'products'  => $products,
			'result'    => array(
				'code'      => 0,
				'message'   => '',
			),
		);

		$response = $this->serializer->serialize($response, 'json', SerializationContext::create()->setGroups(array('Default')));

		return new Response($response);
	}

	/**
	 * @param $id
	 * @return Response
	 */
	public function get($id)
	{
		$product = $this->productRedisRepository->find($id);

		$response = array(
			'product'   => $product,
			'result'    => array(
				'code'      => 0,
				'message'   => '',
			),
		);

		$response = $this->serializer->serialize($response, 'json', SerializationContext::create()->setGroups(array('Default')));

		return new Response($response);
	}
}
