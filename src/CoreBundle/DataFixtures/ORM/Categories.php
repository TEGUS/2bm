<?php
namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Categorie;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Created by PhpStorm.
 * User: Aurelien KOUAM
 * Date: 21/01/2017
 * Time: 12:36
 */
class Categories extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $categories = [
            'Téléphone',
            'Ordinateur',
            'Multimédia',
            'Accessoire',
            'Autre'
        ];

        foreach ($categories as $i => $categorie) {
            $list_categories[$i] = new Categorie();
            $list_categories[$i]->setLibelle($categorie);
            $manager->persist($list_categories[$i]);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}