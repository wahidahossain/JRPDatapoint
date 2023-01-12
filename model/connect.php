<?php

$dbname="jrp_customer_solution";
//$con = mysqli_connect("localhost","wahida","kdjk75Djds%4dF29");
$con = mysqli_connect("localhost","root",""); //---------------- Change IT ------------------------
if (!$con)
{    
    echo "Can't Connect";
}
mysqli_select_db($con, "jrp_customer_solution");
//$con1=mysqli_connect("localhost","root","","jrp_customer_solution");
//====================== IMPORT ==========================

$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "jrp_customer_solution"; 

// $dbHost     = "localhost";
// $dbUsername = "wahida";
// $dbPassword = "kdjk75Djds%4dF29";
// $dbName     = "jrp_customer_solution"; 
// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
 
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}



?> 