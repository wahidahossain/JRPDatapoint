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
error_reporting(0);
$jrp_account_no = $_REQUEST['user_excol2'];
if($_POST['add'])
{
                //===================== checking if product category available ===================
                $warehouse_code=$_REQUEST['warehouse_code'];
                $brands=$_REQUEST['brand'];
                
                if($warehouse_code =='' || $brands ==''){
                    print("<script>window.alert('Must select Warehouse and Brand From The List.');</script>");
                    print("<script>window.location='../superadmin/new_bunch_assignment_clients.php'</script>");
                }
                else
                {
                    // ==================== checking if product category available ============
                    
                                                           
                    //===========================USER TABLE===========================
                    $jrp_account_no = $_REQUEST['user_excol2'];
                    $result2 = mysqli_query($con, "SELECT * FROM `user` where user_excol2='$jrp_account_no'");                
                    $row1 = mysqli_fetch_array($result2);
                    $user_id1 = $row1['user_id'];
                    
                    
                    $brands1=implode(',',$brands);                                  
                        foreach($_REQUEST['brand'] as $brands){
                        
                        $result_prod = mysqli_query($con, "SELECT `prod` FROM `stock` where `brand`='$brands' AND `prod` NOT IN (SELECT `category_code` FROM `filter_product_code`) group by `prod`");
                        while ($row_product_code = mysqli_fetch_array($result_prod)){                                  
                        $prod = $row_product_code['prod'];


                        $warehouse_code1=implode(',',$warehouse_code);
                        foreach($_REQUEST['warehouse_code'] as $warehouse_code){                        
                                                
                        mysqli_query($con, "INSERT INTO  assign_warehouse  (`brand`,`jrp_account_no`, `warehouse_code`, `user_id`, `date`)
                            SELECT '$brands','$jrp_account_no','$warehouse_code','$user_id1', NOW() WHERE NOT EXISTS
                            (SELECT `jrp_account_no`, `warehouse_code` FROM  assign_warehouse  WHERE `jrp_account_no` = '$jrp_account_no' 
                             AND `warehouse_code` = '$warehouse_code' AND `brand` = '$brands');");                                
                    }

                    //checking if exist-------------------

                    $result_match = mysqli_query($con, "SELECT COUNT(`assign_brands_id`) as 'match' FROM `assign_brands` WHERE `jrp_account_no`='$jrp_account_no' AND `brandname`='$brands' AND `category_code`='$prod'");
                    while ($row_match = mysqli_fetch_array($result_match)){                                  
                    $match = $row_match['match'];

                    if($match== 0){
                        $assign_brands_query = mysqli_query($con, "INSERT INTO `assign_brands` (`assign_brands_id`, `user_id`, `jrp_account_no`, `brandname`, `category_code`, `product_desc`, `assigned_by`, `date`, `col_1`, `col_2`, `col_3`, `col_4`) 
                        VALUES (NULL, '$user_id1', '$jrp_account_no', '$brands', '$prod', '', '$user_id', NOW(), '0', '', '', '');") or die( mysqli_error($con));
                    }

                    else
                    {
                        print("<script>window.alert('Selected Brand already exists in this template.');</script>");
                        print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no=".$jrp_account_no."'</script>");

                    }
                }
                }
                    if($assign_brands_query){
                        //print("<script>window.alert('Brands assigned to client accounts successfully');</script>");
                        //print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no=".$jrp_account_no."'</script>");
                        header("Location: ../superadmin/new_bunch_assignment_clients.php?jrp_account_no=$jrp_account_no");

                    }
            } //end of checking if product category available
}
} //add condition
else
{
    print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?user_excol2=".$jrp_account_no."'</script>");
}
?>
<?php
}
else{
    print("<script>window.alert('Sorry Your are not Logged in');</script>");
    print("<script>window.location='../index.php'</script>");
}
?>