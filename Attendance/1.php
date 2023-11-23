<!DOCTYPE html>
<html>
<head>
    <title>Employee Time Tracking</title>
</head>
<body>
    <h1>Employee Time Tracking</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Shift: 
        <select name="shift" required>
            <option value="AM">AM</option>
            <option value="PM">PM</option>
        </select><br>
        <input type="submit" name="login" value="Login">
    </form>

    <?php
    $servername = "your_server_name";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $shift = $_POST['shift'];

        $sql = "SELECT id, username, password FROM employees WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $employeeId = $row['id'];

                // Record time in and time out based on shift in Asia/Manila timezone
                date_default_timezone_set('Asia/Manila');
                if ($shift == 'AM') {
                    $timeIn = date('Y-m-d H:i:s');
                    $timeOut = date('Y-m-d H:i:s', strtotime($timeIn) + 3600); // 1 hour for demonstration
                    $sql = "INSERT INTO attendance (employee_id, am_time_in, am_time_out) 
                            VALUES ('$employeeId', '$timeIn', '$timeOut')";
                } else {
                    $timeIn = date('Y-m-d H:i:s');
                    $timeOut = date('Y-m-d H:i:s', strtotime($timeIn) + 3600); // 1 hour for demonstration
                    $sql = "INSERT INTO attendance (employee_id, pm_time_in, pm_time_out) 
                            VALUES ('$employeeId', '$timeIn', '$timeOut')";
                }

                if ($conn->query($sql) === TRUE) {
                    echo "Time In recorded: $timeIn<br>";
                    echo "Time Out recorded: $timeOut";
                } else {
                    echo "Error recording time: " . $conn->error;
                }
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Employee not found.";
        }
    }

    $conn->close();
    ?>
</body>
</html>
give code in php, html about automatic time in and time timezone asia manila  out of employee when logging in with database and create account with no dashboard

give me code in php, html about automatic AM time in, AM time out, PM time in, and PM time out of employee when logging in only with database and create account with no dashboard with  timezone from asia manila
