
<?php
require ('connector.php');
require ('utility.php');
require ('validateSession.php');
?>

<?php
$e_user = "";
$e_role = "";
if (isset($_REQUEST["id"]) && $_REQUEST["id"] > 0) {
    //echo "<script> alert($_REQUEST[id])</script>";
    $e_id = $_REQUEST["id"];
    $q = "SELECT * from user_role where id='" . $e_id . "'";
    $result = mysqli_query($conn, $q);
    if (mysqli_num_rows($result) > 0) {
        //echo "<script>alert('hello');</script>";
        while ($data = mysqli_fetch_assoc($result)) {
            $e_user = $data["userid"];
            $e_role = $data["roleid"];
        }
    }
}
if (isset($_POST["save"]) && (isset($_REQUEST["id"])) == true) {
    $u_user = $_POST["user"];
    $u_role = $_POST["role"];
    
    
    //echo $u_login;
    $q2 = "UPDATE `user_role` SET `userid` = '" . $u_user. "', `roleid` = '" . $u_role. "' WHERE `user_role`.`id` = '" . $e_id . "';";
    if (mysqli_query($conn, $q2)) {
        echo "<script> alert('updated'); </script>";
        header("Location:UserRoleList.php");
    }
}
?>

<?php
$error="";
$errorRole="";
$errorUser = "";
if (isset($_POST["save"]) && (isset($_REQUEST["id"])) == false) {
    $user = $_POST["user"];
    $role = $_POST["role"];
 //   echo "<script>alert($role);</script>";
 //  echo "<script>alert($permission);</script>";
    $flag=true;
    $sql3 = "SELECT roleid,userid from user_role";
    $result3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_assoc($result3)) {
        if (($user) == ($row3["userid"]) && ($role) == ($row3["roleid"])) {
            $flag=false;
        }
    }
    if ($user == 0) {
        $errorUser = "Select User";
    }
    if ($role == 0) {
        $errorRole = "Select Role";
    }

    if ($flag == false ) {
        $error = "User-Role already exists";
    }
    if ($user != 0 && $role !=0 && $flag==true) {
        $sql = "INSERT INTO `user_role` (`id`, `userid`, `roleid`) VALUES (NULL, '".$user."', '".$role."')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>  alert('added successfully'); </script>";
            header("Location:UserRoleList.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>user-role</title>

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="animate.css">
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="style1.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
        <style>

            .optStyle{
                width:190px ;
                margin-bottom: 20px;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 2px;
                font-size: .9em;
                color: #888;
            }

           

            body{
                margin: 0px;
                background-image: url("photo_bg.jpg");
                height: auto;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            
        </style>



    </head>

    <body >

         <?php include 'Header.php';?>

        <div class="container" id="div1" >
            <form method="post" action="">
                <table cellspacing="4" cellpadding="60px" >
                    <tr>
                        <td style="width:400px">
                            <div id="div2" class="login-box">
                                <div class="box-header">
                                    <h2>User-Role Management</h2>
                                </div>
                                <label for="user">User</label>
                                <br/>
                                <select name="user" class="optStyle">
                                    <option value="0">--Select-- </option>
                                    <?php GetUsers($conn,$e_user); ?>
                                </select><div style="color:saddlebrown"><?php echo $errorUser ?> </div>
                                <br/>
                                <label for="role">Role</label>
                                <br/>
                                <select  name="role" class="optStyle">
                                    <option value="0">--Select--</option>
                                    <?php GetRoles($conn,$e_role); ?>
                                </select><div style="color:saddlebrown"><?php echo $errorRole; ?> </div>
                                <br/>
                                <button type="submit" name="save" id="s">Save</button>
                                <br/>
                                <div style="color:saddlebrown"><?php echo $error; ?> </div>
                            </div>
                        </td>

                    </tr>
                </table>
            </form>
        </div>

    </body>

    <script>
        $(document).ready(function () {
            $('#logo').addClass('animated fadeInDown');
            $("input:text:visible:first").focus();
        });
        $('#username').focus(function () {
            $('label[for="username"]').addClass('selected');
        });
        $('#username').blur(function () {
            $('label[for="username"]').removeClass('selected');
        });
        $('#password').focus(function () {
            $('label[for="password"]').addClass('selected');
        });
        $('#password').blur(function () {
            $('label[for="password"]').removeClass('selected');
        });
    </script>

</html>