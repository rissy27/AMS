CREATE DATABASE employee_management;
USE employee_management;

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);

CREATE TABLE time_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    time_in DATETIME,
    time_out DATETIME,
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

<!DOCTYPE html>
<html>
<head>
    <title>Employee Time Tracking</title>
</head>
<body>
    <h1>Employee Time Tracking</h1>
    <form action="process.php" method="post">
        <label for="employee_name">Employee Name:</label><br>
        <input type="text" id="employee_name" name="employee_name"><br><br>
        <input type="submit" value="Clock In/Out">
    </form>
</body>
</html>

<?php
// Connect to the database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "employee_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get employee name from the form
$employee_name = $_POST['employee_name'];

// Check if the employee exists
$sql = "SELECT id FROM employees WHERE name='$employee_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Employee exists, get employee ID
    $row = $result->fetch_assoc();
    $employee_id = $row['id'];

    // Get current time and format it according to the Asia/Manila timezone
    $timezone = new DateTimeZone('Asia/Manila');
    $time_now = new DateTime('now', $timezone);
    $formatted_time = $time_now->format('Y-m-d H:i:s');

    // Check if the employee has a recent time_in entry (time_out will be NULL)
    $sql = "SELECT id, time_in FROM time_records WHERE employee_id=$employee_id AND time_out IS NULL ORDER BY time_in DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update the existing time_out entry
        $row = $result->fetch_assoc();
        $record_id = $row['id'];
        $sql = "UPDATE time_records SET time_out='$formatted_time' WHERE id=$record_id";
        if ($conn->query($sql) === TRUE) {
            echo "Clock Out successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Insert a new time_in entry
        $sql = "INSERT INTO time_records (employee_id, time_in) VALUES ($employee_id, '$formatted_time')";
        if ($conn->query($sql) === TRUE) {
            echo "Clock In successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Employee not found.";
}

$conn->close();
?>
