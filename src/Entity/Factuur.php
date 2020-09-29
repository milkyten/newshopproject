<?php

namespace App\Entity;

use App\Repository\FactuurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactuurRepository::class)
 */
class Factuur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $factuur_datum;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="factuurs")
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity=FactuurRegel::class, mappedBy="factuur_id")
     */
    private $factuurRegels;

    public function __construct()
    {
        $this->factuurRegels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFactuurDatum(): ?\DateTimeInterface
    {
        return $this->factuur_datum;
    }

    public function setFactuurDatum(\DateTimeInterface $factuur_datum): self
    {
        $this->factuur_datum = $factuur_datum;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection|FactuurRegel[]
     */
    public function getFactuurRegels(): Collection
    {
        return $this->factuurRegels;
    }

    public function addFactuurRegel(FactuurRegel $factuurRegel): self
    {
        if (!$this->factuurRegels->contains($factuurRegel)) {
            $this->factuurRegels[] = $factuurRegel;
            $factuurRegel->setFactuurId($this);
        }

        return $this;
    }

    public function removeFactuurRegel(FactuurRegel $factuurRegel): self
    {
        if ($this->factuurRegels->contains($factuurRegel)) {
            $this->factuurRegels->removeElement($factuurRegel);
            // set the owning side to null (unless already changed)
            if ($factuurRegel->getFactuurId() === $this) {
                $factuurRegel->setFactuurId(null);
            }
        }

        return $this;
    }
}
