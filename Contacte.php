<?php

namespace App\Entity;


use App\Entity\User;
use DateTimeInterface;
use App\Entity\Produits;
use App\Entity\Services;
use App\Entity\Solutions;
use Doctrine\ORM\Mapping as ORM;

use App\Repository\ContacteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ContacteRepository::class)
 */
class Contacte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @var string|null
     *  @Assert\NotBlank()
     *  @Assert\Length(min=2, max=100)
     */
    private $nom;
     
 
    /**
     *  @ORM\Column(type="string", length=255)
     *  @var string|null
     *  @Assert\NotBlank()
     *  @Assert\Length(min=2, max=100) 
     */
    private $prenom;


    /**
     * @ORM\Column(type="integer", nullable=true)
     *     
     * @var string|null
     *@Assert\Length(min = 8, max = 20, minMessage = "min_lenght", maxMessage = "max_lenght")
     *@Assert\Regex(pattern="/^[0-9]*$/", message="number_only") 
     * )
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)   
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
     
    private $sujet;

    /**
     * @ORM\Column(type="text")
     *   
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     */
     
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class, inversedBy="messagesContacts")
     */
    private $produit;

   

   

     /**
      * @ORM\ManyToOne(targetEntity=Solutions::class, inversedBy="messagesSolutionContacts")
     */
     private $solution;

 

    
      /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reponce;


    /**
     * @ORM\ManyToOne(targetEntity=Services::class,inversedBy="messagesServiceContacts")
     */
    private $service;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(?int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(?string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

   

     public function getSolution(): ?Solutions
     {
         return $this->solution;
     }

     public function setSolution(?Solutions $solution): self
     {
         $this->solution = $solution;

        return $this;
     }

  

    public function getReponce(): ?string
    {
        return $this->reponce;
    }

    public function setReponce(?string $reponce): self
    {
        $this->reponce = $reponce;

        return $this;
    }

 // je convertir l'object User en chaine de caractère
 public function __toString()
{
     return $this->getService().''.$this->getSolution().''.$this->getReponce().''.$this->getDate();
                                                         //   return $this->getUserInContact();
                                                        
                                                       }

    public function getService(): ?Services
    {
        return $this->service;
    }

    public function setService(?Services $service): self
    {
        $this->service = $service;

        return $this;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }




   
 
}
