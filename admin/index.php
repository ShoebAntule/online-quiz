<?php
session_start();    
include "../connection.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>
    <meta name="description" content="Admin Login Page">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #343a40; /* Dark background for admin */
            color: #ffffff; /* White text for visibility */
            font-family: 'Arial', sans-serif;
        }

        .login-logo {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff; /* Blue color for the logo */
        }

        .login-content {
            background: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .form-group label {
            color: #ffffff; /* Label color */
        }

        .btn-success {
            background-color: #28a745; /* Green button */
            border-color: #28a745;
        }

        .alert {
            margin-top: 10px;
            display: none; /* Initially hidden */
        }

        .alert-danger {
            background-color: #dc3545; /* Red alert for errors */
            color: #fff;
        }

        @media (max-width: 768px) {
            .login-content {
                padding: 20px; /* Reduce padding on smaller screens */
            }

            .login-logo {
                font-size: 1.5rem; /* Adjust logo size on smaller screens */
            }
        }
    </style>
</head>

<body>

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    Admin Login
                </div>
                <div class="login-form">
                    <form name="form1" action="" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        <button type="submit" name="submit1" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <div class="alert alert-danger" id="errormsg">
                            <strong>Invalid!</strong> Invalid Username or password
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>

<?php
if (isset($_POST["submit1"])) {
    $count = 0;
    $username = mysqli_real_escape_string($link, $_POST["username"]);
    $password = mysqli_real_escape_string($link, $_POST["password"]);
    $res = mysqli_query($link, "SELECT * FROM admin_login WHERE username='$username' AND password='$password'");
    $count = mysqli_num_rows($res);

    if ($count == 0) {
        ?>
        <script type="text/javascript">
            document.getElementById("errormsg").style.display = "block";
        </script>
        <?php
    } else {
        $_SESSION["admin"] = $username;
        ?>
        <script type="text/javascript">
            window.location = "exam_category.php";
        </script>
        <?php
    }
}
?>
