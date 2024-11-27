<?php
$mysqli = new mysqli("localhost", "root", "", "event_system");

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $eventId = $_POST['event_id'];
    $userName = $_POST['user_name'];
    $userEmail = $_POST['user_email'];

    if ($eventId && $userName && filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $stmt = $mysqli->prepare("INSERT INTO registrations (event_id, user_name, user_email) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $eventId, $userName, $userEmail);
        $stmt->execute();
        echo "<p>Registration successful for event ID: $eventId</p>";
    } else {
        echo "<p>Invalid input. Please try again.</p>";
    }
}

$events = $mysqli->query("SELECT * FROM events WHERE date >= CURDATE()");
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Upcoming Events</h2>
    <?php if ($events->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
            <?php while ($event = $events->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['name']); ?></td>
                    <td><?php echo htmlspecialchars($event['date']); ?></td>
                    <td><?php echo htmlspecialchars($event['location']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                            <input type="text" name="user_name" placeholder="Your Name" required>
                            <input type="email" name="user_email" placeholder="Your Email" required>
                            <button type="submit" name="register">Register</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No upcoming events found.</p>
    <?php endif; ?>
</body>

</html>


?>


<?php
$mysqli = new mysqli("localhost", "root", "", "event_system");

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("
    SELECT e.name AS event_name, COUNT(r.id) AS total_registrations
    FROM events e
    LEFT JOIN registrations r ON e.id = r.event_id
    GROUP BY e.id
");

?>

<!DOCTYPE html>
<html>

<body>
    <h2>Event Registrations Report</h2>
    <table border="1">
        <tr>
            <th>Event Name</th>
            <th>Total Registrations</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                <td><?php echo $row['total_registrations']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>



<!--

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    location VARCHAR(255) NOT NULL
);

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

INSERT INTO events (name, date, location) VALUES
('Tech Conference', '2024-12-05', 'New York'),
('Art Workshop', '2024-12-10', 'San Francisco'),
('Music Festival', '2024-12-15', 'Los Angeles');



->