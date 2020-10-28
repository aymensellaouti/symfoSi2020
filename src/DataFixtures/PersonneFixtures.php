<?php

namespace App\DataFixtures;

use App\Entity\Hobbie;
use App\Entity\Job;
use App\Entity\Personne;
use App\Entity\PieceIdentite;
use App\Repository\HobbieRepository;
use App\Repository\JobRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(
        ObjectManager $manager
    )
    {
        $piTypes = ['CIN', 'PASSPORT'];
        $jobs = $manager->getRepository(Job::class)->findAll();
        $hobbies = $manager->getRepository(Hobbie::class)->findAll();
        $faker = Factory::create('fr');
        for ($i=0; $i <100 ; $i++) {
            $personne = new Personne();
            $personne->setFirstname($faker->firstName);
            $personne->setName($faker->lastName);
            $personne->setAge($faker->numberBetween(1,100));
            $personne->setPath($faker->imageUrl());
            for($j = 1; $j < $faker->numberBetween(1,7) ; $j++ ){
                $personne->addHobby($hobbies[$faker->numberBetween(0, count($hobbies)-1)]);
            }
            $personne->setJob($jobs[$faker->numberBetween(0, count($jobs)-1)]);
            $pieceIdentite = new PieceIdentite();
            $pieceIdentite->setType($piTypes[$i%2]);
            $pieceIdentite->setIdentifiant($faker->randomNumber(8));
            $personne->setPieceIdentite($pieceIdentite);
            $manager->persist($personne);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            JobFixtures::class,
            HobbieFixtures::class
        ];
    }
}
