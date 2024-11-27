<?php
$errorMessages = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $securityAnswer = $_POST['security_answer'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Invalid email format.";
    }

    if (strlen($password) < 8 || !preg_match('/[\W_]/', $password)) {
        $errorMessages[] = "Password must be at least 8 characters long and include at least one special character.";
    }

    if (empty($securityAnswer)) {
        $errorMessages[] = "Security question answer cannot be empty.";
    }

    if (empty($errorMessages)) {
        echo "<p>Form submitted successfully!</p>";
        echo "<p>Email: " . htmlspecialchars($email) . "</p>";
        echo "<p>Security Answer: " . htmlspecialchars($securityAnswer) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>

<body>
    <form method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="security_answer">Security Question Answer:</label><br>
        <input type="text" id="security_answer" name="security_answer" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <?php
    if (!empty($errorMessages)) {
        echo "<ul style='color: red;'>";
        foreach ($errorMessages as $message) {
            echo "<li>" . htmlspecialchars($message) . "</li>";
        }
        echo "</ul>";
    }
    ?>
</body>

</html>