<?php

namespace App\Entity;

use App\Controller\TimeStamp;
use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Personne
{
    use TimeStamp;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=65)
     * @Assert\NotBlank(message="Vous devez spécifiez un name")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstname;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank(message="Vous devez reseigner l'age")
     * @Assert\Range(
     *     min= 1,
     *     max= 199,
     *     minMessage="Vous ne pouvez pas avoir un age inférieur à un",
     *     maxMessage="Si vous avez plus de 200 ans vous n'avez rien à faire ici"
     * )
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\OneToOne(targetEntity=PieceIdentite::class, inversedBy="personne", cascade={"persist", "remove"})
     */
    private $pieceIdentite;

    /**
     * @ORM\ManyToOne(targetEntity=Job::class, inversedBy="personnes")
     */
    private $job;


    /**
     * @ORM\ManyToMany(targetEntity=Hobbie::class)
     */
    private $hobbies;

    public function __construct()
    {
        $this->hobbies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPieceIdentite(): ?PieceIdentite
    {
        return $this->pieceIdentite;
    }

    public function setPieceIdentite(?PieceIdentite $pieceIdentite): self
    {
        $this->pieceIdentite = $pieceIdentite;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return Collection|Hobbie[]
     */
    public function getHobbies(): Collection
    {
        return $this->hobbies;
    }

    public function addHobby(Hobbie $hobby): self
    {
        if (!$this->hobbies->contains($hobby)) {
            $this->hobbies[] = $hobby;
        }

        return $this;
    }

    public function removeHobby(Hobbie $hobby): self
    {
        if ($this->hobbies->contains($hobby)) {
            $this->hobbies->removeElement($hobby);
        }

        return $this;
    }
}
