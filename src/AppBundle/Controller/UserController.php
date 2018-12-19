<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-19
 * Time: 20:56
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Recipe;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UserController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     *
     * @param void
     * @return array
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $users;
    }

    /**
     * @Rest\View(statusCode=201)
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     *
     * @param User $user
     * @param ConstraintViolationListInterface $validationErrors
     * @return User $user
     */
    public function postUserAction(User $user, ConstraintViolationListInterface $validationErrors)
    {
        if(count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $user;
    }

    /**
     * @Rest\View()
     *
     * @param User|null $user
     * @return View|null
     */
    public function deleteUserAction(?User $user)
    {
        if (null === $user) {
            return $this->view(null, 404);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return null;
    }

    /**
     * @Rest\View()
     * @param User|null $user
     * @return User|View
     */
    public function getUserAction(?User $user)
    {
        if (null === $user) {
            return $this->view(null, 404);
        }

        return $user;
    }

    /**
     * @Rest\View()
     * @param User $user
     *
     * @return ArrayCollection
     */
    public function getUserRecipesAction(User $user)
    {
        return $user->getRecipes();
    }

    /**
     * @Rest\View(statusCode=201)
     * @ParamConverter("recipe", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     * 
     * @param User $user
     * @param Recipe $recipe
     *
     * @return Recipe
     */
    public function postUserRecipesAction(User $user, Recipe $recipe)
    {
         $recipe->setUser($user);

         $em = $this->getDoctrine()->getManager();
         $em->persist($recipe);

         $user->getRecipes()->add($recipe);
         $em->persist($user);

         $em->flush();

         return $recipe;
    }
}