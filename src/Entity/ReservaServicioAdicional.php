<?php

namespace App\Entity;

use App\Repository\ReservaServicioAdicionalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaServicioAdicionalRepository::class)]
class ReservaServicioAdicional
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_servicio = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $detalles = null;

    #[ORM\Column]
    private ?bool $eliminado = null;

    #[ORM\ManyToOne(inversedBy: 'reservaServicioAdicionals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reserva $reserva = null;

    #[ORM\ManyToOne(inversedBy: 'reservaServicioAdicionals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ServicioAdicional $servicio_adicional = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFechaServicio(): ?\DateTimeInterface
    {
        return $this->fecha_servicio;
    }

    public function setFechaServicio(\DateTimeInterface $fecha_servicio): static
    {
        $this->fecha_servicio = $fecha_servicio;

        return $this;
    }

    public function getDetalles(): ?string
    {
        return $this->detalles;
    }

    public function setDetalles(string $detalles): static
    {
        $this->detalles = $detalles;

        return $this;
    }

    public function isEliminado(): ?bool
    {
        return $this->eliminado;
    }

    public function setEliminado(bool $eliminado): static
    {
        $this->eliminado = $eliminado;

        return $this;
    }

    public function getReserva(): ?Reserva
    {
        return $this->reserva;
    }

    public function setReserva(?Reserva $reserva): static
    {
        $this->reserva = $reserva;

        return $this;
    }

    public function getServicioAdicional(): ?ServicioAdicional
    {
        return $this->servicio_adicional;
    }

    public function setServicioAdicional(?ServicioAdicional $servicio_adicional): static
    {
        $this->servicio_adicional = $servicio_adicional;

        return $this;
    }
}
