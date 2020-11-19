<?php

namespace App\Entity;

use App\Repository\DepenseFixeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DepenseFixeRepository::class)
 */
class DepenseFixe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("depenseFixe:load")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * * @Groups("depenseFixe:load")
     */
    private $libelleDepenseFixe;

    /**
     * @ORM\Column(type="float")
     * * @Groups("depenseFixe:load")
     */
    private $montantDepenseFixe;

    /**
     * @ORM\Column(type="date")
     * * @Groups("depenseFixe:load")
     */
    private $dateCompte;

    /**
     * @ORM\Column(type="date", nullable=true)
     * * @Groups("depenseFixe:load")
     */
    private $dateModif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDepense", inversedBy="depenseFixe")
     * * @Groups("depenseFixe:load")
     */
    private $typeDepense;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="depenseFixe")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLibelleDepenseFixe()
    {
        return $this->libelleDepenseFixe;
    }

    /**
     * @param mixed $libelleDepenseFixe
     */
    public function setLibelleDepenseFixe($libelleDepenseFixe): void
    {
        $this->libelleDepenseFixe = $libelleDepenseFixe;
    }

    /**
     * @return mixed
     */
    public function getMontantDepenseFixe()
    {
        return $this->montantDepenseFixe;
    }

    /**
     * @param mixed $montantDepenseFixe
     */
    public function setMontantDepenseFixe($montantDepenseFixe): void
    {
        $this->montantDepenseFixe = $montantDepenseFixe;
    }

    /**
     * @return mixed
     */
    public function getDateCompte()
    {
        return $this->dateCompte;
    }

    /**
     * @param mixed $dateCompte
     */
    public function setDateCompte($dateCompte): void
    {
        $this->dateCompte = $dateCompte;
    }

    /**
     * @return mixed
     */
    public function getTypeDepense()
    {
        return $this->typeDepense;
    }

    /**
     * @param mixed $typeDepense
     */
    public function setTypeDepense($typeDepense): void
    {
        $this->typeDepense = $typeDepense;
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
