<?php
    session_start();
    include 'dbConnection.php';

    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user_type = $_POST["userType"];

        

        if($user_type=="student"){
            $sql = "SELECT password FROM students WHERE officialEmail=?";
            $stmt= $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute([$email]);
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            $password_from_db=$result["password"];
            $password_match=password_verify($password,$password_from_db);
            if($password_match){
                $_SESSION["logged_in_user_type"] = $user_type;
                $_SESSION["logged_in_user_email"] = $email;
                header('Location: user.php');
            }
        }

        if($user_type=="academic_staff" || $user_type == "temp_academic_staff"){
            $sql = "SELECT password FROM academicstaff WHERE officialEmail=?";
            $stmt= $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute([$email]);
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            $password_from_db=$result["password"];
            $password_match=password_verify($password,$password_from_db);
            if($password_match){
                $_SESSION["logged_in_user_type"] = $user_type;
                $_SESSION["logged_in_user_email"] = $email;
                header('Location: user.php');
            }
        }
        if($user_type=="administrator"){
            
            $sql = "SELECT password FROM administrators WHERE id=?";
            $stmt= $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $email=2;
            $stmt->execute([$email]);
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            echo $result;
            $password_from_db=$result["password"];
            echo " <script>alert(".$result["password"]." ". $password.");</script>  ";
            $password_match=password_verify($password,$password_from_db);
            echo "password from db = ".$password_from_db;
            if($password_match){
                $_SESSION["logged_in_user_type"] = $user_type;
                $_SESSION["logged_in_user_email"] = $email;
                header('Location: admin.php');
            }
        }


        // password_verify()
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Its Birthday Time!!!!</title>
</head>
<body>
    <h2>Birthdays!</h2>
    <h3>Login</h3>

    <form action="index.php" method="post">

    <div>
            <h3>User Type: </h3>
            <label for="student">Student</label>
            <input type="radio" checked name="userType" id="student" value="student">
            <label for="student">Academic Staff</label>
            <input type="radio" name="userType" id="academic_staff" value="academic_staff">
            <label for="student">Temporary Academic Staff</label>
            <input type="radio" name="userType" id="temp_academic_staff" value="temp_academic_staff">
            <label for="student">Administrator</label>
            <input type="radio" name="userType" id="administrator" value="administrator">
        </div>


        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <br>
        <input type="submit" value="Login" name="login">

    </form>
</body>
</html>

