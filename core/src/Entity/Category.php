<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Traits\EntityTraits;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Category
{
    use EntityTraits;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'file', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\ManyToMany(targetEntity: Education::class, mappedBy: 'category', orphanRemoval:true)]
    private ?Collection $education = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'category', orphanRemoval:true)]
    private ?Collection $user = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setImageFile(?File $file = null): void
    {
        $this->imageFile = $file;
    
        if ($file) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }   

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return Collection<int, Education>
     */
    public function getEducation(): ?Collection
    {
        return $this->education;
    }

    public function setEducation(?Collection $education): void
    {
        
        $this->education = $education;
    }

    public function getUser(): ?Collection
    {
        return $this->user;
    }

    public function setUser(?Collection $user): void
    {
        
        $this->user = $user;
    }
}