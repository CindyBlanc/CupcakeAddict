<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $nomCat;

    /**
     * @ORM\OneToMany(targetEntity=Cupcake::class, mappedBy="categorie")
     */
    private $cupcakes;

    public function __construct()
    {
        $this->cupcakes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCat(): ?string
    {
        return $this->nomCat;
    }

    public function setNomCat(string $nomCat): self
    {
        $this->nomCat = $nomCat;

        return $this;
    }

    /**
     * @return Collection|Cupcake[]
     */
    public function getCupcakes(): Collection
    {
        return $this->cupcakes;
    }

    public function addCupcake(Cupcake $cupcake): self
    {
        if (!$this->cupcakes->contains($cupcake)) {
            $this->cupcakes[] = $cupcake;
            $cupcake->setCategorie($this);
        }

        return $this;
    }

    public function removeCupcake(Cupcake $cupcake): self
    {
        if ($this->cupcakes->removeElement($cupcake)) {
            // set the owning side to null (unless already changed)
            if ($cupcake->getCategorie() === $this) {
                $cupcake->setCategorie(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nomCat;
    }
}
