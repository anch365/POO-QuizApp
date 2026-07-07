<?php
class Question
{
    private int $id;
    private string $texte;
    private string $image;
    private array $reponses;

    public function __construct(int $id, string $texte, string $image, array $reponses)
    {
        $this->id = $id;
        $this->texte = $texte;
        $this->image = $image;
        $this->reponses = $reponses;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTexte(): string
    {
        return $this->texte;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getReponses(): array
    {
        return $this->reponses;
    }

    public function getBonneReponse(): ?Reponse
    {
        foreach ($this->reponses as $reponse) {
            if ($reponse->estVraie()) {
                return $reponse;
            }
        }
        return null;
    }
}
