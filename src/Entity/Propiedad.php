<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\PropiedadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropiedadRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/propiedades'
        ),
        new Post(
            uriTemplate: '/propiedades'
        ),
        new Get(
            uriTemplate: '/propiedades/{id}'
        ),
        new Delete(
            uriTemplate: '/propiedades/{id}'
        ),
        new Patch(
            uriTemplate: '/propiedades/{id}'
        ),
    ]
)]
class Propiedad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    #[ORM\Column(length: 255)]
    private ?string $ciudad = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\Column]
    private ?int $capacidad = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $amenidades = null;

    #[ORM\Column]
    private ?bool $eliminado = null;

    /**
     * @var Collection<int, Habitacion>
     */
    #[ORM\OneToMany(targetEntity: Habitacion::class, mappedBy: 'propiedad')]
    private Collection $habitacions;

    #[ORM\ManyToOne(inversedBy: 'propiedades')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    public function __construct()
    {
        $this->habitacions = new ArrayCollection();
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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(string $ciudad): static
    {
        $this->ciudad = $ciudad;

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

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

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

    public function getAmenidades(): ?string
    {
        return $this->amenidades;
    }

    public function setAmenidades(string $amenidades): static
    {
        $this->amenidades = $amenidades;

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

    /**
     * @return Collection<int, Habitacion>
     */
    public function getHabitacions(): Collection
    {
        return $this->habitacions;
    }

    public function addHabitacion(Habitacion $habitacion): static
    {
        if (!$this->habitacions->contains($habitacion)) {
            $this->habitacions->add($habitacion);
            $habitacion->setPropiedad($this);
        }

        return $this;
    }

    public function removeHabitacion(Habitacion $habitacion): static
    {
        if ($this->habitacions->removeElement($habitacion)) {
            // set the owning side to null (unless already changed)
            if ($habitacion->getPropiedad() === $this) {
                $habitacion->setPropiedad(null);
            }
        }

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }
}
