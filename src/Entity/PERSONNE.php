<?php

namespace App\Entity;

use App\Repository\PERSONNERepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PERSONNERepository::class)
 */
class PERSONNE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $PER_NOM;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $PER_PRENOM;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $PER_TEL;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $PER_MAIL;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPERNOM(): ?string
    {
        return $this->PER_NOM;
    }

    public function setPERNOM(string $PER_NOM): self
    {
        $this->PER_NOM = $PER_NOM;

        return $this;
    }

    public function getPERPRENOM(): ?string
    {
        return $this->PER_PRENOM;
    }

    public function setPERPRENOM(?string $PER_PRENOM): self
    {
        $this->PER_PRENOM = $PER_PRENOM;

        return $this;
    }

    public function getPERTEL(): ?string
    {
        return $this->PER_TEL;
    }

    public function setPERTEL(?string $PER_TEL): self
    {
        $this->PER_TEL = $PER_TEL;

        return $this;
    }

    public function getPERMAIL(): ?string
    {
        return $this->PER_MAIL;
    }

    public function setPERMAIL(?string $PER_MAIL): self
    {
        $this->PER_MAIL = $PER_MAIL;

        return $this;
    }
}