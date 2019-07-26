<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $number;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="smallint")
     */
    private $capacity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="id_room")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idHotel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="idRoom")
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getIdHotel(): ?Hotel
    {
        return $this->idHotel;
    }

    public function setIdHotel(?Hotel $idHotel): self
    {
        $this->idHotel = $idHotel;

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
            $idBooking->setIdRoom($this);
        }

        return $this;
    }

    public function removeIdBooking(Booking $idBooking): self
    {
        if ($this->idBooking->contains($idBooking)) {
            $this->idBooking->removeElement($idBooking);
            // set the owning side to null (unless already changed)
            if ($idBooking->getIdRoom() === $this) {
                $idBooking->setIdRoom(null);
            }
        }

        return $this;
    }
}
