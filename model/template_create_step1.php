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
        error_reporting(E_ERROR);
        $index_name = $_REQUEST['index_name'];

        $result2 = mysqli_query($con, "SELECT COUNT(*) as 'cnt' FROM `report_indexes` WHERE `index_name`='$index_name'");                
        $row1 = mysqli_fetch_array($result2);
        $cnt = $row1['cnt'];


        if($_POST['add'])
        //================================= Adding New Template =======================================
        {                                                     
                    
                    if($cnt>'0'){
                        print("<script>window.alert('Template Name already exists, please pick another name for template creation!!');</script>");
                        print("<script>window.location='../superadmin/template_create_step1.php'</script>");  
                    }
                    else{
                        mysqli_query($con, "INSERT INTO `report_indexes` (`report_indexes_id`, `index_name`, `flag`, `col1`) VALUES (NULL, '$index_name', '1', '');");
                        $lastid = mysqli_insert_id($con); 
                    }                                                                       
                    print("<script>window.location='../superadmin/template_create_step2.php?index_name=".$index_name."&report_indexes_id=".$lastid."'</script>");
        }                                   
        //================================= Editing Existing Template =======================================
        else
                    {                        
                        if($cnt=='0'){
                            print("<script>window.alert('No Template found by that name for editing, create a new one!!!');</script>");
                            print("<script>window.location='../superadmin/template_create_step1.php'</script>");  
                        }
                        else{
                            $result2 = mysqli_query($con, "SELECT `report_indexes_id` FROM `report_indexes` WHERE `index_name`='$index_name'");                
                            $row1 = mysqli_fetch_array($result2);
                            $report_indexes_id = $row1['report_indexes_id'];    
                        print("<script>window.location='../superadmin/template_create_step_edit.php?index_name=".$index_name."&report_indexes_id=".$report_indexes_id."'</script>");
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