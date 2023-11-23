<!DOCTYPE html>
<html>
<head>
   <title> ADMIN LOGIN </title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
body{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: rgb(33, 53, 95);  
  background-size: 110%;
  background-position-x: 50%;
  background-position-y: 39%;
  float: center;
  padding: 0px;
}  
.container {  
  font-family: sans-serif; 
  box-sizing: border-box;
}
form{
  background: white;
  font-family: sans-serif; 
  width: 400px;
  border: 2px solid #ccc;
  padding: 50px;
  border-radius: 15px;
}

input[type=text], input[type=password], textarea {  
  width: 91%;  
  padding: 15px;  
  margin: 5px 0 22px 0;  
  display: inline-block;  
  border: 1px solid black ;  
  background: #f1f1f1;  
}  
div {  
            padding: 10px 0;  
         }  
hr {  
  border: 1px solid #f1f1f1;  
}  
.loginbtn {  
  background-color: rgb(62, 62, 146);  
  color: white;  
  padding: 10px 15px;  
  float: right;
  margin-right: 2px;  
  border-radius: 5px;  
  cursor: pointer;  
  opacity: 0.9;  
}  
.text-white {
  color: white;
}
</style>
<form action="admin_login_check.php" method="POST">  
<center>  <h1> LOGIN </h1> </center>  
<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
       <label > <b>Username:</b>
           <input type="text"  name="username" placeholder="Enter Username"  
           value="<?php echo (isset($_GET['username']))?$_GET['username']:"" ?>"/>
       </label>
       <br>
       <label > <b>Password:</b>
                   <input type="password" name="password" placeholder="Enter Password"  />
       </label>
       <br>
       <button type="submit" name="submit" class="loginbtn"> Login </button>
       <button class="loginbtn"><a href="Accounts.html" class="text-white">Back</a></button>
       <br>
       <a href="http://localhost/AMS/admin/admin_create_account.php"><b>Create an account</b></a>
</form>
</body>
</html>