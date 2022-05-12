<?php

namespace App\Entity;

use App\Repository\FONCTIONRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FONCTIONRepository::class)
 */
class FONCTION
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
    private $FON_LIBELLE;

    /**
     * @ORM\ManyToMany(targetEntity=PERSONNE::class, inversedBy="Fonction")
     */
    private $FonctionPersonne;

    public function __construct()
    {
        //$this->FonctionPersonne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFONLIBELLE(): ?string
    {
        return $this->FON_LIBELLE;
    }

    public function setFONLIBELLE(string $FON_LIBELLE): self
    {
        $this->FON_LIBELLE = $FON_LIBELLE;

        return $this;
    }

    /**
     * @return Collection<int, PERSONNE>
     */
    public function getFonctionPersonne(): ?Collection
    {
        return $this->FonctionPersonne;
    }

    public function addFonctionPersonne(PERSONNE $fonctionPersonne): self
    {
        if (!$this->FonctionPersonne->contains($fonctionPersonne)) {
            $this->FonctionPersonne[] = $fonctionPersonne;
        }

        return $this;
    }

    public function removeFonctionPersonne(PERSONNE $fonctionPersonne): self
    {
        $this->FonctionPersonne->removeElement($fonctionPersonne);

        return $this;
    }
}
