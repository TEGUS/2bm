<?php
namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Categorie;
use CoreBundle\Entity\Country;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Created by PhpStorm.
 * User: Aurelien KOUAM
 * Date: 29/01/2017
 * Time: 12:36
 */
class Countries extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $cameroun = new Country();
        $cameroun->setName('Cameroun');
        $cameroun->setActive('true');
        $this->addReference('cameroun', $cameroun);
        $manager->persist($cameroun);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}