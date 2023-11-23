<?php 
session_start(); 
include "connect.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$username = validate($_POST['username']);
	$password = validate($_POST['password']);
	$password = md5($password);


	if (empty($username)) {
		header("Location: Login.php?error=Username is required");
	    exit();
	}else if(empty($password)){
        header("Location: Login.php?error=Password is required");
	    exit();
	}else{
        

		$sql = "SELECT * FROM employee_account WHERE username='$username' AND password='$password'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['firstname'] = $row['firstname'];
            	$_SESSION['user_id'] = $row['id'];

// Record time in in Asia/Manila timezone
		$username = $_SESSION['username'];
		$user_id = $_SESSION['user_id'];
		date_default_timezone_set("asia/manila");
        $date = date(" M-d-Y",strtotime("+0 HOURS"));
        $AM_time_in = date(" h:i A",strtotime("+0 HOURS"));

$sql = "INSERT INTO employee_time (user_id, username, date, AM_time_in) VALUES ('$user_id','$username', '$date', '$AM_time_in')";
if ($conn->query($sql) === TRUE) {
	header("Location:Login.php?success=Time In recorded.");
	exit();
} else {
	header("Location:Login.php?error=Error Recording Time In.");
	exit();
}


// Record time in out Asia/Manila timezone
date_default_timezone_set("asia/manila");
$AM_time_out = date(" h:i A",strtotime("+0 HOURS"));

$sql = "UPDATE employee_time SET AM_time_out = '$AM_time_out' WHERE user_id = $user_id";
if ($conn->query($sql) === TRUE) {
header("Location:Login.php?success=Time In recorded.");
exit();
} else {
header("Location:Login.php?error=Error Recording Time In.");
exit();
}

            	
            }else{
				header("Location: Login.php?error=Incorrect Username or password");
		        exit();
			}
		}else{
			header("Location: Login.php?error=Incorrect Username or password");
	        exit();
		}
	}
	
}else{
	header("Location: Login.php");
	exit();
}