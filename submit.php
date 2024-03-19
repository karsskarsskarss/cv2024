<?php
// Database connection settings
$servername = "localhost"; // Your database server, often "localhost" or an IP address.
$username = "your_username"; // Your database username.
$password = "your_password"; // Your database password.
$dbname = "your_dbname"; // The name of your database.

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // If connection fails, the script will exit.
}

// Prepare an SQL statement for execution
// This helps prevent SQL injection attacks by separating SQL logic from the data being inputted.
$stmt = $conn->prepare("INSERT INTO contact_form_submissions (name, email, message, subscribe, gender, work_experience) VALUES (?, ?, ?, ?, ?, ?)");

// "sssbss" specifies the types of the variables in order: s = string, b = boolean.
// This must match the order and type of the columns in your database table.
$stmt->bind_param("sssbss", $name, $email, $message, $subscribe, $gender, $work_experience);

// Assign variables from POST data. These are the values that users enter in the form.
$name = $_POST['name']; // User's name
$email = $_POST['email']; // User's email
$message = $_POST['message']; // User's message
$subscribe = $_POST['subscribe'] === 'yes' ? true : false; // Whether the user subscribed to the newsletter
$gender = $_POST['gender']; // User's gender
$work_experience = $_POST['work-experience']; // User's work experience

// Execute the prepared statement with the variables
$stmt->execute();

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
