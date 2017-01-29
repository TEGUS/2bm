<?php

namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Town;
use CoreBundle\Entity\Type;
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
class Towns extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $towns_cameroun = [
            'Maroua',
            'Garoua',
            'Ngaoundéré',
            'Buea',
            'Bertoua',
            'Yaoundé',
            'Douala',
            'Bafoussam',
            'Bamenda',
            'Ebolowa'
        ];

        foreach ($towns_cameroun as $i => $t) {
            $list[$i] = new Town();
            $list[$i]->setName($t);
            $list[$i]->setCountry($this->getReference('cameroun'));
            $manager->persist($list[$i]);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}