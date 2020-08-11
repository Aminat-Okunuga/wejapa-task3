<?php
session_start();
include "function.php";

$error = "";

//Input Validation
if (isset($_POST['submit'])) {
    $array = explode("-", $_POST['dob']);

    $today = strtotime("now");

    if (empty($_POST['fname'])) {
        $error = "First Name is required";
    } elseif (empty($_POST['sname'])) {
        $error = "Second Name is required";
    } elseif (empty($_POST['dob'])) {
        $error = "DOB is required";
    }
//    DOB validation
    elseif (empty($_POST['dob'])|| $_POST['dob'] > $today) {
        $error = "You cannot select a date beyond 2020";
    } elseif (empty($_POST['color'])) {
        $error = "color is required";
    } elseif (empty($_POST['department'])) {
        $error = "Department is required";
    }

//    Email Validation
    elseif ((empty($_POST['email'])) && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        $error = "Email is required";
    }

//    Gender Validation
    elseif ((empty($_POST['genderM'])) && empty(($_POST['genderF']))) {
        $error = "Gender is required";
    }elseif(($_POST['genderM'] == "male") && ($_POST['genderF'] == "female")){
        $error = "You can only check one gender option";
    }

//    Password Validation
    elseif (empty($_POST['password'])) {
        $error = "passowrd is required";
    } elseif (strlen($_POST['password']) <= '15') {
        $error = "Your Password Must Contain At Least 15 Characters!";
    } elseif (!preg_match("#[0-9]+#", $_POST['password'])) {
        $error = "Your Password Must Contain At Least 1 Number!";
    } elseif (!preg_match("#[A-Z]+#", $_POST['password'])) {
        $error = "Your Password Must Contain At Least 1 Capital Letter!";
    } elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['password'])) {
        $error = "Your Password Must Contain At Least 1 Special Character !";
    } else {

        if ($error == "") {
            $password = test_input($_POST["password"]);
            $fname = test_input($_POST['fname']);
            $sname = test_input($_POST['sname']);
            $department = test_input($_POST['department']);
            $dob = test_input($_POST['dob']);
            $color = test_input($_POST['color']);
//            $gender = test_input($_POST['genderM']);
            $email = test_input($_POST['email']);


            $_SESSION['fname'] = $fname;
            $_SESSION['sname'] = $sname;
            if (isset($_POST['genderM'])) {
                $_SESSION['gender'] = $_POST['genderM'];
            }else{
                $_SESSION['gender'] = $_POST['genderF'];
            }
            $_SESSION['dob'] = $dob;
            $_SESSION['color'] = $color;
            $_SESSION['email'] = $email;
            $_SESSION['department'] = $department;
        }
        header('location: profile.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Signup Form</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400&display=swap"
          rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css"/>

</head>

<body>
<div id="booking" class="section">
    <div class="section-center">
        <div class="container">
            <div class="row">
                <div class="booking-form">
                    <div class="form-header">
                        <h1>Sign Up</h1>
                        <p><span style="color: #ff0000;"> <?php echo $error; ?></span></p>
                    </div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">First Name:</span>
                                    <input class="form-control" type="text" name="fname">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Second Name:</span>
                                    <input class="form-control" type="text" name="sname">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Email:</span>
                                    <input class="form-control" type="email" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">D.O.B:</span>
                                    <input class="form-control" type="date" name="dob">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Favorite Color :</span>

                                    <input type="color" name="color" id="color" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Gender:</span>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="male">Male</label>
                                            <input type="checkbox" name="genderM" value="male"
                                                   style="color: white !important">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="female">Female</label>
                                            <input type="checkbox" name="genderF" value="female"
                                                   style="color: white !important">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Department:</span>
                                    <select name="department" id="department" class="form-control">
                                        <option value="">Select Department</option>
                                        <option value="it"> IT</option>
                                        <option value="hr"> HR</option>
                                        <option value="staff"> STAFF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Password:</span>
                                    <input class="form-control" type="password" name="password" id="password">
                                </div>
                            </div>
                        </div>
                        <div class="form-btn">
                            <button class="submit-btn" name="submit">SignUp</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>