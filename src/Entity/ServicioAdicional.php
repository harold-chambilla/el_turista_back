<?php

namespace App\Entity;

use App\Repository\ServicioAdicionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicioAdicionalRepository::class)]
class ServicioAdicional
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $precio = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\Column]
    private ?bool $eliminado = null;

    /**
     * @var Collection<int, ReservaServicioAdicional>
     */
    #[ORM\OneToMany(targetEntity: ReservaServicioAdicional::class, mappedBy: 'servicio_adicional')]
    private Collection $reservaServicioAdicionals;

    public function __construct()
    {
        $this->reservaServicioAdicionals = new ArrayCollection();
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

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): static
    {
        $this->precio = $precio;

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
            $reservaServicioAdicional->setServicioAdicional($this);
        }

        return $this;
    }

    public function removeReservaServicioAdicional(ReservaServicioAdicional $reservaServicioAdicional): static
    {
        if ($this->reservaServicioAdicionals->removeElement($reservaServicioAdicional)) {
            // set the owning side to null (unless already changed)
            if ($reservaServicioAdicional->getServicioAdicional() === $this) {
                $reservaServicioAdicional->setServicioAdicional(null);
            }
        }

        return $this;
    }
}
