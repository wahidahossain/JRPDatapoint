<?php
include("connect.php");
$result_match = mysqli_query($con, "SELECT `code_specialprice`,`oemsku` FROM `special_pricing`");
while ($row_match = mysqli_fetch_array($result_match)){                                  
$code_specialprice = $row_match['code_specialprice'];
$oemsku = $row_match['oemsku'];

// if($match== 0){
    $assign_brands_query = mysqli_query($con, "UPDATE `stock` SET`oemsku`='$oemsku' WHERE `jrpsku`='$code_specialprice'") or die( mysqli_error($con));
    $result2=mysqli_query($con, $assign_brands_query);
// }

// else
// {
//     print("<script>window.alert('Selected Brand already exists in this template.');</script>");
//     print("<script>window.location='../superadmin/new_bunch_assignment_clients.php?jrp_account_no=".$jrp_account_no."'</script>");

// }
}
?>