<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-18
 * Time: 23:06
 */

namespace AppBundle\Exception;


use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends HttpException
{
    public function __construct(ConstraintViolationListInterface $constraintValidationList)
    {
        $message = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($constraintValidationList as $violation) {
            $message[$violation->getPropertyPath()] = $violation->getMessage();
        }

        parent::__construct(400, json_encode($message));
    }
}