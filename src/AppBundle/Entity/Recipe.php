<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * Recipe
 *
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeRepository")
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "user",
 *     href=@Hateoas\Route("get_user", parameters={"user" = "expr(object.getUser().getId())"})
 * )
 */
class Recipe
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
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @Serializer\Groups({"Default"})
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=255, min=2)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     * @Serializer\Groups({"Default"})
     * @Serializer\Expose()
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="estimated_time", type="smallint")
     *
     * @Serializer\Groups({"Default"})
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     * @Assert\Range(min=1, max=300)
     */
    private $estimatedTime;

    /**
     * @var User $user
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="recipes")
     */
    private $user;

    /**
     * @var ArrayCollection $steps
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RecipeStep", mappedBy="recipe")
     *
     * @Serializer\Groups({"Default"})
     * @Serializer\Expose()
     */
    private $steps;

    /**
     * @var ArrayCollection $ingredients
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ingredient", mappedBy="recipe")
     *
     * @Serializer\Groups({"Default"})
     * @Serializer\Expose()
     */
    private $ingredients;

    /**
     * Recipe constructor.
     */
    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

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
     * @return Recipe
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
     * @return Recipe
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
     * @return Recipe
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSteps(): \Doctrine\Common\Collections\Collection
    {
        return $this->steps;
    }

    /**
     * @param ArrayCollection $steps
     */
    public function setSteps(ArrayCollection $steps)
    {
        $this->steps = $steps;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients(): \Doctrine\Common\Collections\Collection
    {
        return $this->ingredients;
    }

    /**
     * @param ArrayCollection $ingredients
     */
    public function setIngredients(ArrayCollection $ingredients)
    {
        $this->ingredients = $ingredients;
    }
}

