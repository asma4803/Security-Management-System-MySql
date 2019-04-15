<html>
    <head>
        <style>
            .topnav {
                overflow: hidden;
                background-color: #333;

            }

            .topnav a {
                float: left;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 14px;
                text-decoration: none;
                font-size: 16px;
                font-family: Comic Sans MS;
            }

            .topnav a:hover {
                background-color: #F0B27A;
                color: black;
                text-shadow: 0px 0px 5px white;
            }

            .topnav a.active {
                background-color: #935116;
                color: white;

            }
        </style>
    </head>
    <body>
         <div class="topnav">
            <a class="active" href="#">Home</a>
            <a href="User.php">User Management</a>
            <a href="Role.php">Role Management</a>
            <a href="Permission.php">Permission Management</a>
            <a href="RolePerm.php">Role Permission Management</a>
            <a href="UserRole.php">User Role Management</a>
            <a href="LoginHistory.php">Login History</a>
            <a href="Details.php">Details</a>
            <a href="Logout.php" >Logout</a>
        </div>
    </body>
</html>