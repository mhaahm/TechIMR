<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SocieteRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Societe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     */
    private $num_gestion;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     */
    private $date_donnees;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Grf")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose()
     */
    private $code_gfr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumGestion(): ?string
    {
        return $this->num_gestion;
    }

    public function setNumGestion(string $num_gestion): self
    {
        $this->num_gestion = $num_gestion;

        return $this;
    }

    public function getDateDonnees(): ?string
    {
        return $this->date_donnees;
    }

    public function setDateDonnees(string $date_donnees): self
    {
        $this->date_donnees = $date_donnees;

        return $this;
    }

    public function getCodeGfr(): ?Grf
    {
        return $this->code_gfr;
    }

    public function setCodeGfr(?Grf $code_gfr): self
    {
        $this->code_gfr = $code_gfr;

        return $this;
    }
}
