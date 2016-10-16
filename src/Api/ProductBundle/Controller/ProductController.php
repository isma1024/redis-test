<?php

namespace Api\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class ProductController
 * @package Api\ProductBundle\Tests\Controller
 */
class ProductController extends Controller
{
    /**
     * Gets list of products.
     *
     * @ApiDoc(
     *     section="Products",
     *     resource=true,
     *     statusCodes={
     *         200="OK",
     *         400="Invalid filtering data",
     *         403="Authentication Failed",
     *         500="Internal error"
     *     },
     *     tags={"beta" = "#0080FF"},
     * )
     *
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($page = 1)
    {
        return $this->get('product.handler')->productList($page);
    }

	/**
	 * Gets one of products by id.
	 *
	 * @ApiDoc(
	 *     section="Products",
	 *     resource=true,
	 *     statusCodes={
	 *         200="OK",
	 *         400="Invalid filtering data",
	 *         403="Authentication Failed",
	 *         500="Internal error"
	 *     },
	 *     tags={"beta" = "#0080FF"},
	 * )
	 *
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getAction($id)
	{
		return $this->get('product.handler')->get($id);
	}

}