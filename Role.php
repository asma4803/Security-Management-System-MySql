
<?php
require ('connector.php');
require ('validateSession.php');
?>
 
<?php
$e_Role = "";
$e_Description = "";
if (isset($_REQUEST["id"]) && $_REQUEST["id"] > 0) {
    //echo "<script> alert($_REQUEST[id])</script>";
    $e_id = $_REQUEST["id"];
    $q = "SELECT * from roles where roleid='" . $e_id . "'";
    $result = mysqli_query($conn, $q);
    if (mysqli_num_rows($result) > 0) {
        //echo "<script>alert('hello');</script>";
        while ($data = mysqli_fetch_assoc($result)) {
            $e_Role = $data["name"];
            $e_Description = $data["description"];
        }
    }
}
if (isset($_POST["save"]) && (isset($_REQUEST["id"])) == true) {
    $u_role = $_POST["role"];
    $u_description = $_POST["description"];
    
    
    //echo $u_login;
    $q2 = "UPDATE `roles` SET `name` = '" . $u_role. "', `description` = '" . $u_description. "' WHERE `roles`.`roleid` = '" . $e_id . "';";
    if (mysqli_query($conn, $q2)) {
        echo "<script> alert('updated'); </script>";
        header("Location:RoleList.php");
    }
}
?>


<?php

$errorRole = "";
if (isset($_POST["save"]) && (isset($_REQUEST["id"])) == false) {
    $role = $_POST["role"];
    $description = $_POST["description"];
    $date = date("Y-m-d H:i:s");
    $flagRole = true;
    $sql3 = "SELECT name from roles";
    $result3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_assoc($result3)) {
        if (strtolower($role) == strtolower($row3["name"])) {
            $flagRole = false;
        }
    }
    if ($role == "") {
        $errorRole = "Enter Role";
    }

    if ($flagRole == false) {
        $errorRole = "role already exists";
    }
    if ($role != "" && $flagRole == true) {
        $addedBy = $_SESSION["canAdd"];
        $sql = "INSERT INTO `roles` (`roleid`, `name`, `description`,  `createdon`, `createdby`) VALUES (NULL, '" . $role. "', '" . $description . "', '" . $date . "', '" . $addedBy . "');";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New role added successfully');</script>";
            header("Location:RoleList.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Role</title>

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
                                    <h2>Role Management</h2>
                                </div>
                                <label for="role">Role Name</label>
                                <br/>
                                <input type="text" name="role" value="<?php echo $e_Role?>"><div style="color:saddlebrown"><?php echo $errorRole; ?> </div>
                                <br/>
                                <label for="description">Description</label>
                                <br/>
                                <input type="text" name="description"value="<?php echo $e_Description ?>">
                                <br/>
                                <button type="submit" name="save" id="s">Save</button>
                                <br/>
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