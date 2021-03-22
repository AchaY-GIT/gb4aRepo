<?php

namespace App\Entity;
use App\Entity\Produits;
use App\Entity\Services;
use App\Entity\Solutions;
use App\Entity\SousCategories;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metier;

  

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

 

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="categorie", orphanRemoval=true)
     */
    private $produits;

     /**
     * @ORM\OneToMany(targetEntity=Solutions::class, mappedBy="categorie", orphanRemoval=true)
     */
    private $solutions;

    
     /**
     * @ORM\ManyToMany(targetEntity=Services::class, mappedBy="categorie")
     */
    private $service;

    /**
     * @ORM\OneToMany(targetEntity=SousCategories::class, mappedBy="categories", orphanRemoval=true)
     */
    private $sousCategorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;


    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->sousCategorie = new ArrayCollection();
        $this->solutions = new ArrayCollection();
        $this->service = new ArrayCollection();
    }

   
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMetier(): ?string
    {
        return $this->metier;
    }

    public function setMetier(string $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

   


    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    // je convertir l'object User en chaine de caractère
    public function __toString()
    {
        return $this->getMetier();
        return $this->getService();
        return $this->getSolutions();
        return $this->getProduits();
    }

    /**
     * @return Collection|Produits[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }
 

    public function addProduit(Produits $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }

    
         /**
     * @return Collection|Services[]
     */
    public function getService(): Collection
    {
        return $this->service;
    }
    
    public function addService(Services $service): self
    {
        if (!$this->service->contains($service)) {
            $this->service[] = $service;
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        $this->categorie->removeElement($service);

        return $this;
    }
    /**
     * @return Collection|Solutions[]
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(solutions $solution): self
    {
        if (!$this->solutions->contains($solution)) {
            $this->solutions[] = $solution;
            $solution->setCategorie($this);
        }

        return $this;
    }

    public function removeSolution(Solutions $solution): self
    {
        if ($this->solutions->removeElement($solution)) {
            // set the owning side to null (unless already changed)
            if ($solution->getCategorie() === $this) {
                $solution->setCategorie(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|SousCategories[]
     */
    public function getSousCategorie(): Collection
    {
        return $this->sousCategorie;
    }

    public function addSousCategorie(SousCategories $sousCategorie): self
    {
        if (!$this->sousCategorie->contains($sousCategorie)) {
            $this->sousCategorie[] = $sousCategorie;
            $sousCategorie->setCategories($this);
        }

        return $this;
    }

    public function removeSousCategorie(SousCategories $sousCategorie): self
    {
        if ($this->sousCategorie->removeElement($sousCategorie)) {
            // set the owning side to null (unless already changed)
            if ($sousCategorie->getCategories() === $this) {
                $sousCategorie->setCategories(null);
            }
        }

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

        return $this;
    }



   
}
