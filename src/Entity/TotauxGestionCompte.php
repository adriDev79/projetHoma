<?php

namespace App\Entity;

use App\Repository\TotauxGestionCompteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TotauxGestionCompteRepository::class)
 */
class TotauxGestionCompte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalRevenu;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalDepenseFixe;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalDepenseAnnexe;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalDepense;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $solde;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalRevenu(): ?float
    {
        return $this->totalRevenu;
    }

    public function setTotalRevenu(?float $totalRevenu): self
    {
        $this->totalRevenu = $totalRevenu;

        return $this;
    }

    public function getTotalDepenseFixe(): ?float
    {
        return $this->totalDepenseFixe;
    }

    public function setTotalDepenseFixe(?float $totalDepenseFixe): self
    {
        $this->totalDepenseFixe = $totalDepenseFixe;

        return $this;
    }

    public function getTotalDepenseAnnexe(): ?float
    {
        return $this->totalDepenseAnnexe;
    }

    public function setTotalDepenseAnnexe(?float $totalDepenseAnnexe): self
    {
        $this->totalDepenseAnnexe = $totalDepenseAnnexe;

        return $this;
    }

    public function getTotalDepense(): ?float
    {
        return $this->totalDepense;
    }

    public function setTotalDepense(?float $totalDepense): self
    {
        $this->totalDepense = $totalDepense;

        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(?float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }
}
