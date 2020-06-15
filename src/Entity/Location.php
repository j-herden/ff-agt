<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\ManyToOne(targetEntity=Organisation::class, inversedBy="locations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisation;

    /**
     * @ORM\OneToMany(targetEntity=Stockings::class, mappedBy="location")
     */
    private $stockings;

    public function __construct()
    {
        $this->stockings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getOrganisation(): ?Organisation
    {
        return $this->organisation;
    }

    public function setOrganisation(?Organisation $organisation): self
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * @return Collection|Stockings[]
     */
    public function getStockings(): Collection
    {
        return $this->stockings;
    }

    public function addStocking(Stockings $stocking): self
    {
        if (!$this->stockings->contains($stocking)) {
            $this->stockings[] = $stocking;
            $stocking->setLocation($this);
        }

        return $this;
    }

    public function removeStocking(Stockings $stocking): self
    {
        if ($this->stockings->contains($stocking)) {
            $this->stockings->removeElement($stocking);
            // set the owning side to null (unless already changed)
            if ($stocking->getLocation() === $this) {
                $stocking->setLocation(null);
            }
        }

        return $this;
    }

    public function __toString(): String
    {
        return $this->getName();
    }
}
