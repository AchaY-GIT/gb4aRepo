<?php

namespace App\Entity;

use App\Entity\Contacte;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    // /**
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $reset_token;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\OneToMany(targetEntity=Contacte::class, mappedBy="userInContact")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;


   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
     // je convertir l'object User en chaine de caractère
     public function __toString()
     {
         return $this->getUsername();
         return $this->getEmail();
         return $this->getNom();
         return $this->getPrenom();
     }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    // public function __toString(): string
    //   {
    //         return $this->getEmail;
    //     }

     public function getResetToken(): ?string
     {
         return $this->reset_token;
     }

     public function setResetToken(string $reset_token): self
     {
        $this->reset_token = $reset_token;

        return $this;
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

    // /**
    //  * @return Collection|Contacte[]
    //  */
   /* public function getNom(): Collection
    {
        return $this->nom;
    }

    public function addNom(Contacte $nom): self
    {
        if (!$this->contacteInUser->contains($nom)) {
            $this->nom[] = $nom;
            $nom->setUserInContact($this);
        }

        return $this;
    }

    public function removeNom(Contacte $nom): self
    {
        if ($this->contacteInUser->removeElement($nom)) {
            // set the owning side to null (unless already changed)
            if ($nom->getUserInContact() === $this) {
                $nom->setUserInContact(null);
            }
        }

        return $this;
    }*/

       
        

    
}