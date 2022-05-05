<?php

namespace App\Entity;

use App\Repository\PROFILRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PROFILRepository::class)
 */
class PROFIL
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
    private $PRO_LIBELLE;

    /**
     * @ORM\OneToMany(targetEntity=PERSONNEPROFIL::class, mappedBy="PRO_ID")
     */
    private $PersonneProfil;

    public function __construct()
    {
        $this->PersonneProfil = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPROLIBELLE(): ?string
    {
        return $this->PRO_LIBELLE;
    }

    public function setPROLIBELLE(string $PRO_LIBELLE): self
    {
        $this->PRO_LIBELLE = $PRO_LIBELLE;

        return $this;
    }

    /**
     * @return Collection<int, PERSONNEPROFIL>
     */
    public function getPersonneProfil(): Collection
    {
        return $this->PersonneProfil;
    }

    public function addPersonneProfil(PERSONNEPROFIL $personneProfil): self
    {
        if (!$this->PersonneProfil->contains($personneProfil)) {
            $this->PersonneProfil[] = $personneProfil;
            $personneProfil->setPROID($this);
        }

        return $this;
    }

    public function removePersonneProfil(PERSONNEPROFIL $personneProfil): self
    {
        if ($this->PersonneProfil->removeElement($personneProfil)) {
            // set the owning side to null (unless already changed)
            if ($personneProfil->getPROID() === $this) {
                $personneProfil->setPROID(null);
            }
        }

        return $this;
    }
}
