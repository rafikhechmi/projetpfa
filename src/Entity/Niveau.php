<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveau
 *
 * @ORM\Table(name="niveau", indexes={@ORM\Index(name="cycle_id", columns={"cycle_id"})})
 * @ORM\Entity
 */
class Niveau
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
     * @var int
     *
     * @ORM\Column(name="nom_niveau", type="integer", nullable=false)
     */
    private $nomNiveau;

    /**
     * @var \Cycle
     *
     * @ORM\ManyToOne(targetEntity="Cycle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cycle_id", referencedColumnName="id")
     * })
     */
    private $cycle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomNiveau(): ?int
    {
        return $this->nomNiveau;
    }

    public function setNomNiveau(int $nomNiveau): self
    {
        $this->nomNiveau = $nomNiveau;

        return $this;
    }

    public function getCycle(): ?Cycle
    {
        return $this->cycle;
    }

    public function setCycle(?Cycle $cycle): self
    {
        $this->cycle = $cycle;

        return $this;
    }


}
