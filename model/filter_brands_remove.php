<?php
session_start();
include('session.php'); 
//$login=$_SESSION['login'];
        $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];

 if($login=="superadmin"){
 $account_type=$_SESSION['account_type'];
        $first_name=$_SESSION['first_name'];
        $user_id=$_SESSION['user_id'];
    ?>
<?php
include ("../model/connect.php");
//error_reporting(E_ERROR);

//===========================USER TABLE===========================

if (isset($_REQUEST['filter_brands_id'])) {
    $filter_brands_id = $_REQUEST['filter_brands_id'];
    foreach($_REQUEST['filter_brands_id'] as $filter_brands_id){     
    

        $sql_filter_brands = "DELETE FROM filter_brands WHERE `filter_brands`.`filter_brands_id` ='$filter_brands_id'";
        $result_filter_brands = mysqli_query($con, $sql_filter_brands) or die( 'Couldnot execute query'. mysql_error());
    
    }
    if($result_filter_brands){
        //print("<script>window.alert('Product category filter removed successfully');</script>");
        print("<script>window.location='../superadmin/filter_brands.php'</script>");
    }
  }
  else {
print("<script>window.alert('Please select any brand name to delete.');</script>");
print("<script>window.location='../superadmin/filter_brands.php'</script>");

  } 
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?> 