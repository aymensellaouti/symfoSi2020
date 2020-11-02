<?php

namespace App\Entity;

use App\Controller\TimeStamp;
use App\Repository\PieceIdentiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PieceIdentiteRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class PieceIdentite
{
    use TimeStamp;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $identifiant;

    /**
     * @ORM\OneToOne(targetEntity=Personne::class, mappedBy="pieceIdentite", cascade={"persist", "remove"})
     */
    private $personne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIdentifiant(): ?int
    {
        return $this->identifiant;
    }

    public function setIdentifiant(int $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): self
    {
        $this->personne = $personne;

        // set (or unset) the owning side of the relation if necessary
        $newPieceIdentite = null === $personne ? null : $this;
        if ($personne->getPieceIdentite() !== $newPieceIdentite) {
            $personne->setPieceIdentite($newPieceIdentite);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getType().' '.$this->getIdentifiant();
    }
}
