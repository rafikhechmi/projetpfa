<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity
 */
class Groupe
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
     * @ORM\Column(name="nom_groupe", type="string", length=20, nullable=false)
     */
    private $nomGroupe;

    /**
     * @var \Filiare
     *
     * @ORM\ManyToOne(targetEntity="Filiare")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="filiare_id", referencedColumnName="id")
     * })
     */
    private $filiare;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGroupe(): ?string
    {
        return $this->nomGroupe;
    }

    public function setNomGroupe(string $nomGroupe): self
    {
        $this->nomGroupe = $nomGroupe;

        return $this;
    }

    public function getFiliare(): ?Filiare
    {
        return $this->filiare;
    }

    public function setFiliare(?Filiare $filiare): self
    {
        $this->filiare = $filiare;

        return $this;
    }


}
