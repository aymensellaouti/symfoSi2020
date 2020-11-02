<?php


namespace App\Controller;


use Doctrine\ORM\Mapping as ORM;

trait TimeStamp
{
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\PrePersist
     */
    public function onCreate() {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function onUpdate() {
        $this->updatedAt = new \DateTime();
    }

}