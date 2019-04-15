<?php
require ('connector.php');
require ('validateSession.php');
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Login History</title>

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="animate.css">
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="s3.css">

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
                margin-top: 0px;
                border: 0;
                border-radius: 2px;
                color: white;
                padding: 10px;
                text-transform: uppercase;
                font-weight: 400;
                font-size: 0.7em;
                letter-spacing: 1px;
                background-color: #665851;
                cursor:pointer;
                outline: none;
            }
            #abc:hover{
                opacity: 0.7;
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
                        <h2>Login History</h2>
                    </div>
                    <table align="center" width="900px" cellspacing="4" cellpadding="4" style="text-align: center">
                        <tr>
                            <th>Name</th>
                            <th>Login Time</th>
                            <th>Machine IP</th>

                        </tr>

                        <?php
                        $sql = "SELECT * from loginhistory";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        while ($row = mysqli_fetch_assoc($result)) {

                            $sql2 = "SELECT name from users where userid='" . $row["userid"] . "'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            ?>
                            <tr>
                                <td><?php echo $row2["name"]; ?></td>
                                <td><?php echo $row["logintime"]; ?></td>
                                <td><?php echo $row["machineip"]; ?></td>

                            </tr>

                            <?php
                        }
                        ?>

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