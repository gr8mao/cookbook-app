<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-24
 * Time: 21:28
 */

namespace AppBundle\Controller;


use AppBundle\Entity\ProductType;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProductTypeController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     * @Rest\Route("/productTypes/{productType}")
     *
     * @param ProductType|null $productType
     * @return ProductType|View|null
     */
    public function getProductTypeAction(?ProductType $productType)
    {
        if (null === $productType) {
            return $this->view(null, 404);
        }

        return $productType;
    }

    /**
     * @Rest\View()
     * @Rest\Route("/productTypes/")
     *
     * @return array
     */
    public function getProductTypesAction()
    {
        $productTypes = $this->getDoctrine()->getRepository('AppBundle:ProductType')->findAll();

        return $productTypes;
    }
}