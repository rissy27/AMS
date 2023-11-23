<?php
session_start();
include "connect.php";

if (isset($_POST['employee_id']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $employee_id = validate($_POST['employee_id']);
    $password = validate($_POST['password']);
    
    if (empty($employee_id)) {
        header("Location: Login.php?error=Employee ID is required");
        exit();
    } else if (empty($password)) {
        header("Location: Login.php?error=Password is required");
        exit();
    } else {


            $sql = "SELECT * FROM employee_account WHERE employee_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $employee_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if ($row['employee_id'] === $employee_id && password_verify($password, $row['password'])) {
                    $_SESSION['employee_id'] = $row['employee_id'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['user_id'] = $row['id'];

                // Record time in Asia/Manila timezone
                $employee_id = $_SESSION['employee_id'];
                $user_id = $_SESSION['user_id'];
                date_default_timezone_set("Asia/Manila");
                $date = date("Y-m-d"); // Use a format suitable for the database
                $AM_time_in = date("H:i:A"); // Use a 24-hour format suitable for the database

                // Calculate lateness for AM time in
                $allowed_time = strtotime("13:00:00");  // Define the allowed time for AM time in
                $actual_time = strtotime($AM_time_in);
                $lateness_in_seconds = max(0, $actual_time - $allowed_time);

                // Convert lateness to minutes for easier display
                $latenesss = floor($lateness_in_seconds / 60);

                $current_time = date("H:i:s"); // Current time in 24-hour format

                    // Check if the employee already logged in for the day
                    $check_sql = "SELECT * FROM employee_time WHERE user_id=? AND date=?";
                    $check_stmt = $conn->prepare($check_sql);
                    $check_stmt->bind_param("ss", $user_id, $date);
                    $check_stmt->execute();
                    $check_result = $check_stmt->get_result();

    // Record time in regardless of the time range
               if ($check_result->num_rows === 0) {
                    $insert_sql = "INSERT INTO employee_time (user_id, employee_id, date, AM_time_in, lateness) VALUES (?, ?, ?, ?, ?)";
                    $insert_stmt = $conn->prepare($insert_sql);
                    $insert_stmt->bind_param("ssssi", $user_id, $employee_id, $date, $AM_time_in, $latenesss);
                if ($insert_stmt->execute()) {
                    header("Location: Login.php?success=AM Time In recorded. Late by $latenesss minutes.");
                    exit();
                } else {
                    header("Location: Login.php?error=Error Recording Time In.");
                    exit();
                }
            } else if ($check_result->num_rows === 1 && strtotime($current_time) >= strtotime("00:01:00") && strtotime($current_time) <= strtotime("00:11:00")) {
                    $AM_time_out = date("H:i:A");
                    $update_sql = "UPDATE employee_time SET AM_time_out=? WHERE user_id=? AND date=?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("sss", $AM_time_out, $user_id, $date);
                        if ($update_stmt->execute()) {
                            header("Location: Login.php?success=AM Time Out recorded.");
                            exit();
                        } else {
                            header("Location: Login.php?error=Error Recording Time Out.");
                            exit();
                        }
                } 
               

                $PM_time_in = date("H:i A");
                $allowed_time = strtotime("13:35:00");  // Define the allowed time for AM time in
                $actual_time = strtotime($PM_time_in);
                $lateness_in_seconds = max(0, $actual_time - $allowed_time);
 
                // Convert lateness to minutes for easier display
                $latenesss = floor($lateness_in_seconds / 60);
 

                
                if ($check_result->num_rows === 0 && strtotime($current_time) >= strtotime("00:12:00") && strtotime($current_time) <= strtotime("00:15:00")) {
                } else if ($check_result->num_rows === 1 && strtotime($current_time) >= strtotime("00:12:00") && strtotime($current_time) <= strtotime("00:15:00")) {
                    $check_pm_sql = "SELECT * FROM employee_time WHERE user_id='$user_id' AND date='$date'";
                    $check_pm_result = mysqli_query($conn, $check_pm_sql);
                    if (mysqli_num_rows($check_pm_result) === 1) {
                        $sql_pm_in = "UPDATE employee_time SET PM_time_in='$PM_time_in' WHERE user_id='$user_id' AND date='$date'";
                        if ($conn->query($sql_pm_in) === TRUE) {
                            header("Location: Login.php?success=PM Time In recorded.");
                            exit();
                        } else {
                            header("Location: Login.php?error=Error Recording PM Time In.");
                            exit();
                        }
                    }
                    } else if (strtotime($current_time) >= strtotime("13:45:00") && strtotime($current_time) <= strtotime("23:32:00")) {
                        // Employee already timed in for the afternoon shift, update time out
                        $PM_time_out = date("H:i A");
                        $update_pm_sql = "UPDATE employee_time SET PM_time_out='$PM_time_out' WHERE user_id='$user_id' AND date='$date'";
                        if ($conn->query($update_pm_sql) === TRUE) {
                            header("Location: Login.php?success=PM Time Out recorded.");
                            exit();
                            } else {
                                header("Location: Login.php?error=Error Recording PM Time Out.");
                                exit();
                            }
                        
                    } else {
                        header("Location: Login.php?error=You are outside the allowed time range.");
                    }
                
               
        } else {
            header("Location: Login.php?error=Incorrect Employee ID or password");
                exit();
            }
    } else {
        header("Location: Login.php?error=Incorrect Employee ID or password");
            exit();
        } 
} 
}

?>