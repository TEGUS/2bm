<?php

namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Type;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Created by PhpStorm.
 * User: Aurelien KOUAM
 * Date: 21/01/2017
 * Time: 12:36
 */
class Types implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $types = [
            'Offer',
            'Request'
        ];

        foreach ($types as $i => $type) {
            $list_types[$i] = new Type();
            $list_types[$i]->setLibelle($type);
            $manager->persist($list_types[$i]);
        }
        $manager->flush();
    }
}