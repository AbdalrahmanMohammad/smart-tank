 <?php
  session_start();
  include("connection.php");
  include("function.php");

 if($_SERVER["REQUEST_METHOD"] == "POST"){
   $user_name= $_POST['user_name'];
    $password= $_POST['password'];
    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        //read
        
        $query ="select *from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con,$query);
        if($result){
            if($result && mysqli_num_rows($result)>0){
                $user_data = mysqli_fetch_assoc($result);
               if($user_data['password'] ===$password ){
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
               }
    
            }
        }
        echo "wrong password or username";
    }else
    {
        echo "please enter some valid information!";
;    }

 }

?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sing up</title>
    <link rel="stylesheet" href="loginstayl.css">
</head>
<body>
    <div class="container">
        <form method="post">
        
        <h1>FINAL PROJECT</h1>
        <label for="email">Username:</label>
        <input type="text" name="user_name"id="email"placeholder="user name"><br><br>
        <label for="password">Password:</label>
        <input type="password"name="password" id="password"placeholder="password"><br>
        <button id="log" class="button">Log In</button>
        </form>
        <a href="singup.php" class ="Sign">Sign up</a>
    </div>
    
    <!-- Link to your JavaScript file if you have one -->
    <!-- <script src="yourscript.js"></script> -->
</body>
</html>