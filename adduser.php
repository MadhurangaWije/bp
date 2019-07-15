<?php  

    include 'dbConnection.php';

    if(isset($_POST["create_user_btn"])){
        $userType=$_POST["userType"];

        if($userType != "administrator"){
            $firstName=$_POST["firstName"];
            $lastName=$_POST["lastName"];
            $prefferedName=$_POST["prefferedName"];
            $dob=$_POST["dob"];
            $officialEmail=$_POST["officialEmail"];
            $personalEmail=$_POST["personalEmail"];
            $password=$_POST["password"];
            $hashedPassword=password_hash($password,PASSWORD_BCRYPT);
            $mobile=$_POST["mobile"];
            $facebook=$_POST["facebook"];
            if(isset($_POST["foodPreference"])){
                $foodPreference=1;
            }else{
                $foodPreference=0;
            }
            $notes=$_POST["notes"];
        }

        $organizer=0;
        $temporary=0;

        if($userType=="academic_staff" || $userType=="temp_academic_staff"){
            if($userType=="temp_academic_staff"){
                $temporary=1;
            }
            if(isset($_POST["organizer"])){
                $organizer=1;
            }else{
                $organizer=0;
            }
        }
        $student_id="";
        if($userType=="student"){
            $student_id=$_POST["student_id"];
        }
        
        if($userType=="administrator"){
            $fullName=$_POST["admin_fullName"];
            $email=$_POST["admin_email"];
            $mobile=$_POST["mobile_admin"];
            $designation=$_POST["designation"];
            $admin_password=$_POST["admin_password"];
            $admin_password_hashed=password_hash($admin_password,PASSWORD_BCRYPT);
        }

        $sql = "INSERT INTO users (type) VALUES (?)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$userType]);
        $last_user_id=$conn->lastInsertId();
    
         if($userType=="student"){
            $sql = "INSERT INTO students (user_id,student_id,firstName,lastName,prefferedName,dob,officialEmail,personalEmail,mobile,facebook,foodPreference,notes,password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$last_user_id, $student_id,$firstName,$lastName,$prefferedName,$dob,$officialEmail,$personalEmail,$mobile,$facebook,$foodPreference,$notes,$hashedPassword]);
         }

         if($userType=="academic_staff" || $userType=="temp_academic_staff"){
            $sql = "INSERT INTO academicstaff (user_id,firstName, lastName,prefferedName,dob,officialEmail,personalEmail,mobile,facebook,foodPreference,notes,password,temporary,organizer) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$last_user_id, $firstName,$lastName,$prefferedName,$dob,$officialEmail,$personalEmail,$mobile,$facebook,$foodPreference,$notes,$hashedPassword,$temporary,$organizer]);
         }

         if($userType=="administrator"){
            $sql = "INSERT INTO administrators (fullName,email,mobile,designation,password) VALUES (?,?,?,?,?)";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$fullName,$email,$mobile,$designation,$admin_password_hashed]);
         }
        
         header('Location: admin.php');


        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Add New User</h2>
    <form action="adduser.php" method="POST">

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

        <div id="basic_infomation">
            <h3> Basic Infomation</h3>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName"> <br>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName"> <br>
            <label for="prefferedName">Preffered Name</label>
            <input type="text" name="prefferedName" id="prefferedName"> <br>
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob"> <br>
            <label for="officialEmail">Official Email</label>
            <input type="email" name="officialEmail" id="officialEmail"> <br>
            <label for="personalEmail">Personal Email</label>
            <input type="email" name="personalEmail" id="personalEmail"> <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"> <br>
            <label for="mobile">Mobile</label>
            <input type="number" name="mobile" id="mobile"> <br>
            <label for="facebook">Facebook</label>
            <input type="text" name="facebook" id="facebook"> <br>

            <label>Food Preference : </label>
            <label for="veg">Vegetarian</label>
            <input type="radio" name="foodPreference" id="veg" value="veg">
            <label for="non_veg">Non Vegetarian</label>
            <input type="radio" name="foodPreference" id="non_veg" value="non_veg"> <br>

            <label for="notes">Notes</label><br>
            <textarea name="notes" id="notes" cols="60" rows="10"></textarea> <br>
            
        </div>

        <div id="student_div">
            <h3>Student</h3>
            <label for="student_id">Student ID</label>
            <input type="text" name="student_id" id="student_id"> <br>
        </div>


        <div id="administrator_div" style="display:none">
            <h3>Administrator</h3>
            <label for="admin_fullName">Full Name</label>
            <input type="text" name="admin_fullName" id="admin_fullName"> <br>
            <label for="admin_email">Email</label>
            <input type="email" name="admin_email" id="admin_email"> <br>
            <label for="admin_mobile">Mobile</label>
            <input type="text" name="mobile_admin" id="admin_mobile"> <br>
            <label for="designation">Designation</label>
            <input type="text" name="designation" id="designation"> <br>
            <label for="admin_password">Password</label>
            <input type="password" name="admin_password" id="admin_password"> <br>
        </div>

        <div id="organizer_div" style="display:none">
            <label for="organizer">Organizer</label>
            <input type="checkbox" name="organizer" id="organizer" value>
        </div>
        <br><br>
        <input type="submit" name="create_user_btn" value="Create User">
    
    </form>
    <script src="adduser.js"></script>
</body>
</html>