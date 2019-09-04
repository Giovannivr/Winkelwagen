<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatagoryRepository")
 */
class Catagory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Naam;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="Cat_Id")
     */
    private $ProductID;

    public function __construct()
    {
        $this->ProductID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->Naam;
    }

    public function setNaam(string $Naam): self
    {
        $this->Naam = $Naam;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProductID(): Collection
    {
        return $this->ProductID;
    }

    public function addProductID(Product $productID): self
    {
        if (!$this->ProductID->contains($productID)) {
            $this->ProductID[] = $productID;
            $productID->setCatId($this);
        }

        return $this;
    }

    public function removeProductID(Product $productID): self
    {
        if ($this->ProductID->contains($productID)) {
            $this->ProductID->removeElement($productID);
            // set the owning side to null (unless already changed)
            if ($productID->getCatId() === $this) {
                $productID->setCatId(null);
            }
        }

        return $this;   
    }

    public function __toString()
    {
        return $this->getNaam();
    }
}
