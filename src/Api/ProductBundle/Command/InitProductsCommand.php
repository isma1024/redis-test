<?php

namespace Api\ProductBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Api\ProductBundle\Entity\Product;

/**
 * Class InitProductsCommand
 * @package Api\ProductBundle\Command
 */
class InitProductsCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName("products:init")
			->setDefinition(array())
			->setDescription("")
			->setHelp("");
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$productRepository      = $this->getContainer()->get("product.repository");
		$productRedisRepository = $this->getContainer()->get("product.redis.repository");

		for ($i = 0; $i < 1000; $i++) {
			//create product on database
			$product = $productRepository->create(new Product(
				null,
				"Product " . $i,
				"Product description" . $i,
				1.1 * $i
			));

			//create product on redis
			$productRedisRepository->create($product);
		}
	}
}