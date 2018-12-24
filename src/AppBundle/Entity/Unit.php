<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Unit
 *
 * @ORM\Table(name="unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnitRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Unit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, unique=true)
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Short_name", type="string", length=255, unique=false)
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $shortName;

    /**
     * @var $ingredients
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ingredient", mappedBy="units")
     */
    private $ingredients;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Unit
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName)
    {
        $this->shortName = $shortName;
    }
}

