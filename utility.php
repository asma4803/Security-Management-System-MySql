

<?php

function GetCountries($conn, $s_id) {
    $sql = "SELECT id,name FROM country";

    $result = mysqli_query($conn, $sql);
    $recordsFound = mysqli_num_rows($result);

    if ($recordsFound > 0) {
        echo $recordsFound;
        while ($row = mysqli_fetch_assoc($result)) {

            $id = $row["id"];
            $name = $row["name"];
            if ($id == $s_id) {
                echo "<option selected value='$id'>$name</option>";
            } else {
                echo "<option value='$id'>$name</option>";
            }
        }
    }
}

function GetRoles($conn, $r_id) {
    $sql = "SELECT roleid,name FROM roles";

    $result = mysqli_query($conn, $sql);
    $recordsFound = mysqli_num_rows($result);

    if ($recordsFound > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["roleid"];
            $name = $row["name"];
           if ($id == $r_id) {
                echo "<option selected value='$id'>$name</option>";
            } else {
                echo "<option value='$id'>$name</option>";
            }
        }
    }
}

function GetPermissions($conn, $p_id) {
    $sql = "SELECT permissionid,name FROM permissions";

    $result = mysqli_query($conn, $sql);
    $recordsFound = mysqli_num_rows($result);
    if ($recordsFound > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["permissionid"];
            $name = $row["name"];

            if ($id == $p_id) {
                echo "<option selected value='$id'>$name</option>";
            } else {
                echo "<option value='$id'>$name</option>";
            }
        }
    }
}

function GetUsers($conn, $u_id) {
    $sql = "SELECT userid,name FROM users";

    $result = mysqli_query($conn, $sql);
    $recordsFound = mysqli_num_rows($result);
    if ($recordsFound > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["userid"];
            $name = $row["name"];
             if ($id == $u_id) {
                echo "<option selected value='$id'>$name</option>";
            } else {
                echo "<option value='$id'>$name</option>";
            }
        }
    }
}
?>

