<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $nom = null;

    #[ORM\Column(length: 15)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $ticket = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    private ?Voyage $fk_voyage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTicket(): ?int
    {
        return $this->ticket;
    }

    public function setTicket(int $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getFkVoyage(): ?Voyage
    {
        return $this->fk_voyage;
    }

    public function setFkVoyage(?Voyage $fk_voyage): self
    {
        $this->fk_voyage = $fk_voyage;

        return $this;
    }
}
