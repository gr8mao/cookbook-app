<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-22
 * Time: 21:14
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return mixed
     */
    public function load(ObjectManager $manager)
    {
        $products = array(
            array('Name'=> 'Курица', 'IsVegan' => false, 'Type' => 'Мясо'),
            array('Name'=> 'Морковь', 'IsVegan' => true, 'Type' => 'Овощи'),
            array('Name'=> 'Лук', 'IsVegan' => true, 'Type' => 'Овощи'),
            array('Name'=> 'Соль', 'IsVegan' => true, 'Type' => 'Специи'),
            array('Name'=> 'Перец', 'IsVegan' => true, 'Type' => 'Специи'),
            array('Name'=> 'Сметана', 'IsVegan' => false, 'Type' => 'Молочные продукты'),
            array('Name'=> 'Шампиньоны', 'IsVegan' => true, 'Type' => 'Грибы'),
            array('Name'=> 'Сыр', 'IsVegan' => false, 'Type' => 'Молочные продукты'),
        );

        foreach ($products as $item) {
            $product = new Product();

            $product->setName($item['Name']);
            $product->setIsVegan($item['IsVegan']);
            $product->setType($this->getReference($item['Type']));

            $this->setReference('Product_'.$item['Name'], $product);

            $manager->persist($product);
        }

        $manager->flush();

        return $products;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 4;
    }

}