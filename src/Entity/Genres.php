<?php

namespace App\Entity;

use App\Repository\GenresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenresRepository::class)]
class Genres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $genre;

    #[ORM\OneToMany(mappedBy: 'Genre', targetEntity: FavouriteGenres::class, orphanRemoval: true)]
    private $favouriteGenres;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $genreEn;

    public function __construct()
    {
        $this->favouriteGenres = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

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
            $favouriteGenre->setGenre($this);
        }

        return $this;
    }

    public function removeFavouriteGenre(FavouriteGenres $favouriteGenre): self
    {
        if ($this->favouriteGenres->removeElement($favouriteGenre)) {
            // set the owning side to null (unless already changed)
            if ($favouriteGenre->getGenre() === $this) {
                $favouriteGenre->setGenre(null);
            }
        }

        return $this;
    }

    public function getGenreEn(): ?string
    {
        return $this->genreEn;
    }

    public function setGenreEn(?string $genreEn): self
    {
        $this->genreEn = $genreEn;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getGenre()." | ".$this->getGenreEn();
    }


}
