<?php
session_start();

include("../connection.php");
include("../function.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $suffix_name = $_POST['suffix_name'];
    $purok = $_POST['purok'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $civil_status = $_POST['status'];
    $citizenship = $_POST['citizenship'];
    $sex = $_POST['sex'];
    $education = $_POST['educ'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];

    
    $resi_id = $user_data['resident_id']; 
    $query = "UPDATE resident_info SET 
                resi_fname = '$first_name', 
                resi_mname = '$middle_name', 
                resi_lname = '$last_name', 
                resi_suffix = '$suffix_name',
                resi_zone = '$purok', 
                resi_brgy = '$barangay', 
                resi_city = '$city', 
                resi_province = '$province', 
                resi_age = '$age', 
                resi_bdate = '$birthday', 
                resi_cstatus = '$civil_status', 
                resi_citizenship = '$citizenship', 
                resi_sex = '$sex', 
                resi_educ = '$education', 
                resi_contact = '$contact_number', 
                resi_email = '$email' 
              WHERE resident_id = '$resi_id'";

    if (mysqli_query($con, $query)) {
        $success_message = "Profile updated successfully!";
        header("Location: ./userProfile.php");
        die();
    } else {
        $error_message = "Error updating profile: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barangay Monitoring System - Dashboard</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="userEditProfile.css">
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
    <h2 style="margin-top: -60px;">Edit Profile</h2>
    <div id="container">
        <div class="profile-image">
            <img src="placeholder.jpg" alt="Profile Image">
        </div>
        <br><br>
        <form id="profileForm" method="post" action="">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="<?php echo htmlspecialchars($user_data['resi_fname']); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name" value="<?php echo htmlspecialchars($user_data['resi_mname']); ?>">
                    </div>
                </div>
                <div class="col-md3">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($user_data['resi_lname']); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="suffix">Suffix</label>
                        <input type="text" class="form-control" id="suffix_name" name="suffix_name" placeholder="Enter Suffix" value="<?php echo htmlspecialchars($user_data['resi_suffix']); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="purok">Purok</label>
                        <select class="form-control" id="purok" name="purok" placeholder="Select your purok">
                            <option value="" disabled>Select your purok</option>
                            <option value="Purok 1" <?php if ($user_data['resi_zone'] == 'Purok 1') echo 'selected'; ?>>Purok 1</option>
                            <option value="Purok 2" <?php if ($user_data['resi_zone'] == 'Purok 2') echo 'selected'; ?>>Purok 2</option>
                            <option value="Purok 3" <?php if ($user_data['resi_zone'] == 'Purok 3') echo 'selected'; ?>>Purok 3</option>
                            <option value="Purok 4" <?php if ($user_data['resi_zone'] == 'Purok 4') echo 'selected'; ?>>Purok 4</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="barangay">Barangay</label>
                        <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Enter Barangay" value="<?php echo htmlspecialchars($user_data['resi_brgy']); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="<?php echo htmlspecialchars($user_data['resi_city']); ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" id="province" name="province" placeholder="Enter Province" value="<?php echo htmlspecialchars($user_data['resi_province']); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" class="form-control" id="age" name="age" placeholder="Enter Age" value="<?php echo htmlspecialchars($user_data['resi_age']); ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo htmlspecialchars($user_data['resi_bdate']); ?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="form-control" id="status" name="status" placeholder="Select Civil Status">
                            <option value="" disabled>Select your civil status</option>
                            <option value="Single" <?php if ($user_data['resi_cstatus'] == 'Single') echo 'selected'; ?>>Single</option>
                            <option value="Married" <?php if ($user_data['resi_cstatus'] == 'Married') echo 'selected'; ?>>Married</option>
                            <option value="Divorced" <?php if ($user_data['resi_cstatus'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                            <option value="Widowed" <?php if ($user_data['resi_cstatus'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                            <option value="Separated" <?php if ($user_data['resi_cstatus'] == 'Separated') echo 'selected'; ?>>Separated</option>
                            <option value="Annulled" <?php if ($user_data['resi_cstatus'] == 'Annulled') echo 'selected'; ?>>Annulled</option>
                            <option value="LiveIn" <?php if ($user_data['resi_cstatus'] == 'LiveIn') echo 'selected'; ?>>Live-in</option>
                            <option value="Unknown" <?php if ($user_data['resi_cstatus'] == 'Unknown') echo 'selected'; ?>>Unknown</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="citizenship">Citizenship</label>
                        <input type="text" class="form-control" id="citizenship" name="citizenship" placeholder="Enter Citizenship" value="<?php echo htmlspecialchars($user_data['resi_citizenship']); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select class="form-control" id="sex" name="sex">
                            <option value="" disabled>Select your sex</option>
                            <option value="Male" <?php if ($user_data['resi_sex'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($user_data['resi_sex'] == 'Female') echo 'selected'; ?>>Female</option>
                            <option value="Other" <?php if ($user_data['resi_sex'] == 'Other') echo 'selected'; ?>>Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="education">Educational Attainment</label>
                        <select class="form-control" id="status" name="educ" placeholder="Select your educational attainment">
                            <option value="" disabled>Select your educational attainment</option>
                            <option value="No Education" <?php if ($user_data['resi_educ'] == 'No Education') echo 'selected'; ?>>No Formal education</option>
                            <option value="Primary Level" <?php if ($user_data['resi_educ'] == 'Primary Level') echo 'selected'; ?>>Primary Level</option>
                            <option value="Primary Education" <?php if ($user_data['resi_educ'] == 'Primary Education') echo 'selected'; ?>>Primary Education</option>
                            <option value="Secondary Education" <?php if ($user_data['resi_educ'] == 'Secondary Education') echo 'selected'; ?>>Secondary Education</option>
                            <option value="Vocational Level" <?php if ($user_data['resi_educ'] == 'Vocational Level') echo 'selected'; ?>>Vocational Level</option>
                            <option value="Vocational Education" <?php if ($user_data['resi_educ'] == 'Vocational Education') echo 'selected'; ?>>Vocational Education</option>
                            <option value="College Level" <?php if ($user_data['resi_educ'] == 'College Level') echo 'selected'; ?>>College Level</option>
                            <option value="College Education" <?php if ($user_data['resi_educ'] == 'College Education') echo 'selected'; ?>>College Education</option>
                            <option value="Master Level" <?php if ($user_data['resi_educ'] == 'Master Level') echo 'selected'; ?>>Master Level</option>
                            <option value="Master Education" <?php if ($user_data['resi_educ'] == 'Master Education') echo 'selected'; ?>>Master Education</option>
                            <option value="Doctorate Level" <?php if ($user_data['resi_educ'] == 'Doctorate Level') echo 'selected'; ?>>Doctorate Level</option>
                            <option value="Doctorate Education" <?php if ($user_data['resi_educ'] == 'Doctorate Education') echo 'selected'; ?>>Doctorate Education</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number" value="<?php echo htmlspecialchars($user_data['resi_contact']); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="<?php echo htmlspecialchars($user_data['resi_email']); ?>">
            </div>
            <div class="button-container">
                <a href="./userProfile.php" class="btn-custom">Cancel</a>
                <button type="button" class="custom-btn" onclick="confirmSave()">Save Changes</button>
            </div>
        </form>
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
function confirmSave() {
    if (confirm('Are you sure you want to save changes?')) {
        document.getElementById('profileForm').submit();
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    <?php if (isset($success_message)): ?>
        alert('<?php echo $success_message; ?>');
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        alert('<?php echo $error_message; ?>');
    <?php endif; ?>
});

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
</body>
</html>
