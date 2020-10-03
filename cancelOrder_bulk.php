<?php
include 'connect.php';
include 'authverify.php';
$a=array();
$b=array();
$uid=$_POST['uid'];
$token=$_POST['token'];
$order_id=$_POST['orderId'];


if(verify($uid,$token)){
   
    $c = array();
    $d = array();
    
        
    
        $query=mysqli_query($link,"select * from bulk_orders where order_id=$order_id and store_id=1 and user_id=$uid and status=0") ;
        $d=array();
        if(mysqli_num_rows($query)>0)
        {
            $b["success"]=100;
            $query2=mysqli_query($link,"delete from bulk_orders where order_id=$order_id");
            array_push($a,$b);
            echo json_encode($a);
        }
    else{                                                                                                                                     
        $b["success"]=200;
        $b["message"]="No Data";
        array_push($a,$b);
        echo json_encode($a);
    }
    }
    else{
    $b["success"]=200;
    $b["message"]="Invalid Credentials";
    array_push($a,$b);
    echo json_encode($a);
    }
?>
