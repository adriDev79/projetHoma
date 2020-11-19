<?php

namespace App\Entity;

use App\Repository\TypeDepenseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypeDepenseRepository::class)
 */
class TypeDepense
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"depenseFixe:load", "depenseAnnexe:load"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"depenseFixe:load", "depenseAnnexe:load"})
     */
    private $libelleTypeDepense;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DepenseFixe", mappedBy="typeDepense")
     */
    private $depenseFixe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DepenseAnnexe", mappedBy="typeDepense")
     */
    private $depenseAnnexe;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLibelleTypeDepense()
    {
        return $this->libelleTypeDepense;
    }

    /**
     * @param mixed $libelleTypeDepense
     */
    public function setLibelleTypeDepense($libelleTypeDepense): void
    {
        $this->libelleTypeDepense = $libelleTypeDepense;
    }

    /**
     * @return mixed
     */
    public function getDepenseFixe()
    {
        return $this->depenseFixe;
    }

    /**
     * @param mixed $depenseFixe
     */
    public function setDepenseFixe($depenseFixe): void
    {
        $this->depenseFixe = $depenseFixe;
    }

    /**
     * @return mixed
     */
    public function getDepenseAnnexe()
    {
        return $this->depenseAnnexe;
    }

    /**
     * @param mixed $depenseAnnexe
     */
    public function setDepenseAnnexe($depenseAnnexe): void
    {
        $this->depenseAnnexe = $depenseAnnexe;
    }
}
