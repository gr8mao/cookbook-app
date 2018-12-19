<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 16.12.2018
 * Time: 22:15
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Recipe;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationListInterface;

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
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     *
     * @param Recipe $recipe
     * @param ConstraintViolationListInterface $validationErrors
     * @return Recipe $recipe
     */
    public function postRecipeAction(Recipe $recipe, ConstraintViolationListInterface $validationErrors)
    {
        if(count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($recipe);
        $em->flush();

        return $recipe;
    }

    /**
     * @Rest\View()
     *
     * @param Recipe|null $recipe
     * @return View|null
     */
    public function deleteRecipeAction(?Recipe $recipe)
    {
        if (null === $recipe) {
            return $this->view(null, 404);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($recipe);
        $em->flush();

        return null;
    }

    /**
     * @Rest\View()
     * @param Recipe|null $recipe
     * @return Recipe|View
     */
    public function getRecipeAction(?Recipe $recipe)
    {
        if (null === $recipe) {
            return $this->view(null, 404);
        }

        return $recipe;
    }
}