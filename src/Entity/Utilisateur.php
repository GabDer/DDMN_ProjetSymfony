<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $UTI_Login;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $UTI_MDP;

    /**
     * @ORM\Column(type="boolean")
     */
    private $UTI_Role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUTILogin(): ?string
    {
        return $this->UTI_Login;
    }

    public function setUTILogin(string $UTI_Login): self
    {
        $this->UTI_Login = $UTI_Login;

        return $this;
    }

    public function getUTIMDP(): ?string
    {
        return $this->UTI_MDP;
    }

    public function setUTIMDP(string $UTI_MDP): self
    {
        $this->UTI_MDP = $UTI_MDP;

        return $this;
    }

    public function getUTIRole(): ?bool
    {
        return $this->UTI_Role;
    }

    public function setUTIRole(bool $UTI_Role): self
    {
        $this->UTI_Role = $UTI_Role;

        return $this;
    }
}
