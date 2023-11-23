<?php
require_once 'connect.php';

if (isset($_POST['action']) && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    

    if ($_POST['action'] === 'AM_time_in') {
        date_default_timezone_set("asia/manila");
        $date = date(" M-d-Y",strtotime("+0 HOURS"));
        $AM_time_in = date(" h:i A",strtotime("+0 HOURS"));
        $sql = "INSERT INTO employee_time (user_id, date, AM_time_in) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $date, $AM_time_in);
        $stmt->execute();
    }

    else if ($_POST['action'] === 'AM_time_out') {
        date_default_timezone_set("asia/manila");
        $AM_time_out = date(" h:i A",strtotime("+0 HOURS"));
        $sql = "UPDATE employee_time SET AM_time_out = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $AM_time_out, $user_id);
        $stmt->execute();
    }

    else if ($_POST['action'] === 'PM_time_in') {
        date_default_timezone_set("asia/manila");
        $PM_time_in = date(" h:i A",strtotime("+0 HOURS"));
        $sql = "UPDATE employee_time SET PM_time_in = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $PM_time_in, $user_id);
        $stmt->execute();

        } else if ($_POST['action'] === 'PM_time_out') {
            date_default_timezone_set("asia/manila");
            $PM_time_out = date(" h:i A",strtotime("+0 HOURS"));
            $sql = "UPDATE employee_time SET PM_time_out = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $PM_time_out, $user_id);
            $stmt->execute();
{
        // Calculate lateness
        $sql = "SELECT AM_time_in FROM employee_time WHERE user_id = ? AND time_out IS NOT NULL ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $AM_time_in = strtotime($row['AM_time_in']);
            $AM_time_out = strtotime($AM_time_out);
            $PM_time_in = strtotime($row['PM_time_in']);
            $PM_time_out = strtotime($row['PM_time_out']);
            $lateness = ($time_out - $time_in) / 60; // Calculate lateness in minutes
            $sql = "UPDATE employee_time SET lateness = ? WHERE user_id = ? AND time_out = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $lateness, $user_id, $time_out);
            $stmt->execute();
        }
    }
}
}
?>
