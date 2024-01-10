<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Repository\CommentaireEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireEventRepository::class)]
class CommentaireEvent
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireEvents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evennement $Evennement = null;

   

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEvennement(): ?Evennement
    {
        return $this->Evennement;
    }

    public function setEvennement(?Evennement $Evennement): static
    {
        $this->Evennement = $Evennement;

        return $this;
    }

}
