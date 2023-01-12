<?php
if (!isset($_SESSION['login'])) {
    $login = '0';
  }
  else{
    $login=$_SESSION['login'];
  
  }
?>