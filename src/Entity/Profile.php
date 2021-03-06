<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'profile', targetEntity: Users::class, cascade: ['persist', 'remove'])]
    private $user;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $sex;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $age;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $city;

    #[ORM\Column(type: 'text', nullable: true)]
    private $about;

    #[ORM\OneToMany(mappedBy: 'profile', targetEntity: Image::class)]
    private $images;

    #[ORM\OneToMany(mappedBy: 'idProfile', targetEntity: FavouriteGenres::class, orphanRemoval: true)]
    private $favouriteGenres;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $vklink;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $instlink;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tglink;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->favouriteGenres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): self
    {
        $this->about = $about;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProfile($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProfile() === $this) {
                $image->setProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FavouriteGenres>
     */
    public function getFavouriteGenres(): Collection
    {
        return $this->favouriteGenres;
    }

    public function addFavouriteGenre(FavouriteGenres $favouriteGenre): self
    {
        if (!$this->favouriteGenres->contains($favouriteGenre)) {
            $this->favouriteGenres[] = $favouriteGenre;
            $favouriteGenre->setIdProfile($this);
        }

        return $this;
    }

    public function removeFavouriteGenre(FavouriteGenres $favouriteGenre): self
    {
        if ($this->favouriteGenres->removeElement($favouriteGenre)) {
            // set the owning side to null (unless already changed)
            if ($favouriteGenre->getIdProfile() === $this) {
                $favouriteGenre->setIdProfile(null);
            }
        }

        return $this;
    }

    public function getVklink(): ?string
    {
        return $this->vklink;
    }

    public function setVklink(?string $vklink): self
    {
        $this->vklink = $vklink;

        return $this;
    }

    public function getInstlink(): ?string
    {
        return $this->instlink;
    }

    public function setInstlink(?string $instlink): self
    {
        $this->instlink = $instlink;

        return $this;
    }

    public function getTglink(): ?string
    {
        return $this->tglink;
    }

    public function setTglink(?string $tglink): self
    {
        $this->tglink = $tglink;

        return $this;
    }
}
