<?php
$questions = [
    [
        "question" => "What is the capital of France?",
        "options" => ["A. Paris", "B. Berlin", "C. Rome", "D. Madrid"],
        "correct" => "A"
    ],
    [
        "question" => "Which planet is known as the Red Planet?",
        "options" => ["A. Earth", "B. Mars", "C. Venus", "D. Jupiter"],
        "correct" => "B"
    ],
    [
        "question" => "Who wrote 'Hamlet'?",
        "options" => ["A. Charles Dickens", "B. J.K. Rowling", "C. William Shakespeare", "D. Mark Twain"],
        "correct" => "C"
    ],
    [
        "question" => "What is the largest mammal?",
        "options" => ["A. Elephant", "B. Blue Whale", "C. Giraffe", "D. Orca"],
        "correct" => "B"
    ],
    [
        "question" => "Which element has the chemical symbol 'O'?",
        "options" => ["A. Oxygen", "B. Gold", "C. Silver", "D. Hydrogen"],
        "correct" => "A"
    ]
];

$score = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($questions as $index => $question) {
        if (!empty($_POST["q" . ($index + 1)]) && $_POST["q" . ($index + 1)] === $question["correct"]) {
            $score++;
        }
    }

    echo "<h3>Your Score: $score / " . count($questions) . "</h3>";
}
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Online Quiz</h2>
    <form method="post">
        <?php foreach ($questions as $index => $question): ?>
            <p><?php echo ($index + 1) . ". " . htmlspecialchars($question["question"]); ?></p>
            <?php foreach ($question["options"] as $option): ?>
                <label>
                    <input type="radio" name="q<?php echo $index + 1; ?>" value="<?php echo $option[0]; ?>">
                    <?php echo htmlspecialchars($option); ?>
                </label><br>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <br>
        <button type="submit">Submit Quiz</button>
    </form>
</body>

</html>