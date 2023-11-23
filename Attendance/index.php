<!--<!DOCTYPE html>
<html>
<head>
  <title>Popup Example</title>
  <style> 
    /* Styling for the popup */
    .popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }
    .popup-content {
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
    }
  </style>
</head>
<body>

<button onclick="showPopup()">Show Popup</button>

<div id="popup" class="popup">
  <div class="popup-content">
    --- Content of the popup goes here 
    <h2>This is a popup!</h2>
    <p>Popup content goes here.</p>
    <button onclick="hidePopup()">Close</button>
  </div>
</div>

<script>
  function showPopup() {
    document.getElementById("popup").style.display = "flex";
  }

  function hidePopup() {
    document.getElementById("popup").style.display = "none";
  }
</script>

</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
  <title>Clickable Button Example</title>

  <style>
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

            #button1:hover {
                background-color: burlywood;
                cursor:pointer;
            }
  </style>
</head>
<body>

<!-- This is the button -->
<button id="button1">Click me!</button>

<script>
  // This function is called when the button is clicked
  

  function goToPage() {
     window.location.href = 'Login.php'; // Replace with the actual URL you want to go to
    }

  // Add an event listener to the button to call the buttonClick function when clicked
  
  document.getElementById('button1').addEventListener('click', goToPage);
</script>

</body>
</html>

