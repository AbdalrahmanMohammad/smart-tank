<?php
  session_start();
  include("connection.php");
  include("function.php");

  $user_data= check_login($con);
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
  
  
  <section class="bar" >

   <div class=card>
   hallo,<?php echo $user_data['user_name'];?>
    </div>

    <div class=card>
    
    <div class="progress-circle">
    <div class="progress-text">100%</div>
    
    </div>
    </div>
    
  </section>
    

 <script >
        const progressText = document.querySelector('.progress-text');
        let progressValue = 0;
        const interval = setInterval(() => {
        if (progressValue >= 85) { // Set your target progress value here
       clearInterval(interval);
      } else {
        progressValue++;
        progressText.textContent = `${progressValue}%`;
        document.querySelector('.progress-circle').style.background = `conic-gradient(
        #29d5bf 0%,
        #0241b5 ${progressValue}%, 
        #cadcff ${progressValue}%,
        #cadcff 100%)`;
  }
}, 100);

    </script>
</body>
</html>

