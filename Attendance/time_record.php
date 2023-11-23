<!DOCTYPE html>
<html>
    <head>
        <title> Time Record </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                background: rgb(33, 53, 95);  
            }

            #button1 {
                height: 400px;
                width: 500px;
                float: left;
                margin-left: 300px;
                margin-top: 250px;
                background-color: white;
                text-align: center;
                border-radius: 20px;
            }

            #button2 {
                height: 400px;
                width: 500px;
                float: right;
                margin-right: 300px;
                margin-top: 250px;
                background-color: white;
                text-align: center;
                border-radius: 20px;
            }

            #button1:hover {
                background-color: burlywood;
                cursor:pointer;
            }

            #button2:hover {
                background-color: burlywood;
                cursor:pointer;
            }

            .p1{
                font-size: 60px;
                font-weight: bold;
                font-family: 'Times New Roman', Times, serif;
                padding-top: 30px;
                color: black;
            }
        </style>
    </head>

    <body>
        <button id="button1"> 
          <p class="p1">  TIME IN </p> 
        </button>

        <button id="button2"> 
          <a href="Login.php" style="text-decoration:none" class="p1">  TIME OUT </a>
        </button>

        <script>

            function goToPage() {
                window.location.href = 'Login.php'; 
                }
  
            document.getElementById('button1').addEventListener('click', goToPage);

            function goToPage() {
                window.location.href = 'Login.php'; 
                }
  
            document.getElementById('button2').addEventListener('click', goToPage);
        </script>

    </body>
</html>