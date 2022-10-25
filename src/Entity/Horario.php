<?php

namespace App\Entity;

use App\Repository\HorarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorarioRepository::class)
 */
class Horario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dia;

    /**
     * @ORM\Column(type="time")
     */
    private $apertura;

    /**
     * @ORM\OneToOne(targetEntity=Restaurante::class, mappedBy="horarios", cascade={"persist", "remove"})
     */
    private $categorias;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDia(): ?int
    {
        return $this->dia;
    }

    public function setDia(int $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getApertura(): ?\DateTimeInterface
    {
        return $this->apertura;
    }

    public function setApertura(\DateTimeInterface $apertura): self
    {
        $this->apertura = $apertura;

        return $this;
    }

    public function getCategorias(): ?Restaurante
    {
        return $this->categorias;
    }

    public function setCategorias(Restaurante $categorias): self
    {
        // set the owning side of the relation if necessary
        if ($categorias->getHorarios() !== $this) {
            $categorias->setHorarios($this);
        }

        $this->categorias = $categorias;

        return $this;
    }
}
