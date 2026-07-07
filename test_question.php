<?php
require_once "utils/db_connect.php";
require_once "src/Entities/Reponse.php";
require_once "src/Entities/Question.php";
require_once "src/Entities/Quiz.php";
require_once "src/Repositories/QuizRepository.php";

$repo = new QuizRepository($db);

$quiz = $repo->startQuiz();
echo "Quiz : " . $quiz->getTotal() . " questions\n";

$question = $repo->loadQuestion($quiz->getCurrentQuestionId());
echo "Question : " . $question->getTexte() . "\n";
echo "Bonne réponse : " . $question->getBonneReponse()->getTexte() . "\n";