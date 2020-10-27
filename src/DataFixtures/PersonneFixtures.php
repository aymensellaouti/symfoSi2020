<?php

namespace App\DataFixtures;

use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr');
        for ($i=0; $i <100 ; $i++) {
            $personne = new Personne();
            $personne->setFirstname($faker->firstName);
            $personne->setName($faker->lastName);
            $personne->setAge($faker->numberBetween(1,100));
            $personne->setPath($faker->imageUrl());
            $manager->persist($personne);
        }
        $manager->flush();
    }
}
