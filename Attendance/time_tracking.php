<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("location: Login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Time Tracking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#AM_time_in_btn').click(function () {
                $.ajax({
                    url: 'record_time.php',
                    type: 'POST',
                    data: { action: 'AM_time_in', user_id: <?php echo $user_id; ?> },
                    success: function () {
                        alert('Time In recorded.');
                    }
                });
            });
            

            $('#AM_time_out_btn').click(function () {
                $.ajax({
                    url: 'record_time.php',
                    type: 'POST',
                    data: { action: 'AM_time_out', user_id: <?php echo $user_id; ?> },
                    success: function () {
                        alert('Time Out recorded.');
                    }
                });
            });
            $('#PM_time_in_btn').click(function () {
                $.ajax({
                    url: 'record_time.php',
                    type: 'POST',
                    data: { action: 'PM_time_in', user_id: <?php echo $user_id; ?> },
                    success: function () {
                        alert('Time In recorded.');
                    }
                });
            });
            $('#PM_time_out_btn').click(function () {
                $.ajax({
                    url: 'record_time.php',
                    type: 'POST',
                    data: { action: 'PM_time_out', user_id: <?php echo $user_id; ?> },
                    success: function () {
                        alert('Time Out recorded.');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h2>Employee Time Tracking</h2>
       <p><span id="clock"></span></p>
       <script>
        function updateClock() {
            const options = {
                timeZone: 'Asia/Manila',
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const manilaDateTime = new Date().toLocaleString('en-US', options);
            document.getElementById('clock').textContent = `Date and Time: ${manilaDateTime}`;
        }

        updateClock(); // Display initial time and date
        setInterval(updateClock, 1000); // Update time and date every second
    </script>
              <h>AM TIME</h>
    <button id="AM_time_in_btn">AM_Time In</button>
    <button id="AM_time_out_btn">AM_Time Out</button>
              <h>PM TIME</h>
    <button id="PM_time_in_btn">PM_Time In</button>
    <button id="PM_time_out_btn">PM_Time Out</button>
</body>
</html>
