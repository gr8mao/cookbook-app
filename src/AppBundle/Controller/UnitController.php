<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-24
 * Time: 21:40
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Unit;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;

class UnitController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     *
     * @return array
     */
    public function getUnitsAction()
    {
        $units = $this->getDoctrine()->getRepository('AppBundle:Unit')->findAll();

        return $units;
    }

    /**
     * @Rest\View()
     *
     * @param Unit|null $unit
     * @return Unit|null
     */
    public function getUnitAction(?Unit $unit)
    {
        if (null === $unit) {
            return $this->view(null, 404);
        }

        return $unit;
    }
}