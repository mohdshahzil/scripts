<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password if necessary
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$dbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($dbQuery) === TRUE) {
    // echo "Database created or exists.<br>"; // Optional message for debugging
} else {
    die("Error creating database: " . $conn->error);
}

// Use the database
$conn->select_db($dbname);

// Create the users table if it doesn't exist
$tableQuery = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    country VARCHAR(50) NOT NULL
)";

if ($conn->query($tableQuery) === TRUE) {
    // echo "Table created or exists.<br>"; // Optional message for debugging
} else {
    die("Error creating table: " . $conn->error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $gender = $_POST['gender'];
    $country = $_POST['country'];

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, gender, country) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $gender, $country);

    // Execute statement
    if ($stmt->execute()) {
        echo "<p class='success'>Registration successful!</p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Fetch all users from the users table and display them
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>All Registered Users</h2>";
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Country</th>
            </tr>";

    // Output data for each user
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["name"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars($row["gender"]) . "</td>
                <td>" . htmlspecialchars($row["country"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No users found.</p>";
}

// Close connection
$conn->close();
?>
