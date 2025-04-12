<?php
    $connect = mysqli_connect("localhost","root","","Hotel");
    if(!$connect){
        die("connection failed". mysqli_connect_error());
    }
?>