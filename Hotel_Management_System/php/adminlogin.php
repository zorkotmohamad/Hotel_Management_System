<?php
    session_start();
    include("connection.php");
    $username = $password = $error1 = $error2 =$error_admin= "";
    $error =0;
    
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        if(isset($_POST["submit"])){
        
    $username=mysqli_real_escape_string($connect,$_POST["username"]);
    $password=mysqli_real_escape_string($connect,$_POST["password"]);

    if(empty($username)){ $error1="Username is required"; $error++;}
    if(empty($password)){ $error2="Password is required"; $error++;}

if ($error==0){
    $check_admin="SELECT * FROM admin WHERE username ='$username' and password = '$password'";
            $result1=mysqli_query($connect,$check_admin);

            if(mysqli_num_rows($result1)==1){
                $_SESSION["username"]=$username;
                header("location:admin.php");
            }
            else{
                $error_admin="You are not the admin";
            }
}
        

    }
            
        }
        
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../css/adminlogin.css">
</head>
<body>
    <div class="login-container">
    <P style="color:red"><?php echo $error_admin ; ?></P>
        <h1>Login Admin</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
            <div class="input-group">
            <P style="color:red"><?php echo $error1 ; ?></P>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" autocomplete="off"><br>
                
            </div>
            <div class="input-group">
            <P style="color:red"><?php echo $error2 ; ?></P>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="off"><br>
                
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>