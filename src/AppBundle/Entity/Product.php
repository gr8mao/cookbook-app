<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "type",
 *     href=@Hateoas\Route("get_product_type", parameters={"productType" = "expr(object.getType().getId())"})
 * )
 */
class Product
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
     * @ORM\Column(name="Name", type="string", length=255)
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="IsVegan", type="boolean")
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $isVegan;

    /**
     * @var ProductType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductType", inversedBy="products")
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
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

