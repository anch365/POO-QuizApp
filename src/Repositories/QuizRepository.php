<?php
class QuizRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function startQuiz(): Quiz
    {
        $request = $this->db->prepare("SELECT id FROM questionnement ORDER BY RAND()");
        $request->execute();
        $ids = $request->fetchAll(PDO::FETCH_COLUMN);
        return new Quiz($ids);
    }

    public function loadQuestion(int $id): ?Question
    {
        $request = $this->db->prepare("SELECT * FROM questionnement WHERE id = :id");
        $request->execute([':id' => $id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;

        $request = $this->db->prepare("SELECT * FROM reponse WHERE question_id = :id");
        $request->execute([':id' => $id]);
        $reponsesData = $request->fetchAll(PDO::FETCH_ASSOC);

        $reponses = [];
        foreach ($reponsesData as $repData) {
            $reponses[] = new Reponse(
                (int)$repData['id'],
                $repData['reponse'],
                (bool)$repData['est_ce_vrai']
            );
        }

        return new Question(
            (int)$data['id'],
            $data['question'],
            $data['emplacement_image'],
            $reponses
        );
    }

    public function saveScore(Quiz $quiz, int $utilisateurId): void
    {
        $request = $this->db->prepare(
            "INSERT INTO score (utilisateur_id, score, temps_total) 
             VALUES (:utilisateur_id, :score, :temps_total)"
        );
        $request->execute([
            ':utilisateur_id' => $utilisateurId,
            ':score' => $quiz->getScore(),
            ':temps_total' => $quiz->getTempsEcoule()
        ]);
    }
}