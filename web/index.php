<?php
session_start();
include ("connection.php");
include ("function.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Title</title>
  <link rel="stylesheet" href="a1.css">
  <style>
    .progress-circle {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background: conic-gradient(rgb(41 213 191) 0%, rgb(2 65 181) 95%, rgb(24 56 117) 95%, rgb(207 212 221) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: Arial, sans-serif;
    }

    .progress-text {
      font-size: 20px;
      color: #333;
    }
  </style>

</head>

<body>
  <header class="navbar">
    <div class="logo">
      <img src="Rain Droplet Into Rings.jpg" alt="Logo">
    </div>
    <nav>
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="logout.php">log out</a></li>
      </ul>
    </nav>
    <div class="burger">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>
  </header>


  <section class="bar">

    <div class=card>
      hallo,<?php echo $user_data['user_name']; ?>
    </div>

    <div class=card>

      <div class="progress-circle">
        <div class="progress-text">100%</div>

      </div>
    </div>

  </section>


  <script>
    let progressValue = 0; // Initialize progressValue outside the function
    let previousPercentage = -1; // Initialize previousPercentage to a value that won't occur in the normal range (e.g., -1)

    function update_gauge(percentage) {
        // Check if the new percentage is the same as the previous percentage
        if (percentage === previousPercentage) {
            return; // If yes, do nothing and return
        }

        // Update previousPercentage with the new value
        previousPercentage = percentage;

        const progressText = document.querySelector('.progress-text');
        const progressCircle = document.querySelector('.progress-circle');
        const targetValue = percentage; // Set the target value

        // Determine the direction of movement (forward or backward)
        const increment = (targetValue > progressValue) ? 1 : -1;

        // Update the gauge value in the appropriate direction
        const interval = setInterval(() => {
            if (progressValue === targetValue) {
                clearInterval(interval);
            } else {
                progressValue += increment;
                progressText.textContent = `${progressValue}%`;
                progressCircle.style.background = `conic-gradient(
                #29d5bf 0%,
                #0241b5 ${progressValue}%, 
                #cadcff ${progressValue}%,
                #cadcff 100%)`;
            }
        }, 10);
    }

    setInterval(Get_Data, 500);

    function Get_Data() {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var myObj = JSON.parse(this.responseText);

                // Log the percentage value to the console
                console.log("Percentage:", myObj.percentage);

                // Pass the percentage value to the update_gauge function
                update_gauge(myObj.percentage);
            }
        };

        xmlhttp.open("POST", "/tank/web/php_codes/getReading.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("");
    }
</script>




</body>

</html>