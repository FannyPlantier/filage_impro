<?php

namespace App\Entity;

use App\Repository\ComedienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComedienRepository::class)]
class Comedien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    /**
     * @var Collection<int, Spectacle>
     */
    #[ORM\ManyToMany(targetEntity: Spectacle::class, mappedBy: 'comediens')]
    private Collection $spectacles;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'comediens')]
    private Collection $categories;

    public function __construct()
    {
        $this->spectacles = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Spectacle>
     */
    public function getSpectacles(): Collection
    {
        return $this->spectacles;
    }

    public function addSpectacle(Spectacle $spectacle): static
    {
        if (!$this->spectacles->contains($spectacle)) {
            $this->spectacles->add($spectacle);
            $spectacle->addComedien($this);
        }

        return $this;
    }

    public function removeSpectacle(Spectacle $spectacle): static
    {
        if ($this->spectacles->removeElement($spectacle)) {
            $spectacle->removeComedien($this);
        }

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
