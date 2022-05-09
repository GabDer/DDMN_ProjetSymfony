<?php

namespace App\Entity;

use App\Repository\PERSONNERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    public $PER_NOM;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    public $PER_PRENOM;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    public $PER_TEL;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    public $PER_MAIL;
    /**
     * @ORM\ManyToOne(targetEntity=ENTREPRISE::class, inversedBy="Personne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ENTREPRISE;

    /**
     * @ORM\OneToMany(targetEntity=PERSONNEPROFIL::class, mappedBy="PER_ID")
     */
    private $PersonneProfil;

    /**
     * @ORM\ManyToMany(targetEntity=FONCTION::class, mappedBy="FonctionPersonne")
     */
    private $Fonction;

    public function __construct()
    {
        $this->PersonneProfil = new ArrayCollection();
        $this->Fonction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?ENTREPRISE
    {
        return $this->ENTREPRISE;
    }
    public function setEntreprise(ENTREPRISE $Entreprise): self
    {
        $this->ENTREPRISE = $Entreprise;

        return $this;
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
            $personneProfil->setPERID($this);
        }

        return $this;
    }

    public function removePersonneProfil(PERSONNEPROFIL $personneProfil): self
    {
        if ($this->PersonneProfil->removeElement($personneProfil)) {
            // set the owning side to null (unless already changed)
            if ($personneProfil->getPERID() === $this) {
                $personneProfil->setPERID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FONCTION>
     */
    public function getFonction(): Collection
    {
        return $this->Fonction;
    }

    public function addFonction(FONCTION $fonction): self
    {
        if (!$this->Fonction->contains($fonction)) {
            $this->Fonction[] = $fonction;
            $fonction->addFonctionPersonne($this);
        }

        return $this;
    }

    public function removeFonction(FONCTION $fonction): self
    {
        if ($this->Fonction->removeElement($fonction)) {
            $fonction->removeFonctionPersonne($this);
        }

        return $this;
    }
}
