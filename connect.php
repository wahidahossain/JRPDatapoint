<?php

$dbname="jrp_customer_solution";
$con = mysqli_connect("localhost","wahida","kdjk75Djds%4dF29");
if (!$con)
{    
    echo "Can't Connect";
}
else{

    echo "connected!";
}
mysqli_select_db($con, "jrp_customer_solution");
$con1=mysqli_connect("localhost","wahida","kdjk75Djds%4dF29","jrp_customer_solution");
?>