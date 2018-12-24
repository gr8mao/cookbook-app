<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="IsVegan", type="boolean")
     * @Assert\NotBlank()
     */
    private $isVegan;

    /**
     * @var ProductType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductType", inversedBy="products")
     */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ingredient", mappedBy="product")
     */
    private $ingredients;


    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * @return ProductType
     */
    public function getType(): ProductType
    {
        return $this->type;
    }

    /**
     * @param ProductType $type
     */
    public function setType(ProductType $type)
    {
        $this->type = $type;
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

    /**
     * @return bool
     */
    public function isVegan(): bool
    {
        return $this->isVegan;
    }

    /**
     * @param bool $isVegan
     */
    public function setIsVegan(bool $isVegan)
    {
        $this->isVegan = $isVegan;
    }
}

