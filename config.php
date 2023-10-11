
<?php
     
$hostname = "localhost";
$username="root";
$password="";
$db= "login";

$database= mysqli_connect($hostname, $username,$password,$db) or die("Error in Connecting the data base");

$base_url = "http://localhost:4444/";
$my_email = "YOUR_EMAIL";
?>