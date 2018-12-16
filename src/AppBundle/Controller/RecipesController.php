<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 16.12.2018
 * Time: 22:15
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Recipe;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;

class RecipesController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     *
     * @param void
     * @return array
     */
    public function getRecipesAction()
    {
        $recipes = $this->getDoctrine()->getRepository('AppBundle:Recipe')->findAll();

        return $recipes;
    }

    /**
     * @Rest\View(statusCode=201)
     * @ParamConverter("recipe", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     *
     * @param Recipe $recipe
     * @return Recipe $recipe
     */
    public function postRecipeAction(Recipe $recipe)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($recipe);
        $em->flush();

        return $recipe;
    }

    /**
     * @Rest\View()
     *
     * @param Recipe $recipe
     * @return View
     */
    public function deleteRecipeAction(Recipe $recipe = null)
    {
        if (null === $recipe) {
            return $this->view(null, 404);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($recipe);
        $em->flush();
    }
}