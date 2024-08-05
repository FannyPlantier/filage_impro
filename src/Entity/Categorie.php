<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $duree = null;

    #[ORM\Column]
    private ?int $nbComedien = null;

    /**
     * @var Collection<int, Comedien>
     */
    #[ORM\ManyToMany(targetEntity: Comedien::class, mappedBy: 'categories')]
    private Collection $comediens;

    public function __construct()
    {
        $this->comediens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNbComedien(): ?int
    {
        return $this->nbComedien;
    }

    public function setNbComedien(int $nbComedien): static
    {
        $this->nbComedien = $nbComedien;

        return $this;
    }

    /**
     * @return Collection<int, Comedien>
     */
    public function getComediens(): Collection
    {
        return $this->comediens;
    }

    public function addComedien(Comedien $comedien): static
    {
        if (!$this->comediens->contains($comedien)) {
            $this->comediens->add($comedien);
            $comedien->addCategory($this);
        }

        return $this;
    }

    public function removeComedien(Comedien $comedien): static
    {
        if ($this->comediens->removeElement($comedien)) {
            $comedien->removeCategory($this);
        }

        return $this;
    }
}
