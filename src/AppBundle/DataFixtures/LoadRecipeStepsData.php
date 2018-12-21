<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-22
 * Time: 00:51
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\RecipeStep;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRecipeStepsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $steps = array(
          array('Title' => 'Нарежьте лук и марковь', 'Description' => 'Ну нарежь плиз', 'EstimatedTime' => 15),
          array('Title' => 'Пожарьте все с маслицем', 'Description' => 'Шоб корочка золотистая', 'EstimatedTime' => 50),
          array('Title' => 'Нарежьте курочку', 'Description' => 'Меленько или не меленько, как хочется', 'EstimatedTime' => 50),
          array('Title' => 'Добавьте курочку к овощам и пожарьте', 'Description' => 'Чтобы красиво было', 'EstimatedTime' => 50),
          array('Title' => 'Добавьте сметанку', 'Description' => 'Чтобы красиво было', 'EstimatedTime' => 50),
          array('Title' => 'Соль перец по вкусу', 'Description' => 'Чтобы красиво было', 'EstimatedTime' => 50),
          array('Title' => 'И еще 50 лет', 'Description' => 'Чтобы красиво было', 'EstimatedTime' => 50),
          array('Title' => 'Готово', 'Description' => 'Чтобы красиво было', 'EstimatedTime' => 50),
        );

        foreach ($steps as $stepInfo){
            $step = new RecipeStep();

            $step->setTitle($stepInfo['Title']);
            $step->setDescription($stepInfo['Description']);
            $step->setEstimatedTime($stepInfo['EstimatedTime']);
            $step->setRecipe($this->getReference('recipe'));

            $manager->persist($step);

            unset($step);
        }

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