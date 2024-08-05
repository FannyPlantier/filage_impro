<?php

namespace App\Entity;

use App\Repository\SpectacleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpectacleRepository::class)]
class Spectacle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $nbCategorie = null;

    /**
     * @var Collection<int, Comedien>
     */
    #[ORM\ManyToMany(targetEntity: Comedien::class, inversedBy: 'spectacles')]
    private Collection $comediens;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'spectacles')]
    private Collection $categories;

    public function __construct()
    {
        $this->comediens = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getNbCategorie(): ?int
    {
        return $this->nbCategorie;
    }

    public function setNbCategorie(int $nbCategorie): static
    {
        $this->nbCategorie = $nbCategorie;

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
        }

        return $this;
    }

    public function removeComedien(Comedien $comedien): static
    {
        $this->comediens->removeElement($comedien);

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }
}
