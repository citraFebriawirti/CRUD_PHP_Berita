<?php
// Database connection settings
$host = 'localhost';         // Database host (typically 'localhost')
$user = 'root';              // Database username
$password = '';              // Database password (empty for default settings)
$dbname = 'db_berita';       // Name of the database to connect to

// Create a new MySQLi instance
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // Output the error message and stop execution if connection fails
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to UTF-8 to handle special characters
$conn->set_charset("utf8");

// echo "Database connection successful."; // This line can be removed once the connection is confirmed
?>