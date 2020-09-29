<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Memo::class, mappedBy="user")
     */
    private $memos;

    /**
     * @ORM\OneToMany(targetEntity=Base::class, mappedBy="user")
     */
    private $bases;

    /**
     * @ORM\OneToMany(targetEntity=Factuur::class, mappedBy="user_id")
     */
    private $factuurs;

    public function __construct()
    {
        $this->memos = new ArrayCollection();
        $this->bases = new ArrayCollection();
        $this->factuurs = new ArrayCollection();
    }

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(?string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Memo[]
     */
    public function getMemos(): Collection
    {
        return $this->memos;
    }

    public function addMemo(Memo $memo): self
    {
        if (!$this->memos->contains($memo)) {
            $this->memos[] = $memo;
            $memo->setUser($this);
        }

        return $this;
    }

    public function removeMemo(Memo $memo): self
    {
        if ($this->memos->contains($memo)) {
            $this->memos->removeElement($memo);
            // set the owning side to null (unless already changed)
            if ($memo->getUser() === $this) {
                $memo->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Base[]
     */
    public function getBases(): Collection
    {
        return $this->bases;
    }

    public function addBasis(Base $basis): self
    {
        if (!$this->bases->contains($basis)) {
            $this->bases[] = $basis;
            $basis->setUser($this);
        }

        return $this;
    }

    public function removeBasis(Base $basis): self
    {
        if ($this->bases->contains($basis)) {
            $this->bases->removeElement($basis);
            // set the owning side to null (unless already changed)
            if ($basis->getUser() === $this) {
                $basis->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Factuur[]
     */
    public function getFactuurs(): Collection
    {
        return $this->factuurs;
    }

    public function addFactuur(Factuur $factuur): self
    {
        if (!$this->factuurs->contains($factuur)) {
            $this->factuurs[] = $factuur;
            $factuur->setUserId($this);
        }

        return $this;
    }

    public function removeFactuur(Factuur $factuur): self
    {
        if ($this->factuurs->contains($factuur)) {
            $this->factuurs->removeElement($factuur);
            // set the owning side to null (unless already changed)
            if ($factuur->getUserId() === $this) {
                $factuur->setUserId(null);
            }
        }

        return $this;
    }
}
