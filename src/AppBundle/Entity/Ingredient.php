<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use AppBundle\Annotation as App;

/**
 * Ingredient
 *
 * @ORM\Table(name="ingredient")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IngredientRepository")
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "product",
 *     href=@Hateoas\Route("get_product", parameters={"product" = "expr(object.getProduct().getId())"})
 * )
 * @Hateoas\Relation(
 *     "units",
 *     href=@Hateoas\Route("get_unit", parameters={"unit" = "expr(object.getUnits().getId())"})
 * )
 */
class Ingredient
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
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="ingredients")
     *
     * @App\DeserializeEntity(type="AppBundle\Entity\Product", idField="id", idGetter="getId", setter="setProduct")
     *
     * @Serializer\Groups({"Default","Deserialize"})
     * @Serializer\Expose()
     */
    private $product;

    /**
     * @var float
     *
     * @ORM\Column(name="Quantity", type="float")
     *
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit", inversedBy="ingredients")
     *
     * @App\DeserializeEntity(type="AppBundle\Entity\Unit", idField="id", idGetter="getId", setter="setUnits")
     *
     * @Serializer\Groups({"Default","Deserialize"})
     * @Serializer\Expose()
     */
    private $units;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="ingredients")
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
     * Set quantity
     *
     * @param float $quantity
     *
     * @return Ingredient
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unit
     *
     * @param string $units
     *
     * @return Ingredient
     */
    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnits()
    {
        return $this->units;
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

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }
}

