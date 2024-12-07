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
<title>Barangay Monitoring System - Dashboard</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="userDashboardStyles.css">
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
            <a class="nav-link active" href="userDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userProfile.php"><i class="fas fa-user"></i> Profile</a>
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
    <!-- add php code here -->
    <h2>Welcome Back, <?php echo $user_data['resi_fname']; ?></h2>
    <p> Select from a range of essential documents, input necessary details, and with a simple click, generate professionally formatted reports, certificates, and records tailored to your needs.</p>
    <div id="btns">        
        <div class="row mt-4">
            <div class="col-4">
                <button type="button" class="btn btn-custom btn-block btn-large" onclick="location.href='./userBrgyIndigency.php'"><span class="btn-text">Barangay Indigency</span>
                <p class="text-center mt-2">Click here</p>
                </button>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-custom btn-block btn-large" onclick="location.href='./userBrgyClearance.php'"><span class="btn-text">Barangay Clearance</span>
                <p class="text-center mt-2">Click here</p>
                </button>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-custom btn-block btn-large" onclick="location.href='./userBrgyCerti.php'"><span class="btn-text">Barangay Certificate</span>
                <p class="text-center mt-2">Click here</p>
            </button>
            </div>
        </div>
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
