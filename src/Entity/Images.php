<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $extension = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?about $lien = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?prestations $lien_prestation = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?projets $lien_projets = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getLien(): ?about
    {
        return $this->lien;
    }

    public function setLien(?about $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    public function getLienPrestation(): ?prestations
    {
        return $this->lien_prestation;
    }

    public function setLienPrestation(?prestations $lien_prestation): static
    {
        $this->lien_prestation = $lien_prestation;

        return $this;
    }

    public function getLienProjets(): ?projets
    {
        return $this->lien_projets;
    }

    public function setLienProjets(?projets $lien_projets): static
    {
        $this->lien_projets = $lien_projets;

        return $this;
    }
}
