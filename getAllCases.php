<?php
include 'connect.php';
include 'authverify.php';
$uid=mysqli_real_escape_string($link,$_POST['uid']);
$token=mysqli_real_escape_string($link,$_POST['token']);
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
    if($type=='0')
    {
    $b["uid"]=$row["uid"];
    $uid=$row["uid"];
    $cid=$row["cid"];
    $b["user_type"]=$type;
    $b["cid"]=$cid;
    $query3=mysqli_query($link,"select * from connection where cid='".$cid."'") ;
    $row3=mysqli_fetch_assoc($query3);
    $pid=$row3["pid"];
    $query=mysqli_query($link,"select * from cases where pid='".$pid."'  order by patient_name ") ;
    $d=array();
    while($row1=mysqli_fetch_assoc($query))
    {
        $c=array();
        $c["case_id"]=$row1["case_id"]; 
        $c["patient_name"]=$row1["patient_name"]; 
        $c["age"]=$row1["age"]; 
        $c["gender"]=$row1["gender"]; 
        $c["address"]=$row1["address"]; 
        $c["phone"]=$row1["phone"]; 
        $c["primarys"]=$row1["primarys"]; 
        $c["primary_name"]=$row1["primary_name"]; 
        $c["hospital_name"]=$row1["hospital_name"]; 
        $c["bid"]=$row1["bid"]; 
        $c["pid"]=$row1["pid"]; 
        $c["cid"]=$row1["cid"]; 
        $c["risk"]=$row1["risk"]; 
        $c["doob_start"]=$row1["doob_start"]; 
        $c["doob_stop"]=$row1["doob_stop"];  
        $c["approve"]=$row1["approve"]; 
        $query2=mysqli_query($link,"select * from centers where cid='".$row1["cid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["cname"];
        $b["cname"]=$cname;    
        $query2=mysqli_query($link,"select * from blocs where bid='".$row1["bid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["bname"];
        $b["bname"]=$cname;
        $query2=mysqli_query($link,"select * from panchayath where pid='".$row1["pid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["pname"];
        $b["pname"]=$cname;
        $query2=mysqli_query($link,"select * from centers where cid='".$row1["cid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $uid2 = $row2["uid"];
        $query3=mysqli_query($link,"select * from users  where uid='".$uid2."'") ;
        $row3=mysqli_fetch_assoc($query3);
        $b["head_officer_name"] = $row3["officer_name"];
        $b["head_phone"] = $row3["phone"];
       
        array_push($d,$c);
    }
    array_push($b,$d);
    array_push($a,$b);
    echo json_encode($a);
}
else if($type=='1'){
    $b["uid"]=$row["uid"];
    $uid=$row["uid"];
    $b["user_type"]=$type;
    $cid=$row["cid"];
    $b["cid"]=$cid;
    $query=mysqli_query($link,"select * from cases where cid='".$cid."' order by patient_name ") ;
    $d=array();
    while($row1=mysqli_fetch_assoc($query))
    {
        $c=array();
        $c["case_id"]=$row1["case_id"]; 
        $c["patient_name"]=$row1["patient_name"]; 
        $c["age"]=$row1["age"]; 
        $c["gender"]=$row1["gender"]; 
        $c["address"]=$row1["address"]; 
        $c["phone"]=$row1["phone"]; 
        $c["primarys"]=$row1["primarys"]; 
        $c["primary_name"]=$row1["primary_name"]; 
        $c["hospital_name"]=$row1["hospital_name"]; 
        $c["bid"]=$row1["bid"]; 
        $c["pid"]=$row1["pid"]; 
        $c["cid"]=$row1["cid"]; 
        $c["risk"]=$row1["risk"]; 
        $c["doob_start"]=$row1["doob_start"]; 
        $c["doob_stop"]=$row1["doob_stop"]; 
        $c["approve"]=$row1["approve"]; 
        $uid33=$row1["update_uid"]; 
        $query3=mysqli_query($link,"select * from users  where uid='".$uid33."'") ;
        $row3=mysqli_fetch_assoc($query3);
        $c["updated_by"] = $row3["phone"];
        $query2=mysqli_query($link,"select * from centers where cid='".$row1["cid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["cname"];
        $b["cname"]=$cname;    
        $query2=mysqli_query($link,"select * from blocs where bid='".$row1["bid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["bname"];
        $b["bname"]=$cname;
        $query2=mysqli_query($link,"select * from panchayath where pid='".$row1["pid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["pname"];
        $b["pname"]=$cname;
        $query2=mysqli_query($link,"select * from blocs where bid='".$row1["bid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $uid2 = $row2["uid"];
        $query3=mysqli_query($link,"select * from users  where uid='".$uid2."'") ;
        $row3=mysqli_fetch_assoc($query3);
        $b["head_officer_name"] = $row3["officer_name"];
        $b["head_phone"] = $row3["phone"];
        array_push($d,$c);
    }
    array_push($b,$d);

    $query=mysqli_query($link,"select count(*) as cc from cases where cid='".$cid."' ") ;
    $row2=mysqli_fetch_assoc($query);
    $b["total_cases"]=$row2["cc"];
    $query=mysqli_query($link,"select count(*) as cc from cases where cid='".$cid."'  and approve='0'") ;
    $row2=mysqli_fetch_assoc($query);
    $b["to_approve"]=$row2["cc"];
    $query=mysqli_query($link,"select count(*) as cc from cases where cid='".$cid."'  and (approve='1' or approve='2')") ;
    $row2=mysqli_fetch_assoc($query);
    $b["approved"]=$row2["cc"];
    
    array_push($a,$b);
    echo json_encode($a);  
}else if($type=='2'){
    $b["uid"]=$row["uid"];
    $uid=$row["uid"];
    $b["user_type"]=$type;
    $cid=$row["cid"];
    $b["cid"]=$cid;
    $query2=mysqli_query($link,"select * from blocs where uid='".$uid."'") ;
    $row2=mysqli_fetch_assoc($query2);
    $bid = $row2["bid"];
    //echo "select * from cases where bid='".$bid."' order by patient_name ";
    $query=mysqli_query($link,"select * from cases where bid='".$bid."' order by patient_name ") ;//to approve for Bloc Head
    $d=array();
    while($row1=mysqli_fetch_assoc($query))
    {
        $c=array();
        $c["case_id"]=$row1["case_id"]; 
        $c["patient_name"]=$row1["patient_name"]; 
        $c["age"]=$row1["age"]; 
        $c["gender"]=$row1["gender"]; 
        $c["address"]=$row1["address"]; 
        $c["phone"]=$row1["phone"]; 
        $c["primarys"]=$row1["primarys"]; 
        $c["primary_name"]=$row1["primary_name"]; 
        $c["hospital_name"]=$row1["hospital_name"]; 
        $c["bid"]=$row1["bid"]; 
        $c["pid"]=$row1["pid"]; 
        $c["cid"]=$row1["cid"]; 
        $c["approve"]=$row1["approve"]; 
        $uid33=$row1["update_uid"]; 
        $query3=mysqli_query($link,"select * from users  where uid='".$uid33."'") ;
        $row3=mysqli_fetch_assoc($query3);
        $c["updated_by"] = $row3["phone"];

        $query2=mysqli_query($link,"select * from centers where cid='".$row1["cid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["cname"];
        $c["cname"]=$cname;    
        $query2=mysqli_query($link,"select * from blocs where bid='".$row1["bid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["bname"];
        $c["bname"]=$cname;
        $query2=mysqli_query($link,"select * from panchayath where pid='".$row1["pid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $cname = $row2["pname"];
        $c["pname"]=$cname;
        $c["risk"]=$row1["risk"]; 
        $c["doob_start"]=$row1["doob_start"]; 
        $c["doob_stop"]=$row1["doob_stop"];
        $query2=mysqli_query($link,"select * from centers where cid='".$row1["cid"]."'") ;
        $row2=mysqli_fetch_assoc($query2);
        $uid2 = $row2["uid"];
        $query3=mysqli_query($link,"select * from users where uid='".$uid2."'") ;
        $row3=mysqli_fetch_assoc($query3);
        $c["head_officer_name"] = $row3["officer_name"];
        $c["head_phone"] = $row3["phone"];
        array_push($d,$c);
    }
    array_push($b,$d);
    
    $query=mysqli_query($link,"select count(*) as cc from cases where bid='".$cid."' ") ;
    $row2=mysqli_fetch_assoc($query);
    $b["total_cases"]=$row2["cc"];
    $query=mysqli_query($link,"select count(*) as cc from cases where bid='".$cid."'  and approve='1'") ;
    $row2=mysqli_fetch_assoc($query);
    $b["to_approve"]=$row2["cc"];
    $query=mysqli_query($link,"select count(*) as cc from cases where bid='".$cid."'  and approve='2'") ;
    $row2=mysqli_fetch_assoc($query);
    $b["approved"]=$row2["cc"];

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
