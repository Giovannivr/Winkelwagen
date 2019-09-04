<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(type="float")
     */
    private $Prijs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Afbeelding;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Omschrijving;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Catagory", inversedBy="ProductID")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Cat_Id;

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

    public function getPrijs(): ?float
    {
        return $this->Prijs;
    }

    public function setPrijs(float $Prijs): self
    {
        $this->Prijs = $Prijs;

        return $this;
    }

    public function getAfbeelding(): ?string
    {
        return $this->Afbeelding;
    }

    public function setAfbeelding(?string $Afbeelding): self
    {
        $this->Afbeelding = $Afbeelding;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->Omschrijving;
    }

    public function setOmschrijving(string $Omschrijving): self
    {
        $this->Omschrijving = $Omschrijving;

        return $this;
    }

    public function getCatId(): ?Catagory
    {
        return $this->Cat_Id;
    }

    public function setCatId(?Catagory $Cat_Id): self
    {
        $this->Cat_Id = $Cat_Id;

        return $this;
    }
}
