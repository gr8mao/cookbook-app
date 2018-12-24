<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-22
 * Time: 21:13
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\ProductType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return mixed
     */
    public function load(ObjectManager $manager)
    {
        $productTypes = array(
            array('Name' => 'Мясо'),
            array('Name' => 'Овощи'),
            array('Name' => 'Специи'),
            array('Name' => 'Молочные продукты'),
            array('Name' => 'Фрукты'),
            array('Name' => 'Орехи'),
            array('Name' => 'Грибы'),
        );

        foreach ($productTypes as $item) {
            $productType = new ProductType();

            $productType->setName($item['Name']);

            $this->setReference($item['Name'], $productType);

            $manager->persist($productType);
        }

        $manager->flush();

        return $productTypes;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }

}