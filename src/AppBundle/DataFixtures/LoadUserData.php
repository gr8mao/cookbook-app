<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-19
 * Time: 21:07
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return mixed
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('test@test.ru');
        $user->setFirstName('Максон');
        $user->setLastName("Фамилькин");
        $user->setAge(25);
        $user->setBio('Это био!');
        $user->setPasswordHash('pass_1234');

        $this->addReference('user', $user);

        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }

}