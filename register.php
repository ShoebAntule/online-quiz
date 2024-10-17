<?php
include "connection.php";
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register Now</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css1/bootstrap.min.css">
    <link rel="stylesheet" href="css1/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css1/responsive.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
    background-color: #2d3e50; /* Change this to any color you want */
    font-family: 'Play', sans-serif;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}


        .error-pagewrap {
            width: 100%;
            max-width: 600px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 40px rgba(0, 0, 0, 0.1);
            padding: 30px; /* Adjusted padding for less height */
            margin: 0 auto;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .custom-login h3 {
            color: #f12711;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px; /* Reduced margin */
            position: relative;
        }

        .custom-login h3:after {
            content: '';
            width: 50px;
            height: 4px;
            background-color: #f5af19;
            display: block;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid transparent;
            border-radius: 8px;
            background: #f8f8f8;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus {
            border-color: #f12711;
            box-shadow: 0 0 8px rgba(241, 39, 17, 0.5);
            outline: none;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"],
        .form-group input[type="tel"] {
            background: #e9ecef;
        }

        .btn-success {
            background-color: #f12711;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 50px;
            color: white;
            width: 100%;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-success:hover {
            background-color: #f5af19;
            box-shadow: 0 0 15px rgba(255, 85, 34, 0.4);
        }

        .alert {
            border-radius: 5px;
            margin-top: 15px;
            padding: 10px;
            text-align: center;
            font-weight: 600;
            display: none;
        }

        #success {
            background-color: #d4edda;
            color: #155724;
        }

        #failure {
            background-color: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .error-pagewrap {
                padding: 20px;
            }

            .custom-login h3 {
                font-size: 24px;
            }

            .btn-success {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>

<div class="error-pagewrap">
    <div class="error-page-int">
        <div class="text-center custom-login">
            <h3>Register Now</h3>
        </div>
        <div class="content-error">
            <div class="hpanel">
                <div class="panel-body">
                    <form action="" name="form1" method="post">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter your first name" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Enter your last name" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Choose a username" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Choose a password" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Contact</label>
                                <input type="tel" name="contact" class="form-control" placeholder="Enter your contact number" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit1" class="btn btn-success loginbtn">Register</button>
                        </div>
                        <div class="alert alert-success" id="success">
                            <strong>Success!</strong> Account Registration Successfully.
                        </div>

                        <div class="alert alert-danger" id="failure">
                            <strong>Already Exist!</strong> Username already exists.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit1'])) {
    $res = mysqli_query($link, "SELECT * FROM registration WHERE username='$_POST[username]'") or die(mysqli_error($link));
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "none";
            document.getElementById("failure").style.display = "block";
        </script>
        <?php
    } else {
        mysqli_query($link, "INSERT INTO registration VALUES (NULL, '$_POST[firstname]', '$_POST[lastname]', '$_POST[username]', '$_POST[password]', '$_POST[email]', '$_POST[contact]')") or die(mysqli_error($link));
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "block";
            document.getElementById("failure").style.display = "none";
            setTimeout(function () {
                window.location = 'login.php';
            }, 2000);
        </script>
        <?php
    }
}
?>

<script src="js/vendor/jquery-1.12.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery-price-slider.js"></script>
<script src="js/jquery.meanmenu.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

</body>

</html>
