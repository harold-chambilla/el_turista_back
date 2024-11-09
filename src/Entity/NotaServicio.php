<?php

namespace App\Entity;

use App\Repository\NotaServicioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotaServicioRepository::class)]
class NotaServicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_emision = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $detalles_servicio = null;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_realizacion = null;

    #[ORM\Column]
    private ?bool $eliminado = null;

    #[ORM\ManyToOne(inversedBy: 'notaServicios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reserva $reserva = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaEmision(): ?\DateTimeInterface
    {
        return $this->fecha_emision;
    }

    public function setFechaEmision(\DateTimeInterface $fecha_emision): static
    {
        $this->fecha_emision = $fecha_emision;

        return $this;
    }

    public function getDetallesServicio(): ?string
    {
        return $this->detalles_servicio;
    }

    public function setDetallesServicio(string $detalles_servicio): static
    {
        $this->detalles_servicio = $detalles_servicio;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFechaRealizacion(): ?\DateTimeInterface
    {
        return $this->fecha_realizacion;
    }

    public function setFechaRealizacion(\DateTimeInterface $fecha_realizacion): static
    {
        $this->fecha_realizacion = $fecha_realizacion;

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
}
