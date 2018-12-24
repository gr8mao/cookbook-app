<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-19
 * Time: 23:17
 */

namespace AppBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class DeserializeEntity
 * @package AppBundle\Annotation
 *
 * @Annotation
 * @Target({"PROPERTY"})
 */
final class DeserializeEntity
{
    /**
     * @var string
     * @Required()
     */
    public $type;

    /**
     * @var string $idField идентификатор класса, который будет десериализироваться
     * @Required()
     */
    public $idField;

    /**
     * @var string $setter
     * @Required()
     */
    public $setter;

    /**
     * @var string $idGetter
     * @Required()
     */
    public $idGetter;
}