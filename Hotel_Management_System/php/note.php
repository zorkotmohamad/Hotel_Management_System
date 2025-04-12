<?php
    include("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $query="SELECT username,email,password FROM customers";
        $result=mysqli_query($connect,$query);
        $username=$email=$password="";
        if(isset($_POST["username"])){
            $username=$_POST["username"];
        }
        if(isset($_POST["email"])){
            $email=$_POST["email"];
        }
        if(isset($_POST["password"])){
            $password=$_POST["password"];
        }
        $query="";
        if(isset($_POST["insert"])){
            $query="SELECT username,email,password FROM customers";
            //if(){}
            $query="INSERT INTO customers(username,email,password) VALUES ('$username','$email','$password')";
            mysqli_query( $connect,$query);
            header("location:note.php");
        }
   /* if(isset($_POST["update"])){
        $query="UPDATE reservations SET username='$username',mobile='$mobile',prices='$price' WHERE mobile='$mobile'";
        mysqli_query( $connect,$query);
        header("location:admin1.php");
    }
    if(isset($_POST["delete"])){
        $query="DELETE FROM reservations WHERE mobile='$mobile'";
        mysqli_query( $connect,$query);
        header("location:admin1.php");
    }*/
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <div class="form-container">
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label>Username</label>
                <input type="text" name="username">
                
                <label>email</label>
                <input type="text" name="email">
                
                <label>password</label>
                <input type="text" name="password">
                
                <div class="buttons">
                    <button type="submit" name="insert">Insert</button>
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
                </tr>
            </thead>
            <tbody>
                <?php
                    $query="SELECT * FROM customers";
                    $result=mysqli_query($connect,$query);
                    while($row=mysqli_fetch_assoc($result)){
                        $username= $row["username"];
                        $email=$row["email"]; 
                        $password=$row["password"];                   
                        echo"<tr>
                        <td>$username</td>
                        <td>$email</td>
                        <td>$password</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
