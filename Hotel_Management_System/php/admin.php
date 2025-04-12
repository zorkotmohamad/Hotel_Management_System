<?php
    include("connection.php");
    session_start();
    if(!isset($_SESSION["username"])){
        header("location:adminlogin.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username=$mobile=$price=$duration="";
        if(isset($_POST["username"])){
            $username=mysqli_real_escape_string($connect,$_POST["username"]);
            setcookie("username", $username, time() + (86400 * 30), "/");
        }
        if(isset($_POST["mobile"])){
            $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
            setcookie("mobile", $mobile, time() + (86400 * 30), "/");
        }
        if(isset($_POST["price"])){
            $price=mysqli_real_escape_string($connect,$_POST["price"]);
            setcookie("price", $price, time() + (86400 * 30), "/");
        }
        if(isset($_POST["duration"])){
            $duration=mysqli_real_escape_string($connect,$_POST["duration"]);
            setcookie("duration", $duration, time() + (86400 * 30), "/");
        }

        $query="";
        if(isset($_POST["update"])){
            $query="UPDATE reservations SET username='$username',mobile='$mobile',price='$price',duration='$duration' WHERE username='$username'";
            mysqli_query( $connect,$query);
            header("location:admin.php");
        }
        if(isset($_POST["delete"])){
            $query="DELETE FROM reservations WHERE username='$username'";
            mysqli_query( $connect,$query);
            header("location:admin.php");
        }
       
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Management</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="container">
        <h1>Customers Management</h1>
        
        <button><a href="logout.php">Logout</a></button><br><br>
        <div class="form-container">
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <label>Username</label>
            <input type="text" name="username" autocomplete="off">
            <label>Mobile</label>
            <input type="text" name="mobile" autocomplete="off">
            <label>Price</label>
            <input type="text" name="price" autocomplete="off">
            <label>Duration</label>
            <input type="text" name="duration" autocomplete="off">
                
                <div class="buttons">
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete">Delete</button>
                </div>
            </form>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>No room</th>
                    <th>Username</th>
                    <th>Mobile</th>
                    <th>Price</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query="SELECT no_room,username,mobile,price,duration FROM reservations";
                    $result=mysqli_query($connect,$query);
                    while($row=mysqli_fetch_assoc($result)){
                        $number= $row["no_room"];
                        $username= $row["username"];
                        $mobile= $row["mobile"];
                        $price= $row["price"]; 
                        $duration=$row["duration"];                   
                        echo"<tr>
                        <td>$number</td>
                        <td>$username</td>
                        <td>$mobile</td>
                        <td>$price</td>
                        <td>$duration</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
