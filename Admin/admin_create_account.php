<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <title> Admin Account </title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>
body{
  background: white;
  background-image: url("samurai.jpg");
  background-size: 110%;
  background-position-x: 50%;
  background-position-y: 39%;
  display: flex;
  justify-content: center;
  align-items: center;
  height: vh;
  flex-direction: column;
  padding: 200px;
}  
.container{  
  font-family: sans-serif;
  box-sizing: border-box;  
  float: left;
}  
  form{
  width: 500px;
  border: 2px solid rgb(192, 182, 182);
  padding: 50px;
  background: #fff;
  border-radius: 15px;
 
}
input[type=text], input[type=password], textarea {  
  width: 90%;  
  padding: 15px;  
  margin: 5px 0 22px 0;  
  display: inline-block;  
  border: none;  
  background: #f1f1f1;  
}  
div {  
            padding: 10px 0;  
         }  
hr {  
  border: 1px solid #f1f1f1;  
  margin-bottom: 25px;  
}  
.loginbtn {  
  background-color: rgb(62, 62, 146);  
  color: white;  
  padding: 10px 15px;  
  float: right;
  margin-right: 10px 0;  
  border-radius: 5px;  
  cursor: pointer;  
  opacity: 0.9;  
}

</style>

<body>
<form onSubmit="return validate();"  method="POST" action="admin_create_account_check.php"> 
  <center>  <h1> REGISTER </h1> </center>  
  <?php if (isset($_GET['error'])){ ?>
  <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
  </div>
  <?php } ?>

  <?php if (isset($_GET['success'])){ ?>
  <div class="alert alert-danger" role="alert">
            <?php echo $_GET['success']; ?>
  </div>
  <?php } ?>

  <label> Firstname: </label>    
  <input type="text" name="firstname" placeholder="Enter Firstname" size="15"
  value="<?php echo (isset($_GET['firstname']))?$_GET['firstname']:"" ?>"/>

  <label> Middlename: </label>    
  <input type="text" name="middlename" placeholder="Enter Middlename" size="15"
  value="<?php echo (isset($_GET['middlename']))?$_GET['middlename']:"" ?>"/>

  <label> Lastname: </label>    
  <input type="text" name="lastname" placeholder="Enter Lastname" size="15"
  value="<?php echo (isset($_GET['lastname']))?$_GET['lastname']:"" ?>"/>

  <label> Username: </label>    
  <input type="text" name="username" placeholder="Enter Username" size="15"
  value="<?php echo (isset($_GET['username']))?$_GET['username']:"" ?>"/>
  
  <label for="psw"> Password: </label>  
  <input type="password" placeholder="Enter Password" name="password"required />  
  <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i> <br>
  
  <label for="psw-repeat"> Re-type Password: </label>  
  <input type="password" placeholder="Retype Password" name="repeat_password"required>  
  <br>

  <a href="http://localhost/AMS/Admin/admin_login.php"><b>Already have an account<b></a> 
  <button type="submit" name= "" value="login" id="submit" class="loginbtn"> Register </button>
</form>
</body>
</html>