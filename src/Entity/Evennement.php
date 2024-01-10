<?php

namespace App\Entity;

use App\Repository\EvennementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvennementRepository::class)]
class Evennement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'Evennement', targetEntity: CommentaireEvent::class)]
    private Collection $commentaireEvents;





    public function __construct()
    {
        $this->commentaireEvents = new ArrayCollection();
    }


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

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, CommentaireEvent>
     */
    public function getCommentaireEvents(): Collection
    {
        return $this->commentaireEvents;
    }

    public function addCommentaireEvent(CommentaireEvent $commentaireEvent): static
    {
        if (!$this->commentaireEvents->contains($commentaireEvent)) {
            $this->commentaireEvents->add($commentaireEvent);
            $commentaireEvent->setEvennement($this);
        }

        return $this;
    }

    public function removeCommentaireEvent(CommentaireEvent $commentaireEvent): static
    {
        if ($this->commentaireEvents->removeElement($commentaireEvent)) {
            // set the owning side to null (unless already changed)
            if ($commentaireEvent->getEvennement() === $this) {
                $commentaireEvent->setEvennement(null);
            }
        }

        return $this;
    }

 

}


