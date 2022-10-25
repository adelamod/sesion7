<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidoRepository::class)
 */
class Pedido
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $total;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_entrega;


    /**
     * @ORM\OneToMany(targetEntity=Restaurante::class, mappedBy="pedido")
     */
    private $restaurante;



    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\OneToOne(targetEntity=Direccion::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $direccion;

    /**
     * @ORM\OneToOne(targetEntity=Estado::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity=PlatoCantidad::class, mappedBy="pedido", orphanRemoval=true)
     */
    private $platoCantidades;



    public function __construct()
    {
        $this->clientes = new ArrayCollection();
        $this->restaurante = new ArrayCollection();
        $this->platos = new ArrayCollection();
        $this->platoCantidades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fecha_entrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fecha_entrega): self
    {
        $this->fecha_entrega = $fecha_entrega;

        return $this;
    }

    /**
     * @return Collection<int, Cliente>
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->addPedido($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->removeElement($cliente)) {
            $cliente->removePedido($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Restaurante>
     */
    public function getRestaurante(): Collection
    {
        return $this->restaurante;
    }

    public function addRestaurante(Restaurante $restaurante): self
    {
        if (!$this->restaurante->contains($restaurante)) {
            $this->restaurante[] = $restaurante;
            $restaurante->setPedido($this);
        }

        return $this;
    }

    public function removeRestaurante(Restaurante $restaurante): self
    {
        if ($this->restaurante->removeElement($restaurante)) {
            // set the owning side to null (unless already changed)
            if ($restaurante->getPedido() === $this) {
                $restaurante->setPedido(null);
            }
        }

        return $this;
    }


    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getDireccion(): ?Direccion
    {
        return $this->direccion;
    }

    public function setDireccion(Direccion $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(Estado $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection<int, PlatoCantidad>
     */
    public function getPlatoCantidades(): Collection
    {
        return $this->platoCantidades;
    }

    public function addPlatoCantidade(PlatoCantidad $platoCantidade): self
    {
        if (!$this->platoCantidades->contains($platoCantidade)) {
            $this->platoCantidades[] = $platoCantidade;
            $platoCantidade->setPedido($this);
        }

        return $this;
    }

    public function removePlatoCantidade(PlatoCantidad $platoCantidade): self
    {
        if ($this->platoCantidades->removeElement($platoCantidade)) {
            // set the owning side to null (unless already changed)
            if ($platoCantidade->getPedido() === $this) {
                $platoCantidade->setPedido(null);
            }
        }

        return $this;
    }


}
