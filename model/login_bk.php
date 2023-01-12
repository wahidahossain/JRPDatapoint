<?php
session_start();

include('connect.php');
$name=$_REQUEST['username'];
$pass=MD5($_REQUEST['password']);


if($name!="" or $pass!=""){

$query="select count(*) as cnt FROM `user` WHERE `username`='$name' and `password`='$pass'";
$result=mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$count=$row['cnt'];
if($count<'0'){
//==================== login try limit 4 times =================
if(isset($_COOKIE['login'])){
    if($_COOKIE['login'] < 4){
        $attempts = $_COOKIE['login'] + 1;
        setcookie('login', $attempts, time()+60*2); //set the cookie for 10 minutes with the number of attempts stored
            } else{
                echo 'You are banned for 10 minutes. Try again later';
            }
        } else{
            setcookie('login', 1, time()+60*2); //set the cookie for 10 minutes with the initial value of 1
            print("<script>window.alert('Wrong UserId/Password.Please try again...');</script>");
            print("<script>window.location='../index.php'</script>");
        }
        
//===========================  End =============================
}

    if($count>'0' && $attempts>4){
       
       $query="select * FROM `user` WHERE `username`='$name' and `password`='$pass'";
        $result=mysqli_query($con, $query);
        $row=mysqli_fetch_array($result) ;      
        $user_id=$row['user_id'];
        $username=$row['username'];
        $password=$row['password'];
        $account_status=$row['account_status'];
        $account_type=$row['account_type'];
        $last_login = $row['last_login'];
        $first_name = $row['first_name'];
        $user_excol1 = $row['user_excol1'];
        $user_excol2 = $row['user_excol2'];
        $logcount = $row['logcount'];

        $logcount1 = $logcount+1;
        $timezone_offset = +6; // BD central time (gmt+6) for me
        $create_date = gmdate('d-m-Y', time()+$timezone_offset*60*60);
        $ip1=$_SERVER['REMOTE_ADDR'];
       
        
        
            //------------------------- Block/Unblock ------------------------------------
            if($user_excol1 == "block"){

                print("<script>window.alert('Sorry your account is currently on hold, please contact with the administrator.');</script>");
                print("<script>window.location='../index.php'</script>");
            }
            else{
            //-------------------------- superadmin ---------------------------------------
        if($account_type == "superadmin" || $account_type == "staff" && $account_status == "1"){

        $login="superadmin";
        $_SESSION['login']=$login;
        $_SESSION['account_type']=$account_type;
        $_SESSION['first_name']=$first_name;
        $_SESSION['user_id']=$user_id;

        $sql1="UPDATE `user` SET `logcount` = '$logcount1', `last_login` = NOW(), `ip` = '$ip1' WHERE `user`.`user_id` = '$user_id';";
        $result2=mysqli_query($con, $sql1);


            print("<script>window.location='../superadmin/dashboard.php'</script>");
        }
        if($account_type=="superadmin" && $account_status=="0")
        {
            print("<script>window.alert('Sorry Your Account is Disabled!');</script>");
            print("<script>window.location='../index.php'</script>");
        }

        //-------------------------- customer ---------------------------------------
        if($account_type == "customer" && $account_status == "1"){

            $login1="customer";
            $ip=$_SERVER['REMOTE_ADDR'];
            $_SESSION['user_id']=$user_id;
            $_SESSION['login']=$login1;
            $_SESSION['first_name']=$first_name;
            $_SESSION['account_type']=$account_type;
            $_SESSION['user_excol2']=$user_excol2;

            $sql1="UPDATE `user` SET `logcount` = '$logcount1', `last_login` = NOW(), `ip` = '$ip1' WHERE `user`.`user_id` = '$user_id';";
            $result2=mysqli_query($con, $sql1);
            print("<script>window.location='../customer/dashboard.php'</script>");
        }
        if($account_type=="customer" && $account_status=="0")
        {
            print("<script>window.alert('Sorry Your Account is Disabled!');</script>");
            print("<script>window.location='../index.php'</script>");
        }




    }//until count > 0 ------------------------        
        ///////////////////////////////////////////////////////////////////
    
 

}
   else{
    
    print("<script>window.alert('Sorry your maximum number of login attemp is used, try again after 4 Hours!');</script>");
    print("<script>window.location='../index.php'</script>");

        
    }
  //
}

else{

//=============================================================
print("<script>window.alert('Please Insert User Name and Password');</script>");
print("<script>window.location='../index.php'</script>");
}
?>