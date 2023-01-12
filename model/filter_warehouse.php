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
include("bv_connect.php");
error_reporting(E_ERROR);

//===========================USER TABLE===========================
//$warehouse = $_REQUEST['warehouse'];


if($_REQUEST['load']){
                                    
    $sql = "select WHSE_KEY, WHSE_DESCRIPTION from WAREHOUSE";
    $result = odbc_exec($connection, $sql);
    while ($row = odbc_fetch_row($result)){
    $WHSE = trim(odbc_result($result, "WHSE_KEY"));
    $WHSE_DESCRIPTION = trim(odbc_result($result, "WHSE_DESCRIPTION"));
//================== MYSQL =========================================
$checking ="SELECT COUNT(*) as 'cnt' FROM `warehouse` WHERE `warehouse`='$WHSE'; ";               
$result_checking=mysqli_query($con, $checking) or die( 'Couldnot execute query'. mysql_error());
$row_checking = mysqli_fetch_array($result_checking);
$cnt = $row_checking['cnt'];
if($cnt<'1'){
    $add_warehouse="INSERT INTO `warehouse` (`warehouse_id`, `warehouse`, `description`, `flag`, `date`) VALUES (NULL, '$WHSE', '$WHSE_DESCRIPTION', '0', NOW());";
    $result_add_warehouse=mysqli_query($con, $add_warehouse) or die( 'Couldnot execute query'. mysql_error());

    print("<script>window.alert('Loaded successfully');</script>");
    print("<script>window.location='../superadmin/filter_warehouse.php'</script>");
}
else{
    print("<script>window.alert('Loaded successfully!');</script>");
    print("<script>window.location='../superadmin/filter_warehouse.php'</script>");
}

// $add_warehouse="INSERT INTO `warehouse` (`warehouse_id`, `warehouse`, `description`, `flag`, `date`) VALUES (NULL, '$WHSE', '$WHSE_DESCRIPTION', '1', NOW())
//                                             ON DUPLICATE KEY UPDATE
//                                             warehouse = $WHSE,
//                                             description = $WHSE_DESCRIPTION;";
// $result_add_warehouse=mysqli_query($con, $add_warehouse) or die( 'Couldnot execute query'. mysql_error());
}
}
if($_REQUEST['update']){
   
    if(isset($_REQUEST['warehouse'])){     
    foreach($_REQUEST['warehouse'] as $warehouse_not){
        $sql2 ="UPDATE `warehouse` SET `flag` = '0' WHERE `warehouse`.`warehouse` != '$warehouse_not'"; 
            $result3=mysqli_query($con, $sql2) or die( 'Couldnot execute query'. mysql_error());
        }
   
foreach($_REQUEST['warehouse'] as $warehouse){
    $sql1 ="UPDATE `warehouse` SET `flag` = '1' WHERE `warehouse`.`warehouse` = '$warehouse'"; 
    $result2=mysqli_query($con, $sql1) or die( 'Couldnot execute query'. mysql_error());


    
    if($result2){
        print("<script>window.alert('Warehouse filtered successfully');</script>");
        print("<script>window.location='../superadmin/filter_warehouse.php'</script>");
    }
}
    }else{
        print("<script>window.alert('Please select a warehouse from the list');</script>");
        print("<script>window.location='../superadmin/filter_warehouse.php'</script>");

    }

}


?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>