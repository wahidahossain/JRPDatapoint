<?php
include('connect.php');

function user_basic_info()
{
    $query = mysql_query("SELECT * FROM `user`;"); //query the db
    $result = $con->query($query);
    $resArr = array(); //create the result array

    while($row = mysql_fetch_assoc($query)) { //loop the rows returned from db
        $resArr[] = $row; //add row to array
    }

    return $resArr;   
}

$sideBarPosts = user_basic_info(); //get the result array




foreach($sideBarPosts as $post) { //loop the array
    echo '<h1>'. $post['first_name']. '</h1>';
    echo '<p>'. $post['email']. '</p>';
}






//passing values ----------------------------
if ( !function_exists("user_table") ) {
    function user_table($jrp_acc_no, $finished_size) {
        return "SELECT * FROM `user` WHERE `user_excol2` = $jrp_acc_no";
    }
}




$query = user_table($jrp_acc_no);
mysql_query ($query, $con);
$user_table_result = user_table();
foreach($user_table_result as $values) { //loop the array
    echo '<h1>'. $values['first_name']. '</h1>';
    echo '<p>'. $values['email']. '</p>';
}

function createPath($path) {
    if (is_dir($path)) 
        return true;
    $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
    $return = createPath($prev_path);
    return ($return && is_writable($prev_path)) ? mkdir($path) : false;
}


?>