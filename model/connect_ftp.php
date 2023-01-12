<?php
$ftp_server = "192.168.0.31";
$ftp_username = "jrpdatapoint";
$ftp_userpass = "Wki8&Kmz5F";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

$dir = 'Wholesale/'.$jrp_account_no_rename;
if( is_dir($dir) == false){
if (ftp_mkdir($ftp_conn, $dir))
  {
  echo "Successfully created $dir";
  }
else
  {
  echo "Error while creating $dir";
  }
//ftp_close($ftp_conn);

}
else{
  echo "$dir exists";
}
?>