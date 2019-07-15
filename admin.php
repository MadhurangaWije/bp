<?php
    session_start();
    include "dbConnection.php";
    if(!isset($_SESSION["logged_in_user_type"]) || $_SESSION["logged_in_user_type"]!="administrator"){
        // header("Location:index.php");
    }

        $sql_students = "SELECT user_id,firstName, lastName, officialEmail, mobile FROM students";
        $stmt_students= $conn->prepare($sql_students);
        $stmt_students->setFetchMode(PDO::FETCH_ASSOC);
        $stmt_students->execute();

        $sql_academic_staff = "SELECT user_id,firstName, lastName, officialEmail, mobile, temporary, organizer FROM academicstaff";
        $stmt_academic_staff= $conn->prepare($sql_academic_staff);
        $stmt_academic_staff->setFetchMode(PDO::FETCH_ASSOC);
        $stmt_academic_staff->execute();

        $sql_admin = "SELECT id,fullName, email, mobile FROM administrators";
        $stmt_admin= $conn->prepare($sql_admin);
        $stmt_admin->setFetchMode(PDO::FETCH_ASSOC);
        $stmt_admin->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="admin.css">
    <title>Document</title>
</head>
<body>
    
    <h2>Administrator</h2>
    <a href="adduser.php">Add User</a>

    <h3>Students</h3>
    <table >
        <tr>
            <td>Id</td>
            <td>Full Name</td>
            <td>Email</td>
            <td>Mobile</td>
            <td>Edit</td>
            <td>Delete</td>

        </tr>

        <?php
                while($row_students=$stmt_students->fetch()) 
                {
                    echo "<tr>".
                        "<td>".$row_students["user_id"]."</td>".
                        "<td>".$row_students["firstName"]." ".$row_students["lastName"]. "</td>".
                        "<td>".$row_students["officialEmail"]."</td>".
                        "<td>".$row_students["mobile"]."</td>".
                        "<td><a href=''>Edit</a></td>".
                        "<td><a href=''>Delete</a></td>".
                        "</tr>";
                }
            
        ?>

    </table>

    <h3>Academic Staff</h3>
    <table >
        <tr>
            <td>Id</td>
            <td>Full Name</td>
            <td>Email</td>
            <td>Mobile</td>
            <td>Temporary</td>
            <td>Organizer</td>
            <td>Edit</td>
            <td>Delete</td>

        </tr>

        <?php
                while($row_academic_staff=$stmt_academic_staff->fetch()) 
                {
                    echo "<tr>".
                        "<td>".$row_academic_staff["user_id"]."</td>".
                        "<td>".$row_academic_staff["firstName"]." ".$row_academic_staff["lastName"]. "</td>".
                        "<td>".$row_academic_staff["officialEmail"]."</td>".
                        "<td>".$row_academic_staff["mobile"]."</td>".
                        "<td>".$row_academic_staff["temporary"]."</td>".
                        "<td>".$row_academic_staff["organizer"]."</td>".
                        "<td><a href=''>Edit</a></td>".
                        "<td><a href=''>Delete</a></td>".
                        "</tr>";
                }
            
        ?>

    </table>

    <h3>Administrators</h3>
    <table >
        <tr>
            <td>Id</td>
            <td>Full Name</td>
            <td>Email</td>
            <td>Mobile</td>
            <td>Edit</td>
            <td>Delete</td>

        </tr>

        <?php
                while($row_admin=$stmt_admin->fetch()) 
                {
                    echo "<tr>".
                        "<td>".$row_admin["id"]."</td>".
                        "<td>".$row_admin["fullName"]. "</td>".
                        "<td>".$row_admin["email"]."</td>".
                        "<td>".$row_admin["mobile"]."</td>".
                        "<td><a href=''>Edit</a></td>".
                        "<td><a href=''>Delete</a></td>".
                        "</tr>";
                }
            
        ?>

    </table>


</body>
</html>