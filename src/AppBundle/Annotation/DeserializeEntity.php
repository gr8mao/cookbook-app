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
class DeserializeEntity
{
    /**
     * @var
     * @Required()
     */
    public $type;

    /**
     * @var
     * @Required()
     */
    public $idField;

    /**
     * @var
     * @Required()
     */
    public $setter;

    /**
     * @var
     * @Required()
     */
    public $idGetter;
}