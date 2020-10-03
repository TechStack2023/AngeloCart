<?php
include 'connect.php';
include 'authverify.php';
$uid=mysqli_real_escape_string($link,$_POST['uid']);
$token=mysqli_real_escape_string($link,$_POST['token']);
$case_id=$_POST["case_id"];
$a=array();
$b=array();
if(verify($uid,$token)){
    $sql=mysqli_query($link,"select * from users where uid='".$uid."' and token='".$token."'");
$row=mysqli_fetch_assoc($sql);
$a = array();
$b = array();
if(mysqli_num_rows($sql)>0){
    $b["success"]=100;
    $type=$row["user_type"];
   if($type==1){
    $b["uid"]=$row["uid"];
    $uid=$row["uid"];
    $b["user_type"]=$type;
    $b["success"]=100;
    $query=mysqli_query($link,"update cases set approve='1' where case_id='".$case_id."'") ;
    
}else if($type==2){
    $b["uid"]=$row["uid"];
    $uid=$row["uid"];
    $b["user_type"]=$type;
    $query2=mysqli_query($link,"update cases set approve='2' where case_id='".$case_id."'") ;
    $b["success"]=100;
    array_push($a,$b);
    echo json_encode($a); 
}
}
else{
    $b["success"]=200;
    $b["message"]="Invalid Credentials";
    $b["id"]="";
    $b["name"] = "";
    $b["booth_id"] = "";
    $b["booth_name"] = "";
    $b["user_type"] = "";
    $b["token"]="";
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
