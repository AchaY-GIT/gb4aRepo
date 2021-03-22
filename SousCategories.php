<?php

namespace App\Entity;
use App\Entity\Produits;
use App\Entity\Solutions;

use App\Entity\Categories;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitsRepository;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\Collection;
use App\Repository\SousCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=SousCategoriesRepository::class)
 */
class SousCategories
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
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="sousCategorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="sousCategories")
     */
    private $produits;

     /**
     * @ORM\OneToMany(targetEntity=Solutions::class, mappedBy="sousCategories")
     */
    private $solutions;
      /**
     * @ORM\ManyToMany(targetEntity=Services::class, mappedBy="categorie")
     */
    private $service;
    

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $typeDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

   

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        
        $this->solutions = new ArrayCollection();
        
        $this->sousCategorie = new ArrayCollection();
        $this->solutions = new ArrayCollection();
        $this->service = new ArrayCollection();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type)
    {
        $this->type = $type;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories)
    {
        $this->categories = $categories;

        return $this;
    }
    public function __toString()
    {
        return $this->type;
    }

    /**
     * @return Collection|Produits[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit)
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setSousCategories($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit)
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getSousCategories() === $this) {
                $produit->setSousCategories(null);
            }
        }

        return $this;
    }
     /**
     * @return Collection|Solutions[]
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(Solutions $solution)
    {
        if (!$this->produits->contains($solution)) {
            $this->produits[] = $solution;
            $solution->setSousCategories($this);
        }

        return $this;
    }

    public function removeSolution(Solutions $solution)
    {
        if ($this->Solutions->removeElement($solution)) {
            // set the owning side to null (unless already changed)
            if ($solution->getSousCategories() === $this) {
                $solution->setSousCategories(null);
            }
        }

        return $this;
    }
    public function getTypeDescription(): ?string
    {
        return $this->typeDescription;
    }
   

   
   

    public function setTypeDescription(?string $typeDescription)
    {
        $this->typeDescription = $typeDescription;

        return $this;
    }
      // je convertir l'object User en chaine de caractère

      public function getImages()
      {
          return $this->images;
      }

      public function setImages($images)
      {
          $this->images = $images;

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
    
    
}
