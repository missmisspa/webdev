<?php
session_start();

include("connection.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    

    $resident_query = "SELECT * FROM resident_info WHERE resi_username = '$username'";
    $resident_result = mysqli_query($con, $resident_query);
    

    $brgy_query = "SELECT * FROM brgy_info WHERE staff_username = '$username'";
    $brgy_result = mysqli_query($con, $brgy_query);

    if (mysqli_num_rows($resident_result) > 0 || mysqli_num_rows($brgy_result) > 0) {

        $_SESSION['username'] = $username;

        header("Location: forgotPass.php");
        exit;
    } else {
        $_SESSION['notification'] = "Username not found.";
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
    <link rel="stylesheet" href="searchforgotPass.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        html{
            font-family: 'Montserrat';
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
            <div class="titleTxt"><span
                    style="color: white; font-size: 80px; font-family: 'Montserrat', sans-serif; font-weight: 700; line-height: 48px;">Barangay</span><span
                    style="color: white; font-size: 80px; font-family: 'Montserrat', sans-serif; font-weight: 700; line-height: 85px; ">
                    <br /></span><span
                    style="color: white; font-size: 80px; font-family:'Montserrat', sans-serif; font-weight: 700; line-height: 85px;">Monitoring
                    <br />System</span>
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
                <div class="loginTop">Forgot Password</div>
                <div class="message">
                    Search your Username to retrieve your account.
                </div>

                <?php
                if (!empty($error_message)) {
                    echo '<div class="error-message">' . $error_message . '</div>';
                }
                ?>

                <div class="fruit">
                    <div>Enter your Username.</div>
                    <div class="fruitInputField">
                        <input type="text" name="username" class="ComponentName" placeholder="Enter username" style="font-size: 16px;" required>
                    </div>
                </div>
            
                <div class="button-container">
                    <a href="loginResponsive.php" class="btn-back"> Back </a>
                    <button type="submit" class="btn-next" style="padding-bottom:30px;"> Search </button>
                </div>
            </form>
        </div>
    </div>
    <script>
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
