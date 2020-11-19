<?php

namespace App\Entity;

use App\Repository\DepenseAnnexeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DepenseAnnexeRepository::class)
 */
class DepenseAnnexe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("depenseAnnexe:load")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("depenseAnnexe:load")
     */
    private $libelleDepenseAnnexe;

    /**
     * @ORM\Column(type="float")
     * @Groups("depenseAnnexe:load")
     */
    private $montantDepenseAnnexe;

    /**
     * @ORM\Column(type="date")
     * @Groups("depenseAnnexe:load")
     */
    private $dateCompte;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("depenseAnnexe:load")
     */
    private $dateModif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDepense", inversedBy="depenseAnnexe")
     * @Groups("depenseAnnexe:load")
     */
    private $typeDepense;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="depenseAnnexe")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLibelleDepenseAnnexe()
    {
        return $this->libelleDepenseAnnexe;
    }

    /**
     * @param mixed $libelleDepenseAnnexe
     */
    public function setLibelleDepenseAnnexe($libelleDepenseAnnexe): void
    {
        $this->libelleDepenseAnnexe = $libelleDepenseAnnexe;
    }

    /**
     * @return mixed
     */
    public function getMontantDepenseAnnexe()
    {
        return $this->montantDepenseAnnexe;
    }

    /**
     * @param mixed $montantDepenseAnnexe
     */
    public function setMontantDepenseAnnexe($montantDepenseAnnexe): void
    {
        $this->montantDepenseAnnexe = $montantDepenseAnnexe;
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
