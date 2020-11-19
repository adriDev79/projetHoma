<?php

namespace App\Entity;

use App\Repository\RevenuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RevenuRepository::class)
 */
class Revenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("revenu:load")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Groups("revenu:load")
     */
    private $libelleRevenu;

    /**
     * @ORM\Column(type="float")
     * @Groups("revenu:load")
     */
    private $montantRevenu;

    /**
     * @ORM\Column(type="date")
     * @Groups("revenu:load")
     */
    private $dateRevenu;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("revenu:load")
     */
    private $dateModif;

    /**
     * @ORM\Column(type="integer")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="revenu")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLibelleRevenu()
    {
        return $this->libelleRevenu;
    }

    /**
     * @param mixed $libelleRevenu
     */
    public function setLibelleRevenu($libelleRevenu): void
    {
        $this->libelleRevenu = $libelleRevenu;
    }

    /**
     * @return mixed
     */
    public function getMontantRevenu()
    {
        return $this->montantRevenu;
    }

    /**
     * @param mixed $montantRevenu
     */
    public function setMontantRevenu($montantRevenu): void
    {
        $this->montantRevenu = $montantRevenu;
    }

    /**
     * @return mixed
     */
    public function getDateRevenu()
    {
        return $this->dateRevenu;
    }

    /**
     * @param mixed $dateRevenu
     */
    public function setDateRevenu($dateRevenu): void
    {
        $this->dateRevenu = $dateRevenu;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * @param mixed $dateModif
     */
    public function setDateModif($dateModif): void
    {
        $this->dateModif = $dateModif;
    }
}
