<?php
include "connect.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title> DASHBOARD </title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
body{
    background-color: cadetblue;
    }
.loginbtn {  
    background-color: teal;  
    float: center;
    color: white;  
    padding: 10px 15px;  
    margin-right: 10px 0;  
    border-radius: 5px;  
    cursor: pointer;  
    opacity: 0.9;  
}  
form{
  font-family: sans-serif; 
  width: ;
  background-color: white; 
  border: 2px solid #ccc;
  padding: 10px;
  border-radius: 15px;
  font-weight: lighter;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    width: px;
    padding: 10px;
    text-align: center;
}
.text-white {
  color: white;
}
</style>
    </head>

    <body>
         <center> <h1> ATTENDANCE MONITORING SYSTEM </h1> </center> 
         <button class="loginbtn"><a href="employee_create_account.php" class="text-white">Add Employee</a></button>
         <button class="loginbtn"><a href="admin_login.php" class="text-white">Back</a></button>
         <br>
<br>
<div>
<table>
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Firstname</th>
      <th scope="col">Middlename</th>
      <th scope="col">Lastname</th>
    </tr>
  </thead>

  <tbody>
<?php
$sql = "SELECT * FROM employee_account";
$result = mysqli_query($conn, $sql);
if($result){
  while($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $firstname=$row['firstname'];
    $middlename=$row['middlename'];
    $lastname=$row['lastname'];
    echo '<tr>
    <th scope="row">'.$id.'</th>
    <td>'.$firstname.'</td>
    <td>'.$middlename.'</td>
    <td>'.$lastname.'</td>
    <td>
  </tr>';
}
}
?>
  </tbody>
</table>
    </body>
</html>