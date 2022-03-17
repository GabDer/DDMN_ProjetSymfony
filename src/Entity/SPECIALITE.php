<?php

namespace App\Entity;

use App\Repository\SPECIALITERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SPECIALITERepository::class)
 */
class SPECIALITE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=ENTREPRISE::class, inversedBy="ENT_AVOIR")
     */
    private $SPE_AVOIR;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $SPE_LIBELLE;

    public function __construct()
    {
        $this->SPE_AVOIR = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, ENTREPRISE>
     */
    public function getSPEAVOIR(): Collection
    {
        return $this->SPE_AVOIR;
    }

    public function addSPEAVOIR(ENTREPRISE $sPEAVOIR): self
    {
        if (!$this->SPE_AVOIR->contains($sPEAVOIR)) {
            $this->SPE_AVOIR[] = $sPEAVOIR;
        }

        return $this;
    }

    public function removeSPEAVOIR(ENTREPRISE $sPEAVOIR): self
    {
        $this->SPE_AVOIR->removeElement($sPEAVOIR);

        return $this;
    }

    public function getSPELIBELLE(): ?string
    {
        return $this->SPE_LIBELLE;
    }

    public function setSPELIBELLE(string $SPE_LIBELLE): self
    {
        $this->SPE_LIBELLE = $SPE_LIBELLE;

        return $this;
    }
}
