<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 16.12.2018
 * Time: 18:27
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Recipe;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRecipeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return mixed
     */
    public function load(ObjectManager $manager)
    {
        $recipe1 = new Recipe();
        $recipe1->setTitle("Жульен");
        $recipe1->setDescription("Это жульен с курочкой и грибами!");
        $recipe1->setEstimatedTime(60);
        $recipe1->setUser($this->getReference('user'));

        $this->addReference('recipe', $recipe1);

        $manager->persist($recipe1);
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 5;
    }

}