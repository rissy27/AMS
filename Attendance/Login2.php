<!DOCTYPE html>
<html>
<head>
  <title>Digital Clock with Light Effects - Asia/Manila Time</title>
  <style>
    .text {
      font-family: Arial, sans-serif;
      display: flex;
     justify-content: center;
      align-items: center; 
      height: 100vh;
      margin: 0;
      background-color: #000;
    }

    .clock-container {
      display: inline-block;
      padding: 20px;
      background-color: #222;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    .clock {
      font-size: 36px;
      color: #3498db;
      text-shadow: 0 0 10px #3498db, 0 0 20px #3498db, 0 0 30px #3498db;
    }
  </style>
</head>
<body>

<div class="clock-container">
  <div class="clock" id="clock">
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

</body>
</html>
