<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cycle
 *
 * @ORM\Table(name="cycle")
 * @ORM\Entity
 */
class Cycle
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
     * @ORM\Column(name="nom_cycle", type="string", length=20, nullable=false)
     */
    private $nomCycle;

    /**
     * @var \Admin
     *
     * @ORM\ManyToOne(targetEntity="Admin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="admin_id", referencedColumnName="id")
     * })
     */
    private $admin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCycle(): ?string
    {
        return $this->nomCycle;
    }

    public function setNomCycle(string $nomCycle): self
    {
        $this->nomCycle = $nomCycle;

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }


}
