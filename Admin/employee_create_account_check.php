<?php 
session_start(); 
include "connect.php";

$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];


if (isset($_POST['username']) && isset($_POST['password'])
    && isset($_POST['firstname']) && isset($_POST['repeat_password'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

	

	$username = validate($_POST['username']);
	$password = validate($_POST['password']);
    

	$rePass = validate($_POST['repeat_password']);
	$firstname = validate($_POST['firstname']);

	$uppercase = preg_match("#[A-Z]+#", $password);
	$lowercase = preg_match("#[a-z]+#", $password);
	$number = preg_match("#[0-9]+#", $password);
	$specialChars = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])/', $password);

	 $user_data = 'username='. $username. '&firstname='. $firstname.'&middlename='. $middlename. '&lastname='. $lastname. '&address='. $address. '&zipcode='. $zipcode. '&birthday='. $birthday.'&email='. $email;
  

    $formValid = true;
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password)<8){
		header("Location: employee_create_account.php?error=Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character&$user_data");
	    exit();
	}
    else if($password !== $rePass){
        header("Location: employee_create_account.php?error=The confirmation password  does not match&$user_data");
        $formValid = false;
	    exit();
	} 
    else{


             $sql = "SELECT * FROM employee_account WHERE username='$username'";
             $result1 = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result1) > 0) {
             header("Location: employee_create_account.php?error=The username is taken try another&$user_data");
             exit();
    }
   
    else{
            $stmt = $conn->prepare("insert into employee_account(firstname,middlename,lastname,username,password)
            values(?, ?, ?, ?, ?)"); 
    
            $username = validate($_POST['username']);
            $password = validate($_POST['password']);
            $rePass = validate($_POST['repeat_password']);
            $firstname = validate($_POST['firstname']);
            $user_data = 'username='. $username. '&firstname='. $firstname;
    
                $stmt->bind_param("sssss",$firstname, $middlename, $lastname, $username,  md5($password));
            $stmt->execute();
            header("Location:employee_create_account.php?success=Your account has been created successfully");
            
    
            $stmt->close();
            $conn->close();
        
            }
        }
    }
