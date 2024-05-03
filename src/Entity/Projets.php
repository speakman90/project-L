<?php

namespace App\Entity;

use App\Repository\ProjetsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProjetsRepository::class)]
#[Vich\Uploadable]
class Projets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lien = null;

    #[Vich\UploadableField(mapping: 'projet_picture', fileNameProperty: 'name')]
    private ?File $picture = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alt_picture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alt_lien = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(?string $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    public function getPicture(): ?File
    {
        return $this->picture;
    }

    public function setPicture(?File $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAltPicture(): ?string
    {
        return $this->alt_picture;
    }

    public function setAltPicture(?string $alt_picture): static
    {
        $this->alt_picture = $alt_picture;

        return $this;
    }

    public function getAltLien(): ?string
    {
        return $this->alt_lien;
    }

    public function setAltLien(?string $alt_lien): static
    {
        $this->alt_lien = $alt_lien;

        return $this;
    }
    
}
