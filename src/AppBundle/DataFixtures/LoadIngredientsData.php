<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-22
 * Time: 00:07
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Ingredient;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadIngredientsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $ingredients = array(
            array('Name' => 'Шампиньоны', 'Quantity' => 400, 'Unit' => $this->getReference('гр')),
            array('Name' => 'Курица', 'Quantity' => 1, 'Unit' => $this->getReference('кг')),
            array('Name' => 'Сметана', 'Quantity' => 400, 'Unit' => $this->getReference('гр')),
            array('Name' => 'Лук', 'Quantity' => 1, 'Unit' => $this->getReference('шт')),
            array('Name' => 'Морковь', 'Quantity' => 400, 'Unit' => $this->getReference('шт')),
            array('Name' => 'Сыр', 'Quantity' => 250, 'Unit' => $this->getReference('гр')),
            array('Name' => 'Соль', 'Quantity' => 5, 'Unit' => $this->getReference('гр')),
            array('Name' => 'Перец', 'Quantity' => 5, 'Unit' => $this->getReference('гр')),
        );

        foreach ($ingredients as $ingredientInfo) {
            $ingredient = new Ingredient();

            $ingredient->setProduct($this->getReference('Product_'.$ingredientInfo['Name']));
            $ingredient->setQuantity($ingredientInfo['Quantity']);
            $ingredient->setUnits($ingredientInfo['Unit']);
            $ingredient->setRecipe($this->getReference('recipe'));

            $manager->persist($ingredient);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 6;
    }

}