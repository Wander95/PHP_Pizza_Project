<?php 
  $host="localhost";
  $port=3306;
  $socket="";
  $user="root";
  $password="12345";
  $dbname="ninja_pizzas";

  
  $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());


  
  if(!$con){
    echo 'connection error' . mysqli_connect_error();
  }
?>