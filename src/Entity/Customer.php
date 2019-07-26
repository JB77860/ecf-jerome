<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="idCustomer")
     */
    private $idBooking;

    public function __construct()
    {
        $this->idBooking = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getIdBooking(): Collection
    {
        return $this->idBooking;
    }

    public function addIdBooking(Booking $idBooking): self
    {
        if (!$this->idBooking->contains($idBooking)) {
            $this->idBooking[] = $idBooking;
            $idBooking->setIdCustomer($this);
        }

        return $this;
    }

    public function removeIdBooking(Booking $idBooking): self
    {
        if ($this->idBooking->contains($idBooking)) {
            $this->idBooking->removeElement($idBooking);
            // set the owning side to null (unless already changed)
            if ($idBooking->getIdCustomer() === $this) {
                $idBooking->setIdCustomer(null);
            }
        }

        return $this;
    }
}
