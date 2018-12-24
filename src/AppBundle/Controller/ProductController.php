<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-24
 * Time: 17:55
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Product;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ProductController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     *
     * @param Product|null $product
     * @return Product|\FOS\RestBundle\View\View|null
     */
    public function getProductAction(?Product $product)
    {
        if (null === $product) {
            return $this->view(null, 404);
        }

        return $product;
    }

    /**
     * @Rest\View()
     *
     * @return Product[]|\AppBundle\Entity\Recipe[]|array|object[]
     */
    public function getProductsAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

        return $products;
    }

    /**
     * @Rest\View()
     * 
     * @param Product|null $product
     * @return View|null
     */
    public function deleteProductAction(?Product $product)
    {
        if (null === $product) {
            return $this->view(null, 404);
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $em->remove($product);
        $em->flush();
        
        return null;
    }

    /**
     * @Rest\View(statusCode=201)
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     *
     * @param Product $product
     * @param ConstraintViolationListInterface $validationErrors
     *
     * @return Product $recipe
     */
    public function postProductAction(Product $product, ConstraintViolationListInterface $validationErrors)
    {
        if(count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $product;
    }
}