<?php
session_start();
include("connection.php");
include("function.php");

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_SESSION['username']; 
    $fruit = $_SESSION['fruit'];
    $animal = $_SESSION['animal'];

    
    $resident_query = "SELECT * FROM resident_info WHERE resi_username = '$username' AND resi_fruit = '$fruit' AND resi_animal = '$animal'";
    $resident_result = mysqli_query($con, $resident_query);

    
    $brgy_query = "SELECT * FROM brgy_info WHERE staff_username = '$username' AND staff_fruit = '$fruit' AND staff_animal = '$animal'";
    $brgy_result = mysqli_query($con, $brgy_query);

    if (mysqli_num_rows($resident_result) > 0 || mysqli_num_rows($brgy_result) > 0) {
        
        
        $new_password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        
        if ($new_password != $confirm_password) {
            $_SESSION['notification'] = "Passwords do not match";
            $_SESSION['notification_type'] = "error";

        } else {
            
            $update_query = "UPDATE resident_info SET resi_password = '$new_password' WHERE resi_username = '$username'";
            mysqli_query($con, $update_query);

            
            $update_query = "UPDATE brgy_info SET staff_password = '$new_password' WHERE staff_username = '$username'";
            mysqli_query($con, $update_query);
            session_unset();    

            
            $_SESSION['notification'] = "Password changed successfully";
            $_SESSION['notification_type'] = "success"; 

            
            header("Location: loginResponsive.php");
            exit;
        }
    } else {
        $_SESSION['notification'] = "Incorrect Password";
        $_SESSION['notification_type'] = "error";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="recoverAcc.css">
    <link href="https:
    <style>
        .text-danger {
            color: red;
        }
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
    <div class="Login">
        <div class="background">
            <img class="backgrnd" src="icons/bg half.png" alt="bg">
        </div>
        <div class="logo">
            <img class="LegazpiLogo" src="icons/Legazpi-LOGO.png" />
            <img class="BrgyLogo" src="icons/BRGY LOGO.png" />
        </div>
        <div class="text">
            <div class="titleTxt">
                <span style="color: white; font-size: 80px; font-family: 'Montserrat', sans-serif; font-weight: 700; line-height: 48px;">Barangay</span>
                <span style="color: white; font-size: 80px; font-family: 'Montserrat', sans-serif; font-weight: 700; line-height: 85px; "><br /></span>
                <span style="color: white; font-size: 80px; font-family:'Montserrat', sans-serif; font-weight: 700; line-height: 85px;">Monitoring <br />System</span>
            </div>
        </div>
        <div class="mainLogin">
        <?php
                
                if (isset($_SESSION['notification'])) {
                    $notification_type = isset($_SESSION['notification_type']) ? $_SESSION['notification_type'] : 'error';
                    echo "<div class='notification $notification_type'>{$_SESSION['notification']}</div>";
                    unset($_SESSION['notification']);
                    unset($_SESSION['notification_type']);
                }
            ?>
            <form action="" method="post" class="forms">
                <div class="loginTop">New Password</div>
                <div class="newPass">
                    <div>Enter new Password</div>
                    <div class="newPassInputField">
                        <input type="password" class="ComponentName" placeholder="Enter new Password" name="password" id="password" required>
                        <p id="password-error" class="text-danger" style="position: absolute; font-size: 13px;margin-top:-10px; font-weight:lighter"></p>
                    </div>
                </div>
                <div class="confirmPass" style="margin-top: 20px; ">
                    <div>Confirm new Password</div>
                    <div class="confirmInputField">
                        <input type="password" class="ComponentName" placeholder="Confirm new Password" name="confirm-password" id="confirm-password" required>
                        <p id="confirmpass-error" class="text-danger" style="position: absolute; font-size: 13px;margin-top:-10px; font-weight:lighter"></p>
                    </div>
                </div>
                <div class="button-container" style="margin-top: 20px;">
                    <a href="forgotPass.php" class="btn-back">Cancel</a>
                    <button type="submit" class="btn-continue" id="Btn">Confirm</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('Btn').addEventListener('click', function(event) {
            
            event.preventDefault();
            
            validateForm();
        });

        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const passwordError = document.getElementById('password-error');
            const confirmPasswordError = document.getElementById('confirmpass-error');
            let isValid = true;

            
            if (password.length < 8 || password.length > 20) {
                passwordError.textContent = 'Password must be between 8 and 20 characters.';
                isValid = false;
            } else {
                passwordError.textContent = '';
            }

            
            if (password !== confirmPassword) {
                confirmPasswordError.textContent = 'Passwords do not match.';
                isValid = false;
            } else {
                confirmPasswordError.textContent = '';
            }

            
            if (isValid) {
                
                passwordError.textContent = '';
                confirmPasswordError.textContent = '';
                
                document.querySelector('form').submit();
            }
        }

        var notification = document.querySelector('.notification');
        if (notification) {
            notification.style.display = 'block';

            
            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>