
<?php
require ('utility.php');
require ('connector.php');
?>

<?php
$e_login = "";
$e_password = "";
$e_name = "";
$e_email = "";
$e_country = "";
$e_isadmin=0;
if (isset($_REQUEST["id"]) && $_REQUEST["id"] > 0) {
    //echo "<script> alert($_REQUEST[id])</script>";
    $e_id = $_REQUEST["id"];
    $q = "SELECT * from users where userid='" . $e_id . "'";
    $result = mysqli_query($conn, $q);
    if (mysqli_num_rows($result) > 0) {
        //echo "<script>alert('hello');</script>";
        while ($data = mysqli_fetch_assoc($result)) {
            $e_login = $data["login"];
            $e_password = $data["password"];
            $e_name = $data["name"];
            $e_email = $data["email"];
            $e_country = $data["countryid"];
            $e_isadmin=$data["isadmin"];
        }
    }
}
if (isset($_POST["save"]) && (isset($_REQUEST["id"])) == true) {
    $u_login = $_POST["username"];
    $u_name = $_POST["name"];
    $u_password = $_POST["password"];
    $u_email = $_POST["email"];
    $u_country = $_POST["country"];
    
    //echo $u_login;
    $q2 = "UPDATE `users` SET `login` = '" . $u_login . "', `password` = '" . $u_password . "', `name` = '" . $u_name . "', `email` = '" . $u_email . "', `countryid` = '" . $u_country . "', `isadmin` = '$e_isadmin' WHERE `users`.`userid` = '" . $e_id . "';";
    if (mysqli_query($conn, $q2)) {
        echo "<script> alert('updated'); </script>";
        header("Location:UserList.php");
    }
}
?>



<?php
$errorUsername = "";
$errorName = "";
$errorEmail = "";
$errorPassword = "";
$errorCountry = "";
if (isset($_POST["save"]) == true && (isset($_REQUEST["id"])) == false) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $country = $_POST["country"];
    $email = $_POST["email"];
    $date = date("Y-m-d H:i:s");
    $flagLogin = true;
    $flagEmail = true;
    $sql3 = "SELECT login,email from users";
    $result3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_assoc($result3)) {
        if ($username == $row3["login"]) {
            $flagLogin = false;
        }
        if ($email == $row3["email"]) {
            $flagEmail = false;
        }
    }

    if (isset($_POST["yes"])) {
        $is = 1;
    } else {
        $is = 0;
    }

    if ($username == "") {
        $errorUsername = "Enter username";
    }
    if ($name == "") {
        $errorName = "Enter Name";
    }
    if ($password == "") {
        $errorPassword = "Enter password";
    }
    if ($email == "") {
        $errorEmail = "Enter email";
    }
    if ($country == 0) {
        $errorCountry = "select country";
    }
    if ($flagEmail == false) {
        $errorEmail = "Email already exists";
    }
    if ($flagLogin == false) {
        $errorUsername = "login already exists";
    }
    if ($username != "" && $password != "" && $country != 0 && $email != "" && $name != "" && $flagEmail == true && $flagLogin == true) {
        $addedBy = $_SESSION["canAdd"];
        $sql = "INSERT INTO `users` (`userid`, `login`, `password`, `name`, `email`, `countryid`, `createdon`, `createdby`, `isadmin`) VALUES (NULL, '" . $username . "', '" . $password . "', '" . $name . "', '" . $email . "', '" . $country . "', '" . $date . "', '" . $addedBy . "', '" . $is . "');";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('new record added');</script>";
            header("Location:UserList.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>user</title>

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
                                    <h2>User Management</h2>
                                </div>
                                <label for="username">Username</label>
                                <br/>
                                <input type="text" id="u" name="username" value="<?php echo $e_login ?>" ><div style="color:saddlebrown"><?php echo $errorUsername; ?> </div>
                                <br/>
                                <label for="password">Password</label>
                                <br/>
                                <input type="password" id="p" name="password" value="<?php echo $e_password ?>"><div style="color:saddlebrown"><?php echo $errorPassword; ?> </div>
                                <br/>
                                <label for="name">Name</label>
                                <br/>
                                <input type="text" id="n" name="name" value="<?php echo $e_name ?>"><div style="color:saddlebrown"> <?php echo $errorName; ?></div>
                                <br/>
                                <label for="Email">Email</label>
                                <br/>
                                <input type="email" id="e" name="email" value="<?php echo $e_email ?>"><div style="color:saddlebrown"><?php echo $errorEmail; ?> </div>
                                <br/>
                                <label for="country"> Country </label>
                                <br />
                                <select name="country" class="optStyle" name="country">
                                    <option value="0">--Select--</option>				
                                    <?php
                                    GetCountries($conn, $e_country);
                                    ?>
                                </select><div style="color:saddlebrown"><?php echo $errorCountry; ?> </div>
                                <br/>
                                <?php if ($e_isadmin ==1){?> 
                                <b>is admin?</b> <input type="checkbox" checked name="yes">
                                <?php } 
                                else{?>
                                <b>is admin?</b> <input type="checkbox" name="yes">
                                <?php } ?>
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