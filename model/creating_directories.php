<?php
  include('connect.php');
  $result_template_name = mysqli_query($con, "SELECT `jrp_account_no` FROM `assign_template`");

while ($row_template_name = mysqli_fetch_array($result_template_name))
{              
              $jrp_account_no = $row_template_name['jrp_account_no'];
              $path = 'C:/FTP/Wholesale/'.$jrp_account_no;
              if (!is_dir($path)) {
                mkdir($path, 0777, true);
              }
}
  
  
?>