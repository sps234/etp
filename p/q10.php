<?php
// Start the session at the top of the page
session_start();

// Define session timeout duration (10 minutes in seconds)
$sessionTimeout = 10 * 60; // 10 minutes

// Check if the user is already logged in
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    // Check if the session has expired
    if (time() - $_SESSION['lastLoginTime'] > $sessionTimeout) {
        // Session expired, redirect to login page
        header("Location: login.php");
        exit();
    } else {
        // Session is still valid, update last login time
        $_SESSION['lastLoginTime'] = time();
    }
}

// Handle the login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Dummy user data for the sake of the example
    $validUsername = "admin";
    $validPassword = "password123";

    // Validate the login credentials
    if ($username == $validUsername && $password == $validPassword) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['lastLoginTime'] = time(); // Store current time as last login
        header("Location: dashboard.php"); // Redirect to a dashboard page after login
        exit();
    } else {
        $loginError = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login Page</h2>

    <?php
    // Display login error if any
    if (isset($loginError)) {
        echo "<p style='color: red;'>$loginError</p>";
    }
    ?>

    <!-- Login Form -->
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>


<!-- Dashboard Page 
 
// <php
// Start the session at the top of the page
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Display the last login time on the dashboard
$lastLoginTime = isset($_SESSION['lastLoginTime']) ? date("Y-m-d H:i:s", $_SESSION['lastLoginTime']) : "N/A";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Your last login time was: <php echo $lastLoginTime; ?></p>

    <a href="logout.php">Logout</a>
</body>
</html>


-->


<!-- Logout Page

<php
// Start the session
session_start();

// Destroy all session data to log the user out
session_unset();
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit();
?>

->