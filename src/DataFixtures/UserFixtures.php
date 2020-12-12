<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('student@gmail.com');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'secret'
            )
        );
        $user2 = new User();
        $user2->setEmail('admin@gmail.com');
        $user2->setPassword(
            $this->passwordEncoder->encodePassword(
                $user2,
                'secret'
            )
        )
        ->setRoles(['ROLE_ADMIN'])
        ;
        $manager->persist($user);
        $manager->persist($user2);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['groupeUser'];
    }
}
