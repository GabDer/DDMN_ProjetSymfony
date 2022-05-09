<?php

namespace App\Entity;

use App\Repository\PERSONNEPROFILRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PERSONNEPROFILRepository::class)
 */
class PERSONNEPROFIL
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=PERSONNE::class, inversedBy="PersonneProfil")
     * @ORM\JoinColumn(nullable=false)
     */
    private $PER_ID;

    /**
     * @ORM\ManyToOne(targetEntity=PROFIL::class, inversedBy="PersonneProfil")
     * @ORM\JoinColumn(nullable=false)
     */
    private $PRO_ID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPERID(): ?PERSONNE
    {
        return $this->PER_ID;
    }

    public function setPERID(?PERSONNE $PER_ID): self
    {
        $this->PER_ID = $PER_ID;

        return $this;
    }

    public function getPROID(): ?PROFIL
    {
        return $this->PRO_ID;
    }

    public function setPROID(?PROFIL $PRO_ID): self
    {
        $this->PRO_ID = $PRO_ID;

        return $this;
    }
}
