<?php
function verify($uid,$token){
    include 'connect.php';
    $sql=mysqli_query($link,"select * from login_app where user_id='".$uid."' and token='".$token."'");
    if(mysqli_num_rows($sql)>0){
        return true;
    }
    else{
        return false;
    }
    
}
?>