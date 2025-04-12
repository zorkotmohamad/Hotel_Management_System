<?php
    session_start();
    include("connection.php");
    setcookie("mohamad" ,"zorkot" , time()+60*60*24*30);

    $username=$password_hashed=$password="";
    $error="";
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        if(isset($_POST["submit"])){

            $username = mysqli_real_escape_string($connect,$_POST["username"]);
            $password = mysqli_real_escape_string($connect,$_POST["password"]);

        $password_hashed=md5($password);
        echo $password_hashed."  ".$password;
        $query="SELECT * FROM customers WHERE username='$username' AND password='$password_hashed'";
        $result=mysqli_query($connect,$query);
        if(mysqli_num_rows($result)==1){
            $_SESSION["USERNAME"]=$username;
            
            header("location:contact.php");
        }
        else{
        $error="You don't have an account";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hotel</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body> 
    <div class="header">
        <h1>WELCOME TO YOUR HOTEL</h1>
    </div> 

    <div class="container">

      <div class="center">
          <h1>Login</h1>

          <form action="" method="POST">

              <div class="txt_field">
                  <input type="text" name="username" required>
                  <span></span>
                  <label>Username</label>
              </div>

              <div class="txt_field">
                  <input type="password" name="password" required>
                  <span></span>
                  <label>Password</label>
              </div>
              
              <input name="submit" type="Submit" value="Login">

              <div class="signup_link">
                  Not a Member ? <a href="registration.php">Signup</a>
              </div>

          </form>

      </div>

    </div>
  
</body>
</html>