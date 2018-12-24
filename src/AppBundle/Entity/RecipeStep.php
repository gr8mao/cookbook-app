<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * RecipeStep
 *
 * @ORM\Table(name="recipe_step")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeStepRepository")
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
class RecipeStep
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
     * @ORM\Column(name="Title", type="string", length=255)
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="EstimatedTime", type="smallint")
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     *
     * @Assert\GreaterThan(0)
     */
    private $estimatedTime;

    /**
     * @var $recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="steps")
     */
    private $recipe;

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
     * Set title
     *
     * @param string $title
     *
     * @return RecipeStep
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return RecipeStep
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set estimatedTime
     *
     * @param integer $estimatedTime
     *
     * @return RecipeStep
     */
    public function setEstimatedTime($estimatedTime)
    {
        $this->estimatedTime = $estimatedTime;

        return $this;
    }

    /**
     * Get estimatedTime
     *
     * @return int
     */
    public function getEstimatedTime()
    {
        return $this->estimatedTime;
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @param mixed $recipe
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;
    }
}

