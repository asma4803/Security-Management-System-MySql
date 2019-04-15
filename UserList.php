<?php
require ('connector.php');
require ('validateSession.php');
?>

<?php
if (isset($_POST["create"])) {
    header("Location:User.php");
}

if (isset($_POST["edit"])) {
    $_SESSION["userid"] = $_POST["edit"];
    header("Location:User.php");
}
?>

<?php
if (isset($_REQUEST["delete"])) {
    $id = $_REQUEST["delete"];
    $sql = "DELETE from users where userid='" . $id . "'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Delete Successfully');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>User List</title>

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

         <?php include 'Header.php';?>

        <div class="container">
            <form action="" method="POST">
                <div class="login-box">
                    <div class="box-header">
                        <h2>User List</h2>
                    </div>
                    <table align="center" width="900px" cellspacing="4" cellpadding="4" >
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Created On</th>
                            <th>Created By</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>

                        <?php
                        $sql = "SELECT * from users";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sql1 = "SELECT name from country where id='" . $row["countryid"] . "'";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);

                            $sql2 = "SELECT name from users where userid='" . $row["createdby"] . "'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            if (mysqli_num_rows($result2) > 0) {
                                $createdby = $row2["name"];
                            } else {
                                $createdby = "N/A";
                            }
                            ?>
                            <tr>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row1["name"]; ?></td>
                                <td><?php echo $row["createdon"]; ?></td>
                                <td><?php echo $createdby; ?></td>
                                <?php $e_id = $row["userid"]; ?>
                                <td><a href="User.php?id=<?php echo $e_id; ?>" id="abc">Edit</a></td>
                                <td><button type="submit" value="<?php echo $row["userid"]; ?>" name="delete">Delete</button></td>

                            </tr>

                            <?php
                        }
                        ?>

                    </table>
                    <button type="submit" name="create">Create new User</button>
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