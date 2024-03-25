<?php
  session_start();
  include("connection.php");
  include("function.php");

 if($_SERVER["REQUEST_METHOD"] == "POST"){
   $user_name= $_POST['user_name'];
    $password= $_POST['password'];
    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        $user_id = random_num(20);
        $query ="insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
        mysqli_query($con,$query);
        header("Location: login.php");
        die;
    }else
    {
        echo "please enter some valid information!";
;    }

 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <link rel="stylesheet" href="loginstayl.css">
</head>
<body>
    <div class="container">
        <form method="post">
        
        <h1>FINAL PROJECT</h1>
        <label for="email">Username:</label>
        <input type="text" name="user_name"id="email"placeholder="naem@maile.exsambel"><br><br>
        <label for="password">Password:</label>
        <input type="password"name="password" id="password"placeholder="password"><br>
        <button id="log" class="button">submit</button>
        </form>
        <a herf="login.php" class ="Sign">login</a>
    </div>
    
    <!-- Link to your JavaScript file if you have one -->
    <!-- <script src="yourscript.js"></script> -->
</body>
</html>