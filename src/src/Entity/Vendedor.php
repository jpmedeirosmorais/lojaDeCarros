<?php

namespace App\Entity;

use App\Repository\VendedorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VendedorRepository::class)
 */
class Vendedor
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
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $senha;

    /**
     * @ORM\OneToMany(targetEntity=Carro::class, mappedBy="vendedor")
     */
    private $carro;

    public function __construct()
    {
        $this->carro = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
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

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * @return Collection|Carro[]
     */
    public function getCarro(): Collection
    {
        return $this->carro;
    }

    public function addCarro(Carro $carro): self
    {
        if (!$this->carro->contains($carro)) {
            $this->carro[] = $carro;
            $carro->setVendedor($this);
        }

        return $this;
    }

    public function removeCarro(Carro $carro): self
    {
        if ($this->carro->removeElement($carro)) {
            // set the owning side to null (unless already changed)
            if ($carro->getVendedor() === $this) {
                $carro->setVendedor(null);
            }
        }

        return $this;
    }
    public function  __toString(){
        return $this->nome;
    }
}
