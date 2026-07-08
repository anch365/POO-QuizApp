<?php

// LA STRUCTURE DE BASE
class Quiz
{
    private array $questionIds;
    private int $score;
    private int $currentIndex;
    private int $startTime;
    private ?string $lastResult;

    public function __construct(array $questionIds)
    {
        $this->questionIds = $questionIds;
        $this->score = 0;
        $this->currentIndex = 0;
        $this->startTime = time();
        $this->lastResult = null;
    }

// LES GETTERS DE BASE
    public function getCurrentQuestionId(): ?int
    {
        if ($this->currentIndex >= count($this->questionIds)) {
            return null;
        }
        return $this->questionIds[$this->currentIndex];
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getTotal(): int
    {
        return count($this->questionIds);
    }

    public function getTempsEcoule(): int
    {
        return time() - $this->startTime;
    }

    public function getLastResult(): ?string
    {
        return $this->lastResult;
    }

    public function getCurrentIndex(): int
    {
        return $this->currentIndex;
    }

    public function getQuestionIds(): array
    {
        return $this->questionIds;
    }

    // LES METHODES D'ACTION
    public function repondre(bool $estCorrect): void
    {
        if ($estCorrect) {
            $this->score++;
            $this->lastResult = 'Bonne réponse !';
        } else {
            $this->lastResult = 'Mauvaise réponse';
        }
    }

    public function timeout(): void
    {
        $this->lastResult = 'Temps écoulé !';
    }

    public function next(): bool
    {
        $this->currentIndex++;
        return $this->currentIndex < count($this->questionIds);
    }

    public function isFinished(): bool
    {
        return $this->currentIndex >= count($this->questionIds);
    }
}
