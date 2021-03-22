<?php

namespace App\Entity;
use App\Entity\Categories;

use App\Entity\SousCategories;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitsRepository")
 */
class Produits
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
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;



    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;


    /**
     * @ORM\ManyToOne(targetEntity=SousCategories::class, inversedBy="produits")
     */
    private $sousCategories;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

     /**
      * @ORM\OneToMany(targetEntity=Contacte::class, mappedBy="produit")
     */
     private $messagesContacts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etat;

     public function __construct()
     {
         $this->messagesContacts = new ArrayCollection();
     }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getSousCategories(): ?SousCategories
    {
        return $this->sousCategories;
    }

    public function setSousCategories(?SousCategories $sousCategories): self
    {
        $this->sousCategories = $sousCategories;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();

        return $this->getCategorie();
        return $this->getSousCategories();
         return $this->getmessagesContacts();
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages( $images)
    {
        $this->images = $images;

        return $this;
    }

     /**
      * @return Collection|Contacte[]
      */
     public function getMessagesContacts(): Collection
     {
         return $this->messagesContacts;
     }

     public function addMessagesContact(Contacte $messagesContact): self
     {
         if (!$this->messagesContacts->contains($messagesContact)) {
             $this->messagesContacts[] = $messagesContact;
             $messagesContact->setProduit($this);
         }

         return $this;
     }

     public function removeMessagesContact(Contacte $messagesContact): self
     {
         if ($this->messagesContacts->removeElement($messagesContact)) {
             // set the owning side to null (unless already changed)
             if ($messagesContact->getProduit() === $this) {
                 $messagesContact->setProduit(null);
             }
         }

         return $this;
     }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
   
}
