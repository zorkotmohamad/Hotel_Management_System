<?php 
include("connection.php");
session_start(); 
$error=0;
$username= $email= $password=$password_hashed="";
$error_username=$error_password=$error_email=$error_special_email=$error_password="";
$check_username=$check_email=$user_exsist="";

if (isset($_POST["cancel"])){
    header("location:login.php");
  }

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["submit"])){

    $username=mysqli_real_escape_string($connect,$_POST["username"]);
    $email=mysqli_real_escape_string($connect,$_POST["email"]);
    $password=mysqli_real_escape_string($connect,$_POST["password"]);

    $check_username="SELECT * FROM customers WHERE username='$username'";
    $result_username=mysqli_query($connect,$check_username);
    if(mysqli_num_rows($result_username)>0){
      $user_exsist="the username is already exist please select another name other than [ $username ]"; $error++;}

    $check_email="SELECT * FROM customers WHERE username='$email'";
    $result_email=mysqli_query($connect,$check_email);
      if(mysqli_num_rows($result_email)>0){ 
        $user_exsist="the username is already exist please select another name other than [ $email ]"; $error++;}
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){ $error_email="The email address is not valid"; $error++;}
    if(empty($username)){ $error_username="Username is required"; $error++;}
    if(empty($email)){ $error_email="Email is required"; $error++;}
    if(empty($password)){ $error_password="Password is required"; $error++;}

    if( $error==0){
      $_SESSION["USERNAME"]=$username;
      $password_hashed=md5($password);
      $insert_query="INSERT INTO customers(username,email,password) 
      VALUES ('$username','$email','$password_hashed')";
      mysqli_query($connect,$insert_query);
      header("location:reservations.php");
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <title>Hotel</title>
<link rel="stylesheet" href="../css/registration.css">
<body>

  <form class="modal-content" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" >
    <div class="container">
      <h1>Sign Up</h1>
      <hr>
      <P style="color:red"><?php echo $user_exsist ; ?></P>
      <P style="color:red"><?php echo $error_username ; ?></P>
      <label for="email"><b>Username</b></label> <br>
      <input type="text" placeholder="Enter username" name="username" >
<br>
      
      <P style="color:red"><?php echo $error_email ; ?></P>
      <label  for="email"><b>Email</b></label> <br>
      <input type="text" placeholder="Enter Email" name="email" >
<br>  
      <P style="color:red"><?php echo $error_username ; ?></P>
      <label for="psw"><b>Password</b></label> <br>
      <input type="password" placeholder="Enter Password" name="password" >
      
    </div>
    <div class="clearfix">
      <button type="submit" class="cancelbtn" name="cancel">Cancel</button>
      <button type="submit" class="signupbtn" name="submit">Sign Up</button>
    </div> 
  </form>
</div>


</body>
</html>
