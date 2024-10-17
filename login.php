<?php
session_start();
include "connection.php";
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css1/bootstrap.min.css">
    <link rel="stylesheet" href="css1/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css1/responsive.css">

    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #fff, #2575fc);
            font-family: 'Play', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            animation: backgroundShift 10s ease-in-out infinite; /* Background animation */
        }

        @keyframes backgroundShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Login Container */
        .error-pagewrap {
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.1); /* Transparent background */
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3); /* Strong shadow for depth */
            position: relative;
            z-index: 2;
        }

        .custom-login h3 {
            text-transform: uppercase;
            color: #fff;
            letter-spacing: 1.5px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 26px;
            animation: glowText 1.5s ease-in-out infinite alternate; /* Glowing effect */
        }

        @keyframes glowText {
            0% { text-shadow: 0 0 10px #fff, 0 0 20px #6a11cb, 0 0 30px #6a11cb, 0 0 40px #6a11cb; }
            100% { text-shadow: 0 0 20px #fff, 0 0 30px #2575fc, 0 0 40px #2575fc, 0 0 50px #2575fc; }
        }

        /* Form Inputs */
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #000; /* Changed to black for visibility */
            border-radius: 8px;
            padding: 12px 20px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .form-control:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.6), 0 0 30px rgba(106, 17, 203, 0.5);
        }

        /* Buttons */
        .loginbtn, .btn-default {
            width: 100%;
            border-radius: 8px;
            padding: 12px;
            font-size: 18px;
            letter-spacing: 1.2px;
            transition: 0.4s;
        }

        .loginbtn {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: #fff;
            border: none;
        }

        .loginbtn:hover {
            background: linear-gradient(45deg, #2575fc, #6a11cb);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
        }

        .btn-default {
            background: rgba(255, 255, 255, 0.8);
            color: #6a11cb;
            border: none;
        }

        .btn-default:hover {
            background: rgba(255, 255, 255, 1);
            color: #2575fc;
            box-shadow: 0 0 10px rgba(106, 17, 203, 0.5);
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            color: #fff;
            margin-top: 10px;
            display: none; /* Initially hidden */
            text-align: center;
        }

        .alert-danger {
            background: rgba(255, 0, 0, 0.8);
        }

        .alert-success {
            background: rgba(0, 255, 0, 0.8);
        }
    </style>
</head>

<body>

    <div class="error-pagewrap">
        <div class="error-page-int">
            <div class="custom-login">
                <h3>Login Form</h3>
            </div>
            <div class="content-error">
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="" name="form1" method="post">
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" required class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" placeholder="Password" required class="form-control">
                            </div>
                            <button type="submit" name="login" class="btn btn-success btn-block loginbtn">Login</button>
                            <a href="register.php" class="btn btn-default btn-block">Register</a>
                            <div class="alert alert-danger" id="failure">Invalid Username or Password</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["login"])) {
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $password = mysqli_real_escape_string($link, $_POST["password"]);
        $res = mysqli_query($link, "SELECT * FROM registration WHERE username='$username' AND password='$password'");
        $count = mysqli_num_rows($res);

        if ($count == 0) {
            echo "<script>document.getElementById('failure').style.display = 'block';</script>";
        } else {
            $_SESSION["username"] = $username;
            echo "<script>window.location = 'select_exam.php';</script>";
        }
    }
    ?>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
