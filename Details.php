<?php
require ('connector.php');
require ('validateSession.php');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Details</title>

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="animate.css">
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="s4.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

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

            #abc{
                margin: 10px;
                border: 0;
                border-radius: 2px;
                color:#665851;
               
                font-family: Comic Sans MS;
                padding-left: 10px; 
                padding-right: 10px;
                font-weight: 500;
                font-size: 1.2em;
                letter-spacing: 1px;
                background-color: white;
                cursor:pointer;
                outline: none;
                
            }
            #abc:hover{
                opacity: 0.7;
                border: 1px solid #665851;
                transition: 0.5s;
            }

        </style>


    </head>

    <body>

        <?php include 'Header.php'; ?>

        <div class="container">
            <form action="" method="POST">
                <div class="login-box">
                    <div class="box-header">
                        <h2><b style="font-family:Comic Sans MS" >Lists</b></h2>
                    </div>
                    <table align="center" cellspacing="8" cellpadding="2" style="text-align: center">
                          <tr>
                              <td><a href="UserList.php" id="abc"> User List </a></td>
                          </tr>
                            <tr>    
                                <td><a href="RoleList.php" id="abc"> Role List </a></td>
                            </tr>
                            <tr>
                                <td><a href="PermissionList.php" id="abc"> Permission List </a></td>
                            </tr>
                            <tr>
                                <td><a href="RolePermList.php" id="abc"> Role-Permission List </a></td>
                            </tr>
                            <tr>
                                <td><a href="UserRoleList.php" id="abc"> User-Role List </a></td>
                            </tr>
                    </table>

                </div>

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