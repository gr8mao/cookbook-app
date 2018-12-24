<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-22
 * Time: 00:06
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Unit;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUnitsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $units = array(
          array('Name' => 'Миллиграммы', 'ShortName' => 'мг'),
          array('Name' => 'Киллограммы', 'ShortName' => 'кг'),
          array('Name' => 'Граммы', 'ShortName' => 'гр'),
          array('Name' => 'Чайная ложка', 'ShortName' => 'ч.л.'),
          array('Name' => 'Столовая ложка', 'ShortName' => 'ст.л.'),
          array('Name' => 'Миллилитры', 'ShortName' => 'мл'),
          array('Name' => 'Литры', 'ShortName' => 'л'),
          array('Name' => 'Штуки', 'ShortName' => 'шт'),
        );

        foreach ($units as $unitInfo) {
            $unit = new Unit();
            $unit->setName($unitInfo['Name']);
            $unit->setShortName($unitInfo['ShortName']);
            $manager->persist($unit);

            $this->addReference($unitInfo['ShortName'], $unit);

            unset($unit);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }

}