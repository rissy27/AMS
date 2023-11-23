<!DOCTYPE html>
<html>
    <head>
        <title> Time Track  </title>
            
        <style>
            body {
                background: rgb(33, 53, 95);
            }

            .div1 {
                background: white;
                font-family: sans-serif; 
                border: 2px solid #ccc;
                padding: 50px;
                border-radius: 15px;
                float: left;
                margin-top: 100px;
                margin-left: 200px;
            }

            .container {  
                font-family: sans-serif; 
                box-sizing: border-box;
            }

            .div2 {
                background: white;
                font-family: sans-serif; 
                border: 2px solid #ccc;
                padding: 20px 50px;
                border-radius: 15px;
                float: right;
                margin-top: 100px;
                margin-right: 200px;
            }

            .div3 {
                background: white;
                font-family: sans-serif; 
                width: 1000px;
                height: px;
                border: 2px solid #ccc;
                padding: 5px;
                border-radius: 10px;
                margin-left: 170px;
            }

            input[type=text], input[type=password], textarea {  
                width: 92%;  
                padding: 15px;  
                margin: 10px 0 10px 0;  
                display: inline-block;  
                border: 1px solid black ;  
                background: #f1f1f1; 
                font-size: 15px; 
            }  

            .text1 {
                color: black;
                font-size: 20px;
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
                font-size: 15px;
                width: 80px;
            } 

            .text-white1 {
                color: white;
                font-size: 15px;
            }

            .text-white2 {
                color: black;
                font-size: 30px;
                font-family: Georgia, 'Times New Roman', Times, serif;
                text-decoration: bold;
                margin-top: 1%;
            }
            .clock-container {
                 display: inline-block;
                 padding: 7px 10px;
                 background-color: #222;
                 border-radius: 5px;
                 box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
                 width: 330px;
                 
            }
            .clock {
                 font-size: 20px;
                 color: #3498db;
                 text-shadow: 0 0 10px #3498db, 0 0 20px #3498db, 0 0 30px #3498db;
            }
        </style>
    </head>


    <body> 
    <form action="login-check.php" method="POST">  
    
    <div class="div3">
    <center> <h1 class="text-white2"> EMPLOYEE TIME TRACKING </h1> </center>
    </div>

    <div class="div1"> 
        <center> <p class="text-white2">DATE AND TIME <p> </center>

        <div class="clock-container">
  <div class="clock" id="clock" >
     Date and Time: Loading...
  </div>
</div>

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
    document.getElementById('clock').textContent = `${manilaDateTime}`;
  }

  updateClock(); // Display initial time and date
  setInterval(updateClock, 1000); // Update time and date every second
</script>

    </div>

    <div class="div2" action="login-check.php" method="POST">  

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
            <label class="text1"> <b>Employee ID:</b>
                <input type="text"  name="username" placeholder="Enter Employee ID"  
                value="<?php echo (isset($_GET['username']))?$_GET['username']:"" ?>"/>
            </label>
       <br>
            <label class="text1"> <b>Password:</b>
                   <input type="password" name="password" placeholder="Enter Password"  />
            </label>
       <br>
       <br>
       Shift: 
        <select name="shift" required>
            <option value="AM">AM</option>
            <option value="PM">PM</option>
        </select><br>
            <button type="submit" name="submit" class="loginbtn"> Login </button>
            <button class="loginbtn"><a href="Accounts.html" style="text-decoration:none" class="text-white1">Back</a></button>
    </div>
    </form>
    </body>
</html>