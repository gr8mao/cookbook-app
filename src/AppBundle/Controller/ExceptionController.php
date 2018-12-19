<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-18
 * Time: 23:13
 */

namespace AppBundle\Controller;


use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController extends Controller
{
    use ControllerTrait;

    /**
     * @param Request $request
     * @param $exception
     * @param DebugLoggerInterface|null $logger
     * @return View
     */
    public function showAction(Request $request, $exception, ? DebugLoggerInterface $logger)
    {
        if($exception instanceof ValidationException) {
            return $this->getView($exception->getStatusCode(), json_encode($exception->getMessage()), true);
        }

        if($exception instanceof  HttpException) {
            return $this->getView($exception->getStatusCode(), json_encode($exception->getMessage()), true);
        }

//        return $this->getView(null, 'Неожиданная ошибка');
    }

    /**
     * @param int|null $statusCode
     * @param $message
     * @return View
     */
    private function getView(?int $statusCode, $message) : View
    {
        $data = [
            'code' => $statusCode ?? 500,
            'message' => $message
        ];

        return $this->view($data, $statusCode ?? 500);
    }
}