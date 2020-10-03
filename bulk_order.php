<?php
include 'connect.php';
include 'authverify.php';
$a=array();
$b=array();
$uid=$_POST['uid'];
$token=$_POST['token'];
$order_details=clean($_POST['order_details']);
$name=$_POST['name'];
$phone=$_POST['phone'];
$address=clean($_POST['address']);
$landmark=clean($_POST['landmark']);
$lat=$_POST['lat'];
$lng=$_POST['lng'];
if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}
$update_date= date("y-m-d H:i:00");
$address="Name: ".$name.",Address: ".$address;


if(verify($uid,$token)){
 mysqli_query($link,"insert into bulk_orders (user_id,store_id,datetimes,address,phone,landmark,lat,lng,order_details,status) values ($uid,1,'$update_date','$address','$phone','$landmark','$lat','$lng','$order_details',0)");
 $order_id=mysqli_insert_id($link);
  if($order_id==null)
  return $a["error"]=true;  
   
//$query2=mysqli_query($link,"update login_app set name='".$name."',address='".$address."',email='".$email."',landmark='".$landmark."'  where user_id='".$uid."'");
//$row2=mysqli_fetch_assoc($query2);
$b["success"]=100;$b["order_id"]=$order_id;
$b["message"]="Success";
array_push($a,$b);
echo json_encode($a);
}
else{
$b["success"]=200;
$b["message"]="Invalid Credentials";
array_push($a,$b);
echo json_encode($a);
}
function clean($string) {
   // $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
 
    return preg_replace('/[^A-Za-z0-9\- ]/', '', $string); // Removes special chars.
 }

?>
