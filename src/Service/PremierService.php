<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class PremierService
{
    private $manager;
    public function __construct(
        EntityManagerInterface $manager
    )
    {
        $this->manager = $manager;
    }

    public function getRandomString($nb) {
        $char = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $chaine = str_shuffle($char);
        return substr($chaine,0,$nb);
    }
}