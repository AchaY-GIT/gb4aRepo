<?php

namespace App\Entity;

use App\Entity\Contacte;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
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
     * @ORM\ManyToMany(targetEntity=Categories::class)
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity=SousCategories::class)
     */
    private $sousCategories;

       /**
      * @ORM\OneToMany(targetEntity=Contacte::class, mappedBy="service")
      */
    private $messagesServiceContacts;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->sousCategories = new ArrayCollection();
         $this->messagesServiceContacts = new ArrayCollection();
    }

    // je convertir l'object User en chaine de caractère
    public function __toString()
     {
    //     return $this->getCategorie();
    //     return $this->getSousCategories();
    //      return $this->getMessagesServiceContacts();
         return $this->getTitre();

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
     * @return Collection|Categories[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categories $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(Categories $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection|SousCategories[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategory(SousCategories $sousCategory): self
    {
        if (!$this->sousCategories->contains($sousCategory)) {
            $this->sousCategories[] = $sousCategory;
        }

        return $this;
    }

    public function removeSousCategory(SousCategories $sousCategory): self
    {
        $this->sousCategories->removeElement($sousCategory);

        return $this;
    }


     /**
     * @return Collection|Contacte[]
      */
    public function getMessagesServiceContacts(): Collection
    {
         return $this->messagesContacts;
    }

     public function addMessagesServiceContact(Contacte $messagesServiceContact): self
     {
         if (!$this->messagesServiceContacts->contains($messagesServiceContact)) {
            $this->messagesServiceContacts[] = $messagesServiceContact;
            $messagesServiceContact->setService($this);
       }

         return $this;
    }

     public function removeMessagesServiceContact(Contacte $messagesServiceContact): self
     {
       if ($this->messagesServiceContacts->removeElement($messagesServiceContact)) {
            // set the owning side to null (unless already changed)
            if ($messagesServiceContact->getService() === $this) {
                 $messagesServiceContact->setService(null);
             }
         }

       return $this;
    }


   


   
}
