
<?php
require ('connector.php');
require ('validateSession.php');
?>

<?php
$e_permission = "";
$e_description = "";
if (isset($_REQUEST["id"]) && $_REQUEST["id"] > 0) {
    //echo "<script> alert($_REQUEST[id])</script>";
    $e_id = $_REQUEST["id"];
    $q = "SELECT * from permissions where permissionid='" . $e_id . "'";
    $result = mysqli_query($conn, $q);
    if (mysqli_num_rows($result) > 0) {
        //echo "<script>alert('hello');</script>";
        while ($data = mysqli_fetch_assoc($result)) {
            $e_permission = $data["name"];
            $e_description = $data["description"];
        }
    }
}
if (isset($_POST["save"]) && (isset($_REQUEST["id"])) == true) {
    $u_permission = $_POST["permission"];
    $u_description = $_POST["description"];
    
    
    //echo $u_login;
    $q2 = "UPDATE `permissions` SET `name` = '" . $u_permission. "', `description` = '" . $u_description. "' WHERE `permissions`.`permissionid` = '" . $e_id . "';";
    if (mysqli_query($conn, $q2)) {
        echo "<script> alert('updated'); </script>";
        header("Location:PermissionList.php");
    }
}
?>



<?php
$errorPermission = "";
if (isset($_POST["save"]) && (isset($_REQUEST["id"])) == false) {
    $permission = $_POST["permission"];
    $description = $_POST["description"];
    $date = date("Y-m-d H:i:s");
    $flagPermission = true;
    $sql3 = "SELECT name from permissions";
    $result3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_assoc($result3)) {
        if (strtolower($permission) == strtolower($row3["name"])) {
            $flagPermission = false;
        }
    }
    if ($permission == "") {
        $errorPermission = "Enter Permission";
    }

    if ($flagPermission == false) {
        $errorPermission = "permission already exists";
    }
    if ($permission != "" && $flagPermission == true) {
        $addedBy = $_SESSION["canAdd"];
        $sql = "INSERT INTO `permissions` (`permissionid`, `name`, `description`,  `createdon`, `createdby`) VALUES (NULL, '" . $permission. "', '" . $description . "', '" . $date . "', '" . $addedBy . "');";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New permission added successfully');</script>";
            header("Location:PermissionList.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Permission</title>

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
                                    <h2>Permission Management</h2>
                                </div>
                                <label for="permission">Permission Name</label>
                                <br/>
                                <input type="text" name="permission" value="<?php echo $e_permission ?>" ><div style="color:saddlebrown"><?php echo $errorPermission; ?> </div>
                                <br/>
                                <label for="description">Description</label>
                                <br/>
                                <input type="text" name="description" value="<?php echo $e_description ?>">
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