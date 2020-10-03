<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admin Panel -Jis</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendors/toastr/toastr.min.css" rel="stylesheet" />
    <link href="assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href='vendor/datatables/dataTables.bootstrap4.min.css' rel='stylesheet'>
	 <link href='vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>
  <script src='https://www.gstatic.com/firebasejs/5.9.2/firebase.js'></script>
  <link href='css/sb-admin-2.min.css' rel='stylesheet'>
 <script src='vendor/jquery/jquery.min.js'></script>
  <script src='vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
  <script src='vendor/jquery-easing/jquery.easing.min.js'></script>
  <script src='js/sb-admin-2.min.js'></script>

    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <script>
function showHint(str) {
    if (str=="0") { 
        document.getElementById("txtHint").innerHTML = "<font color='red'>Please Select a Block</font>";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
function showHintS(str) {
    if (str=="0") { 
        document.getElementById("txtHintS").innerHTML = "<font color='red'>Please Select an Panchayath</font>";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHintS").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethintDefaulters.php?q=" + str, true);
        xmlhttp.send();
    }
}function showHintSS(str) {
    if (str=="0") { 
        document.getElementById("txtHintSS").innerHTML = "<font color='red'>Please Select an Center</font>";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHintSS").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethintSSC.php?q=" + str, true);
        xmlhttp.send();
    }
}function showHintB(str) {
    if (str=="0") { 
        document.getElementById("txtHintB").innerHTML = "<font color='red'>Please Select a User</font>";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHintB").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethintBH.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            
        }

        .cover {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(117, 54, 230, .1);
        }

        .auth-head-icon {
            position: relative;
            height: 60px;
            width: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background: rgba(0, 0, 0, .6);
            color: #fff;
            box-shadow: 0 5px 20px #d6dee4;
            border-radius: 50%;
            z-index: 2;
        }

        .login-box {
            background: rgba(0, 0, 0, .6);
            color: rgba(255, 255, 255, .8);
        }

        .login-box .form-control {
            background-color: transparent;
            border-color: rgba(255, 255, 255, .6);
            color: #fff;
        }

        .login-box .form-control:focus {
            border-color: rgba(255, 255, 255, 1);
        }
    </style>
</head>

<body>
    <div class="cover"></div>
    <div style="max-width: 900px;margin: 100px auto 50px;">
    <h4 class="font-strong text-center mb-5">SELECT FROM THE FOLLOWING</h4>
                <div class="form-group mb-4">
                <select class="form-control form-control-lg" onChange="showHint(this.value)" name="area" >
                    <option value="0">Select Block</option>
                    <?php
                    $query=mysqli_query($link,"select * from blocs");
                    while($row1=mysqli_fetch_assoc($query))
                        {
                        
                            $aid=$row1["bid"]; 
                            $aname=$row1["bname"];
                            echo "<option value='".$aid."'>".$aname."</option>";
                        }
                        ?>
                </select>
                <div class="form-group mb-4">
                <p><span id="txtHint"></span></p>
                </div><div class="form-group mb-4">
                <p><span id="txtHintS"></span></p>
                </div><div class="form-group mb-4">
                <p><span id="txtHintSS"></span></p>
                </div><div class="form-group mb-4">
                <p><span id="txtHintB"></span></p>
                </div>
                <br><br>
        <div class="ibox login-box">
        <div class='card shadow mb-4' id='table'>
			 <!-- Page Heading -->
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>ALL CASES</h6>
            </div>
     
                
            
            </form>
        </div>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- CORE PLUGINS-->
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/vendors/metisMenu/dist/metisMenu.min.js"></script>
    <script src="assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendors/jquery-idletimer/dist/idle-timer.min.js"></script>
    <script src="assets/vendors/toastr/toastr.min.js"></script>
    <script src="assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script>
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>


</html>