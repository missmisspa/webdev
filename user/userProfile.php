<?php
session_start();

include("../connection.php");
include("../function.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barangay Monitoring System - Profile</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="userProfile.css">
<style>
    .custom-button {
        position: relative;
        top: 20%;
        left: 500px;
        background-color: #748C70;
        color: #FFFFFF;
        padding: 10px 40px;
        margin-top: 10px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .custom-button:hover {
        background-color: #5F775B;
        transform: scale(1.1);
        text-decoration: none;
        color: white;
    }

    .editProfile-btn {
        text-decoration: none;
        color: white;
        display: inline-block;
        width: 100%;
    }
</style>
</head>
<body>
<div id="sidebar">
    <div class="text-center mb-4">
        <img src="Legazpi-LOGO.png" alt="Logo 1" class="img-fluid mb-2">
        <img src="BRGY LOGO.png" alt="Logo 2" class="img-fluid mb-2">
        <h4 class="text">Barangay Monitoring System</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="userDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="userProfile.php"><i class="fas fa-user"></i> Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userFullDisclosureBoard.html"><i class="fas fa-clipboard-list"></i> Full Disclosure Board</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userOrgFlowchart.html"><i class="fas fa-sitemap"></i> Organizational Flowchart</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userAbout.html"><i class="fas fa-info-circle"></i> About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="confirmLogout()" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
    
    
</div>

    <div id="content">
        <h2 style="margin-top: -60px;">Profile</h2>
        <div id="container">
            <div class="profile-image">
                <img src="placeholder.jpg" alt="Profile Image" style=" border-radius: 50%;
    border: 5px solid #748C70;">
            </div>
            <br><br>
            <form id="profileForm" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="fname" value="<?php echo htmlspecialchars($user_data['resi_fname']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="mname" value="<?php echo htmlspecialchars($user_data['resi_mname']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="lname" value="<?php echo htmlspecialchars($user_data['resi_lname']); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="purok">Purok</label>
                            <input type="text" class="form-control" id="purok" name="purok" value="<?php echo htmlspecialchars($user_data['resi_zone']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="barangay">Barangay</label>
                            <input type="text" class="form-control" id="barangay" name="barangay" value="<?php echo htmlspecialchars($user_data['resi_brgy']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($user_data['resi_city']); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="<?php echo htmlspecialchars($user_data['resi_province']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($user_data['resi_age']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo htmlspecialchars($user_data['resi_bdate']); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="civil_status">Civil Status</label>
                            <input type="text" class="form-control" id="civil_status" name="cstatus" value="<?php echo htmlspecialchars($user_data['resi_cstatus']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="citizenship">Citizenship</label>
                            <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?php echo htmlspecialchars($user_data['resi_citizenship']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sex">Sex</label>
                            <input type="text" class="form-control" id="sex" name="sex" value="<?php echo htmlspecialchars($user_data['resi_sex']); ?>" readonly
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="civil_status">Educational Attainment</label>
                            <input type="text" class="form-control" id="civil_status" name="educ" value="<?php echo htmlspecialchars($user_data['resi_educ']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="citizenship">Contact Number</label>
                            <input type="text" class="form-control" id="citizenship" name="contact_number" value="<?php echo htmlspecialchars($user_data['resi_contact']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sex">Email</label>
                            <input type="text" class="form-control" id="sex" name="email" value="<?php echo htmlspecialchars($user_data['resi_email']); ?>" readonly
                        </div>
                    </div>
                    
                </div>
                
                </form>
                <div class="btnctn">
                    <a href="userEditProfile.php" class="custom-button editProfile-btn">Edit Profile</a>
                </div>
                
    </div>
    
    

        
    <div class="popup" id="popup">
        <div class="popup-content">
            <p>Are you sure you want to logout?</p>
            <button id="cancelButton" onclick="hidePopup()">Cancel</button>
            <a href="../logout.php"><button id="logoutBtn" onclick="logout()">Logout</button></a>
        </div>
    </div>

    <script>
        function showPopup() {
            document.getElementById('popup').classList.add('active');
        }

        function hidePopup() {
            document.getElementById('popup').classList.remove('active');
        }

        function confirmLogout() {
            showPopup();
        }
    </script>  


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
