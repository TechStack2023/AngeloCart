<?php
include 'connect.php';
include 'authverify.php';
$a=array();
$b=array();
$uid=$_POST['uid'];
$token=$_POST['token'];
$store_id=$_POST['store_id'];
$items=$_POST['items'];
$type=$_POST['type'];

if(verify($uid,$token)){
    $user = json_decode($items,true);
 //   echo $user;
    foreach($user as $mydata)
    {
        print($mydata["item_id"]);
    }  
   
//$query2=mysqli_query($link,"update login_app set name='".$name."',address='".$address."',email='".$email."',landmark='".$landmark."'  where user_id='".$uid."'");
//$row2=mysqli_fetch_assoc($query2);
        $b["success"]=100;
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
