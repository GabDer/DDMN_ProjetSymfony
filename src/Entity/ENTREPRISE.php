<?php

namespace App\Entity;

use App\Repository\ENTREPRISERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ENTREPRISERepository::class)
 */
class ENTREPRISE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $ENT_RaisonSociale;

    /**
     * @ORM\Column(type="string", length=38, nullable=true)
     */
    public $ENT_Pays;

    /**
     * @ORM\Column(type="string", length=38, nullable=true)
     */
    public $ENT_Ville;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $ENT_CP;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    public $ENT_RUE;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $ENT_ComplementAdresse;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    public $ENT_NUM1;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    public $ENT_NUM2;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    public $ENT_SiteWeb;

    /**
     * @ORM\ManyToMany(targetEntity=SPECIALITE::class, mappedBy="SPE_AVOIR")
     */
    private $ENT_AVOIR;

    public function __construct()
    {
        $this->ENT_AVOIR = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\OneToMany(targetEntity=PERSONNE::class, mappedBy="PERSONNE")
     */
    public $PERSONNE;

    public function __constructPer()
    {
        $this->PERSONNE = new ArrayCollection();
    }

    public function getPerId(): ?int
    {
        return $this->id;
    }

    public function getENTRaisonSociale(): ?string
    {
        return $this->ENT_RaisonSociale;
    }

    public function setENTRaisonSociale(string $ENT_RaisonSociale): self
    {
        $this->ENT_RaisonSociale = $ENT_RaisonSociale;

        return $this;
    }

    public function getENTPays(): ?string
    {
        return $this->ENT_Pays;
    }

    public function setENTPays(?string $ENT_Pays): self
    {
        $this->ENT_Pays = $ENT_Pays;

        return $this;
    }

    public function getENTVille(): ?string
    {
        return $this->ENT_Ville;
    }

    public function setENTVille(?string $ENT_Ville): self
    {
        $this->ENT_Ville = $ENT_Ville;

        return $this;
    }

    public function getENTCP(): ?string
    {
        return $this->ENT_CP;
    }

    public function setENTCP(?string $ENT_CP): self
    {
        $this->ENT_CP = $ENT_CP;

        return $this;
    }

    public function getENTRUE(): ?string
    {
        return $this->ENT_RUE;
    }

    public function setENTRUE(?string $ENT_RUE): self
    {
        $this->ENT_RUE = $ENT_RUE;

        return $this;
    }

    public function getENTComplementAdresse(): ?string
    {
        return $this->ENT_ComplementAdresse;
    }

    public function setENTComplementAdresse(?string $ENT_ComplementAdresse): self
    {
        $this->ENT_ComplementAdresse = $ENT_ComplementAdresse;

        return $this;
    }

    public function getENTNUM1(): ?string
    {
        return $this->ENT_NUM1;
    }

    public function setENTNUM1(?string $ENT_NUM1): self
    {
        $this->ENT_NUM1 = $ENT_NUM1;

        return $this;
    }

    public function getENTNUM2(): ?string
    {
        return $this->ENT_NUM2;
    }

    public function setENTNUM2(?string $ENT_NUM2): self
    {
        $this->ENT_NUM2 = $ENT_NUM2;

        return $this;
    }

    public function getENTSiteWeb(): ?string
    {
        return $this->ENT_SiteWeb;
    }

    public function setENTSiteWeb(?string $ENT_SiteWeb): self
    {
        $this->ENT_SiteWeb = $ENT_SiteWeb;

        return $this;
    }

    /**
     * @return Collection<int, SPECIALITE>
     */
    public function getENTAVOIR(): Collection
    {
        return $this->ENT_AVOIR;
    }

    public function addENTAVOIR(SPECIALITE $eNTAVOIR): self
    {
        if (!$this->ENT_AVOIR->contains($eNTAVOIR)) {
            $this->ENT_AVOIR[] = $eNTAVOIR;
            $eNTAVOIR->addSPEAVOIR($this);
        }

        return $this;
    }

    public function removeENTAVOIR(SPECIALITE $eNTAVOIR): self
    {
        if ($this->ENT_AVOIR->removeElement($eNTAVOIR)) {
            $eNTAVOIR->removeSPEAVOIR($this);
        }

        return $this;
    }
}
