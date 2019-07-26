<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Room", mappedBy="hotel")
     */
    private $idRoom;

    public function __construct()
    {
        $this->idRoom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getIdRoom(): Collection
    {
        return $this->idRoom;
    }

    public function addIdRoom(Room $idRoom): self
    {
        if (!$this->idRoom->contains($idRoom)) {
            $this->idRoom[] = $idRoom;
            $idRoom->setIdHotel($this);
        }

        return $this;
    }

    public function removeIdRoom(Room $idRoom): self
    {
        if ($this->idRoom->contains($idRoom)) {
            $this->idRoom->removeElement($idRoom);
            // set the owning side to null (unless already changed)
            if ($idRoom->getIdHotel() === $this) {
                $idRoom->setIdHotel(null);
            }
        }

        return $this;
    }
}
