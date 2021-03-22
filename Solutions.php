<?php

namespace App\Entity;

use App\Entity\Contacte;
use App\Entity\Categories;
use App\Entity\SousCategories;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SolutionsRepository;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=SolutionsRepository::class)
 */
class Solutions
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
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=SousCategories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $sousCategories;

  /**
      * @ORM\OneToMany(targetEntity=Contacte::class, mappedBy="solution")
     */
    private $messagesSolutionContacts;
    public function __construct()
    {
        $this->messagesSolutionContacts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
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

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

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

     /**
      * @return Collection|Contacte[]
      */
      public function getMessagesSolutionContacts(): Collection
      {
          return $this->messagesSolutionContacts;
      }
 
      public function addMessagesSolutionContact(Contacte $messagesSolutionContact): self
      {
          if (!$this->messagesSolutionContacts->contains($messagesSolutionContact)) {
              $this->messagesSolutionContacts[] = $messagesSolutionContact;
              $messagesSolutionContact->setSolution($this);
          }
 
          return $this;
      }
 
      public function removeMessagesSolutionContact(Contacte $messagesSolutionContact): self
      {
          if ($this->messagesSolutionContacts->removeElement($messagesSolutionContact)) {
              // set the owning side to null (unless already changed)
              if ($messagesSolutionContact->getSolution() === $this) {
                  $messagesSolutionContact->setSolution(null);
              }
          }
 
          return $this;
      }

    public function __toString()
    {
        return $this->getTitre();

        return $this->getCategorie();
        return $this->getSousCategories();
         return $this->getmessagesSolutionContacts();
    }
 

  

  
}
