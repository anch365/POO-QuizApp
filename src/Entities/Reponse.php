<?php
class Reponse
{
    private int $id;
    private string $texte;
    private bool $estVraie;

    public function __construct(int $id, string $texte, bool $estVraie)
    {
        $this->id = $id;
        $this->texte = $texte;
        $this->estVraie = $estVraie;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTexte(): string
    {
        return $this->texte;
    }

    public function estVraie(): bool
    {
        return $this->estVraie;
    }
}