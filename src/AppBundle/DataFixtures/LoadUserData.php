<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-19
 * Time: 21:07
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends Fixture
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
        $user->setPasswordHash('wer34');

        $manager->persist($user);
        $manager->flush();
    }

}