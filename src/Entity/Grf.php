<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrfRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Grf
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
    private $code_grf;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeGrf(): ?string
    {
        return $this->code_grf;
    }

    public function setCodeGrf(string $code_grf): self
    {
        $this->code_grf = $code_grf;

        return $this;
    }
}
