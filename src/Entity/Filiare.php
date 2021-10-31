<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filiare
 *
 * @ORM\Table(name="filiare")
 * @ORM\Entity
 */
class Filiare
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fliare", type="string", length=20, nullable=false)
     */
    private $nomFliare;

    /**
     * @var \Niveau
     *
     * @ORM\ManyToOne(targetEntity="Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau_id", referencedColumnName="id")
     * })
     */
    private $niveau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFliare(): ?string
    {
        return $this->nomFliare;
    }

    public function setNomFliare(string $nomFliare): self
    {
        $this->nomFliare = $nomFliare;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }


}
