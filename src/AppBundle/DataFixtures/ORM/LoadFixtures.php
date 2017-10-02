<?php
/**
 * Created by PhpStorm.
 * User: anilrayamajhi
 * Date: 3/1/17
 * Time: 9:10 AM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genus;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
 public function load(ObjectManager $manager)
 {
     // TODO: Implement load() method.
//     $genus = new Genus();
//     $genus->setName('Octopus'.rand(1,100));
//     $genus->setSubFamily('Octopodinae');
//     $genus->setSpeciesCount(rand(100, 99999));
//
//     //$manager argument passed to this function is the entity manager
//     $manager->persist($genus);
//     $manager->flush();

     $objects = Fixtures::load(__DIR__.'/fixtures.yml',
         $manager,
         [
             'providers' => [$this]
         ]
         );
 }

 public function genus(){
     $genera = [
         'Octopus',
         'Balaena',
         'Orcinus',
         'Hippocampus',
         'Asterias',
         'Amphiprion',
         'Carcharodon',
         'Aurelia',
         'Cucumaria',
         'Balistoides',
         'Paralithodes',
         'Chelonia',
         'Trichechus',
         'Eumetopias'
     ];

     $key = array_rand($genera);
     return $genera[$key];
 }
}