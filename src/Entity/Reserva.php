<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_entrada = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_salida = null;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\Column]
    private ?int $numero_personas = null;

    #[ORM\Column]
    private ?bool $eliminado = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cliente $cliente = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitacion $habitacion = null;

    /**
     * @var Collection<int, ReservaServicioAdicional>
     */
    #[ORM\OneToMany(targetEntity: ReservaServicioAdicional::class, mappedBy: 'reserva')]
    private Collection $reservaServicioAdicionals;

    /**
     * @var Collection<int, NotaServicio>
     */
    #[ORM\OneToMany(targetEntity: NotaServicio::class, mappedBy: 'reserva')]
    private Collection $notaServicios;

    public function __construct()
    {
        $this->reservaServicioAdicionals = new ArrayCollection();
        $this->notaServicios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaEntrada(): ?\DateTimeInterface
    {
        return $this->fecha_entrada;
    }

    public function setFechaEntrada(\DateTimeInterface $fecha_entrada): static
    {
        $this->fecha_entrada = $fecha_entrada;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->fecha_salida;
    }

    public function setFechaSalida(\DateTimeInterface $fecha_salida): static
    {
        $this->fecha_salida = $fecha_salida;

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

    public function getNumeroPersonas(): ?int
    {
        return $this->numero_personas;
    }

    public function setNumeroPersonas(int $numero_personas): static
    {
        $this->numero_personas = $numero_personas;

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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getHabitacion(): ?Habitacion
    {
        return $this->habitacion;
    }

    public function setHabitacion(?Habitacion $habitacion): static
    {
        $this->habitacion = $habitacion;

        return $this;
    }

    /**
     * @return Collection<int, ReservaServicioAdicional>
     */
    public function getReservaServicioAdicionals(): Collection
    {
        return $this->reservaServicioAdicionals;
    }

    public function addReservaServicioAdicional(ReservaServicioAdicional $reservaServicioAdicional): static
    {
        if (!$this->reservaServicioAdicionals->contains($reservaServicioAdicional)) {
            $this->reservaServicioAdicionals->add($reservaServicioAdicional);
            $reservaServicioAdicional->setReserva($this);
        }

        return $this;
    }

    public function removeReservaServicioAdicional(ReservaServicioAdicional $reservaServicioAdicional): static
    {
        if ($this->reservaServicioAdicionals->removeElement($reservaServicioAdicional)) {
            // set the owning side to null (unless already changed)
            if ($reservaServicioAdicional->getReserva() === $this) {
                $reservaServicioAdicional->setReserva(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NotaServicio>
     */
    public function getNotaServicios(): Collection
    {
        return $this->notaServicios;
    }

    public function addNotaServicio(NotaServicio $notaServicio): static
    {
        if (!$this->notaServicios->contains($notaServicio)) {
            $this->notaServicios->add($notaServicio);
            $notaServicio->setReserva($this);
        }

        return $this;
    }

    public function removeNotaServicio(NotaServicio $notaServicio): static
    {
        if ($this->notaServicios->removeElement($notaServicio)) {
            // set the owning side to null (unless already changed)
            if ($notaServicio->getReserva() === $this) {
                $notaServicio->setReserva(null);
            }
        }

        return $this;
    }
}
