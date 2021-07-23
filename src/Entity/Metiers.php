<?php

namespace App\Entity;

use App\Repository\MetiersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MetiersRepository::class)
 * @UniqueEntity(fields={"nom"}, groups={"materiel"})
 */
class Metiers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Unique(groups={"materiel"})
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Types::class, mappedBy="metier", cascade={"persist"})
     */
    private $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Types[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Types $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->setMetier($this);
        }

        return $this;
    }

    public function removeType(Types $type): self
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getMetier() === $this) {
                $type->setMetier(null);
            }
        }

        return $this;
    }
}
