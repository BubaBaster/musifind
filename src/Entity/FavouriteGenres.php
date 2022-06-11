<?php

namespace App\Entity;

use App\Repository\FavouriteGenresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavouriteGenresRepository::class)]
class FavouriteGenres
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Profile::class, inversedBy: 'favouriteGenres')]
    #[ORM\JoinColumn(nullable: false)]
    private $idProfile;

    #[ORM\ManyToOne(targetEntity: Genres::class, inversedBy: 'favouriteGenres')]
    #[ORM\JoinColumn(nullable: false)]
    private $Genre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProfile(): ?Profile
    {
        return $this->idProfile;
    }

    public function setIdProfile(?Profile $idProfile): self
    {
        $this->idProfile = $idProfile;

        return $this;
    }

    public function getGenre(): ?Genres
    {
        return $this->Genre;
    }

    public function setGenre(?Genres $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }
}
