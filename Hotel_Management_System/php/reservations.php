<?php 
include("connection.php");
session_start();

if(!isset($_SESSION["USERNAME"])){
    header("location: login.php");
}

$username=$mobile=$duration="";
$error_duration=$error_mobile="";
$error=0;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $duration=mysqli_real_escape_string($connect,$_POST["duration"]);
        $prices = mysqli_real_escape_string($connect,$_POST["price"]);
       
       if($duration<=0){ $error_duration="the value is out of range"; $error++;}
        if(empty($duration)){ $error_duration="the duration is required"; $error++;}
    if(empty($mobile)){$error_mobile="the mobile is required"; $error++;}
        $check_mobile="SELECT * FROM reservations WHERE mobile ='$mobile' ";
        $result=mysqli_query($connect,$check_mobile);

        $username=$_SESSION["USERNAME"];

        if(mysqli_num_rows($result)==0){

            if($error==0){
                 $insert_query="INSERT INTO reservations(username,mobile,duration,price) 
                 VALUES ('$username',$mobile,$duration,$prices)";
                 mysqli_query($connect,$insert_query);
             }
        }
        else{
            $error_mobile="check your number please";
        }
        
    
        
        
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservations</title>
</head>
<body>
    <header>
        <nav id="navbar">
            <div class="container">
                <h1 class="logo"><a href="home.php">Hotel</a></h1>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a class="current" href="contact.php">Reservation</a></li>
                    <li><a href="logout1.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        
    </header>
    <section id="contact-form" class="py-3">
        <div class="container">
            <h1 class="l-heading"><span class="text-primary">Welcome</span> </h1>
            
            <p>Please fill out the form below to contact us</p>

            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                <div class="form-group"> <p style="color:red"><?php echo $error_mobile ; ?></p> 
                    <label for="name">Mobile</label> <p style="color:red">
                    <input type="tel" name="mobile" placeholder="71-978227 " id="mobile">
                </div>
                <div class="form-group"> <p style="color:red"><?php echo $error_duration ; ?></p> 
                    <label for="email">Duration of reserve ( number of days )</label> 
                    <input type="number" name="duration" id="number">
                </div>
                
    </section>

    <fieldset >
  <legend>Select price:</legend> <br>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <input type="radio" id="huey" name="price" value="200" checked />
    <label for="">200 $</label>&nbsp;&nbsp; (3 room)

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <input type="radio" id="dewey" name="price" value="500" />
    <label for="">500 $</label> &nbsp;&nbsp; (3 room and pool)

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <input type="radio" id="louie" name="price" value="1000" />
    <label for="">1000 $ &nbsp;&nbsp; (5 room and pool)</label> <br><br><br>
  
</fieldset>
<br>
<button type="submit" class="btn">Submit</button>


 

            </form>
        </div>

    <section id="contact-info" class="bg-dark">
        <div class="container">
        <div class="box">
        <i class="fas fa-hotel fa-3x"></i>
        <h3>Location</h3>
        <p>Rawcheh street, Beyrouth Lebanon</p>
       </div>
       <div class="box">
        <i class="fas fa-phone fa-3x"></i>
        <h3>Phone Number</h3>
        <p>(961) 71-777777</p>
       </div>
       <div class="box">
        <i class="fas fa-envelope fa-3x"></i>
        <h3>Email Address</h3>
        <p>Hotel@gmail.com</p>
       </div>
        </div>

    </section>

    <footer id="main-footer">
        <p>Hotel &copy; 2024, All Rights Reserved</p>

    </footer>
</body>
</html>