<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\HabitacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HabitacionRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/habitaciones'
        ),
        new Post(
            uriTemplate: '/habitaciones'
        ),
        new Get(
            uriTemplate: '/habitaciones/{id}'
        ),
        new Delete(
            uriTemplate: '/habitaciones/{id}'
        ),
        new Patch(
            uriTemplate: '/habitaciones/{id}'
        ),
    ]
)]
class Habitacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?int $capacidad = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $precio_por_noche = null;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\Column]
    private ?bool $eliminado = null;

    #[ORM\ManyToOne(inversedBy: 'habitacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Propiedad $propiedad = null;

    /**
     * @var Collection<int, Reserva>
     */
    #[ORM\OneToMany(targetEntity: Reserva::class, mappedBy: 'habitacion')]
    private Collection $reservas;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(int $capacidad): static
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    public function getPrecioPorNoche(): ?string
    {
        return $this->precio_por_noche;
    }

    public function setPrecioPorNoche(string $precio_por_noche): static
    {
        $this->precio_por_noche = $precio_por_noche;

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

    public function isEliminado(): ?bool
    {
        return $this->eliminado;
    }

    public function setEliminado(bool $eliminado): static
    {
        $this->eliminado = $eliminado;

        return $this;
    }

    public function getPropiedad(): ?Propiedad
    {
        return $this->propiedad;
    }

    public function setPropiedad(?Propiedad $propiedad): static
    {
        $this->propiedad = $propiedad;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): static
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas->add($reserva);
            $reserva->setHabitacion($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): static
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getHabitacion() === $this) {
                $reserva->setHabitacion(null);
            }
        }

        return $this;
    }
}
