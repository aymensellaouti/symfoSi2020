<?php

namespace App\Entity;

use App\Controller\TimeStamp;
use App\Repository\HobbieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HobbieRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Hobbie
{
    use TimeStamp;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function __toString()
    {
        return $this->getDesignation();
    }
}
