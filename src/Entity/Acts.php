<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActsRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Acts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=54)
     * @Serializer\Expose()
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     */
    private $date_depot;
    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     */
    private $nature;

    /**
     * @return mixed
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * @param mixed $nature
     */
    public function setNature($nature): void
    {
        $this->nature = $nature;
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     */
    private $date_acte;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     */
    private $numero_depot_manuel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Societe")
     * @Serializer\Expose()
     */
    private $societe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDepot(): ?string
    {
        return $this->date_depot;
    }

    public function setDateDepot(string $date_depot): self
    {
        $this->date_depot = $date_depot;

        return $this;
    }

    public function getDateActe(): ?string
    {
        return $this->date_acte;
    }

    public function setDateActe(string $date_acte): self
    {
        $this->date_acte = $date_acte;

        return $this;
    }

    public function getNumeroDepotManuel(): ?int
    {
        return $this->numero_depot_manuel;
    }

    public function setNumeroDepotManuel(int $numero_depot_manuel): self
    {
        $this->numero_depot_manuel = $numero_depot_manuel;

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): self
    {
        $this->societe = $societe;

        return $this;
    }
}
