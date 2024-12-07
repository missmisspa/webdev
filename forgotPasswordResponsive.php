<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="forgotPasswordResponsive.css">
</head>

<body>
    <section class="forgotPassword">
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
            <div class="forgotPasswordContent">
                <div class="forgotPasswordContainer">
                    <h2>Forgot Password</h2>
                    <p>Search your Username to retrieve your account.</p>
                    <form id="regAccForm" method="post" action="#">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>                                 
                        <div class="button-container">
                            <a href="loginResponsive.php" class="btn-custom" id="back-btn">Back</a>
                            <button class="custom-btn" id="search-btn">Search</button>
                        </div>
                </div>
    </section>
    
    <section class="searchAcc" style="display: none;">
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
            <div class="forgotPasswordContent">
                <div class="forgotPasswordContainer">
                    <h2>Forgot Password</h2>
                    <p>Answer your security questions to regain access to your account.</p>
                    <div id="regAccForm" method="post" action="#">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>    
                </form>                            
                        <div class="button-container">
                            <button class="btn-custom" id="back-btn-searchAcc">Back</button>
                            <button class="custom-btn" id="continue-btn-searchAcc">Continue</button>
                        </div>
            </div>
        </div>
    </section>

    <section class="newPassword" style="display: none;">
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
            <div class="forgotPasswordContent">
                <div class="forgotPasswordContainer">
                    <h2>New Password</h2>
                    <div id="regAccForm" method="post" action="#">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
                                        <i class="icon fas fa-eye-slash" id="togglePassword"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Confirm New Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Reenter New Password">
                                        <i class="icon fas fa-eye-slash" id="togglePassword"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </form>                                
                        <div class="button-container">
                            <button class="btn-custom" id="back-btn-newPassword">Back</button>
                            <button class="custom-btn" id="confirm-btn">Confirm</button>
                        </div>
            </div>
        </div>
        <div class="popup" id="popup">
            <div class="popup-content">
                <p>Password Change Successfully!</p>
                <button class="btn-confirm" onclick="hidePopup()">Continue</button>
            </div>
        </div>
    </section>


    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
    
        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });

        function showPopup() {
            document.getElementById('popup').style.display = 'block';
        }
    
        function hidePopup() {
            document.getElementById('popup').style.display = 'none';
            window.location.href = 'loginResponsive.html'; 
        }
    
        document.getElementById('confirm-btn').addEventListener('click', function (event) {
            event.preventDefault();
            showPopup();
        });


        document.addEventListener("DOMContentLoaded", function() {
    // Get references to buttons and sections
    var searchBtn = document.getElementById("search-btn");
    var backBtnSearchAcc = document.getElementById("back-btn-searchAcc");
    var continueBtnSearchAcc = document.getElementById("continue-btn-searchAcc");
    var backBtnNewPassword = document.getElementById("back-btn-newPassword");
    var forgotPasswordSection = document.querySelector(".forgotPassword");
    var searchAccSection = document.querySelector(".searchAcc");
    var newPasswordSection = document.querySelector(".newPassword");

    // Add event listener to search button
    searchBtn.addEventListener("click", function() {
        // Hide forgotPassword section and display searchAcc section
        forgotPasswordSection.style.display = "none";
        searchAccSection.style.display = "block";
    });

    // Add event listener to back button in searchAcc section
    backBtnSearchAcc.addEventListener("click", function() {
        // Hide searchAcc section and display forgotPassword section
        searchAccSection.style.display = "none";
        forgotPasswordSection.style.display = "block";
    });

    // Add event listener to continue button in searchAcc section
    continueBtnSearchAcc.addEventListener("click", function() {
        // Hide searchAcc section and display newPassword section
        searchAccSection.style.display = "none";
        newPasswordSection.style.display = "block";
    });

    // Add event listener to back button in newPassword section
    backBtnNewPassword.addEventListener("click", function() {
        // Hide newPassword section and display searchAcc section
        newPasswordSection.style.display = "none";
        searchAccSection.style.display = "block";
    });
});

    </script>
</body>
</html>
