<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImagesRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\OneToMany(mappedBy: 'picture', targetEntity: About::class)]
    private Collection $abouts;

    #[ORM\OneToMany(mappedBy: 'picture', targetEntity: Prestations::class)]
    private Collection $prestations;

    #[ORM\OneToMany(mappedBy: 'picture', targetEntity: Projets::class)]
    private Collection $projets;

    #[Vich\UploadableField(mapping: "about_images", fileNameProperty: "reference")]
    private File $file;

    public function __construct()
    {
        $this->abouts = new ArrayCollection();
        $this->prestations = new ArrayCollection();
        $this->projets = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, About>
     */
    public function getAbouts(): Collection
    {
        return $this->abouts;
    }

    public function addAbout(About $about): static
    {
        if (!$this->abouts->contains($about)) {
            $this->abouts->add($about);
            $about->setPicture($this);
        }

        return $this;
    }

    public function removeAbout(About $about): static
    {
        if ($this->abouts->removeElement($about)) {
            // set the owning side to null (unless already changed)
            if ($about->getPicture() === $this) {
                $about->setPicture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Prestations>
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestations $prestation): static
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations->add($prestation);
            $prestation->setPicture($this);
        }

        return $this;
    }

    public function removePrestation(Prestations $prestation): static
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getPicture() === $this) {
                $prestation->setPicture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Projets>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projets $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setPicture($this);
        }

        return $this;
    }

    public function removeProjet(Projets $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getPicture() === $this) {
                $projet->setPicture(null);
            }
        }

        return $this;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function setFile(File $file): static
    {
        $this->file = $file;

        return $this;
    }
}
