<?php
session_start();

include("connection.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        //  check if username exists and retrieve user
        function getUser($con, $table, $usernameColumn, $username) {
            $query = "SELECT * FROM $table WHERE $usernameColumn = '$username'";
            $result = mysqli_query($con, $query);
            return mysqli_fetch_assoc($result);
        }
        // Check in brgy_info table
        $adminUser = getUser($con, 'brgy_info', 'staff_username', $username);

        if ($adminUser) {
            if ($adminUser['staff_password'] === $password) {
                // redirect to admin dashboard if info correct
                $_SESSION['staff_id'] = $adminUser['staff_id']; 
                header("Location: admin/adminDashboard.php");
                exit();
            } else {
                $_SESSION['notification'] = "Incorrect password.";
                $_SESSION['notification_type'] = "error";
            }
        } else {
            $normalUser = getUser($con, 'resident_info', 'resi_username', $username);

            if ($normalUser) {
                if ($normalUser['resi_password'] === $password) {
                    $_SESSION['resident_id'] = $normalUser['resident_id']; 
                    header("Location: user/userDashboard.php");
                    exit();
                } else {
                    $_SESSION['notification'] = "Incorrect password.";
                    $_SESSION['notification_type'] = "error";
                }
            } else {
                $_SESSION['notification'] = "Username not found.";
                $_SESSION['notification_type'] = "error";
            }
        }
        // If redirection hasn't happened yet, redirect back to login page with notification
        header("Location: loginResponsive.php");
        exit();
    } else {
        $_SESSION['notification'] = "Please enter both username and password.";
        $_SESSION['notification_type'] = "error";
        // Redirect back to login page with notification
        header("Location: loginResponsive.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="loginResponsive.css">

    <style>
        .notification {
            display: block;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f44336; 
            color: white; 
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 9999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .notification.success {
            background-color: #4CAF50; 
        }
        .notification.error {
            background-color: #f44336;
        }
    </style>
</head>

<body>
    <section class="loginSection">
        <div class="background">
            <div class="containerTitle-Logo">
                <div class="logo-container">
                    <img src="icons/Legazpi-LOGO.png" alt="legazpi logo" class="img-fluid mb-2">
                    <img src="icons/BRGY LOGO.png" alt="tamaoyan logo" class="img-fluid mb-2">
                </div>
                <div class="titleText">
                    <p>Barangay<br>Monitoring<br>System</p>
                </div>
            </div>
            <div class="loginSectionContent">
                <div class="loginSectionContainer">
                    <h2>Login</h2>
                    <?php

                        if (isset($_SESSION['notification'])) {
                            $notification_type = isset($_SESSION['notification_type']) ? $_SESSION['notification_type'] : 'error';
                            echo "<div class='notification $notification_type'>{$_SESSION['notification']}</div>";
                            unset($_SESSION['notification']);
                            unset($_SESSION['notification_type']);
                        }
                    ?>
                    <form id="regAccForm" method="post" action="#" onsubmit="return submitForm()">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Enter Username" required>
                                    <span id="usernameError" class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter Password" required>
                                        <i class="icon fas fa-eye-slash" id="togglePassword"></i>
                                    </div>
                                    <span id="passwordError" class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="forgot-password">
                                <a href="searchforgotPass.php">Forgot Password</a>
                            </div>
                        </div>
                        <div class="button-container">
                            <button type="submit" class="custom-btn" id="register-btn">Login</button>
                        </div>
                    </form>
                    <div class="register-now">
                        <p>Don't Have An Account?<a href="register.php"> Register Now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var notification = document.querySelector('.notification');
        if (notification) {
            notification.style.display = 'block';


            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000);
        }
        
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
    
        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
        
    
    </script>    
</body>
</html>
