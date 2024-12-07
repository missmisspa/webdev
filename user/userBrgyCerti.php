<?php
session_start();

include("../connection.php");
include("../function.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = htmlspecialchars($_POST['name']);
    $purok = htmlspecialchars($_POST['purok']);
    $age = htmlspecialchars($_POST['age']);
    $date = htmlspecialchars($_POST['date']);
    $status = htmlspecialchars($_POST['status']);
    $purpose = htmlspecialchars($_POST['purpose']);

    
    if (!isset($_SESSION['form_data'])) {
        $_SESSION['form_data'] = [
            'name' => $name,
            'purok' => $purok,
            'age' => $age,
            'date' => $date,
            'status' => $status,
            'purpose' => $purpose
        ];
    }
    unset($_SESSION['form_data']);
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
<link rel="stylesheet" href="userBrgyCerti.css">
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
    <h2>Barangay Certificate</h2>
    <div id="container">
        <form id="registrationForm" method="post" action="../generate_pdf/generate_certification.php" target="_blank">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : ''; ?>" required>
                        <small class="error-message" id="name-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="purok">Purok:</label>
                        <select class="form-control" id="purok" name="purok" required>
                            <option value="">Select your purok</option>
                            <option value="1" <?php echo (isset($_SESSION['form_data']['purok']) && $_SESSION['form_data']['purok'] == '1') ? 'selected' : ''; ?>>1</option>
                            <option value="2" <?php echo (isset($_SESSION['form_data']['purok']) && $_SESSION['form_data']['purok'] == '2') ? 'selected' : ''; ?>>2</option>
                            <option value="3" <?php echo (isset($_SESSION['form_data']['purok']) && $_SESSION['form_data']['purok'] == '3') ? 'selected' : ''; ?>>3</option>
                            <option value="4" <?php echo (isset($_SESSION['form_data']['purok']) && $_SESSION['form_data']['purok'] == '4') ? 'selected' : ''; ?>>4</option>
                        </select>
                        <small class="error-message" id="purok-error"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" value="<?php echo isset($_SESSION['form_data']['age']) ? $_SESSION['form_data']['age'] : ''; ?>" required>
                        <small class="error-message" id="age-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Sex:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="Male" <?php echo (isset($_SESSION['form_data']['sex']) && $_SESSION['form_data']['sex'] == 'Male') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="Female" <?php echo (isset($_SESSION['form_data']['sex']) && $_SESSION['form_data']['sex'] == 'Female') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <small class="error-message" id="sex-error"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Civil Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" disabled>Select your civil status</option>
                            <option value="Single" <?php echo (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                            <option value="Married" <?php echo (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                            <option value="Divorced" <?php echo (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                            <option value="Widowed" <?php echo (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                            <option value="Separated" <?php echo (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] == 'Separated') ? 'selected' : ''; ?>>Separated</option>
                            <option value="Annulled" <?php echo (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] == 'Annulled') ? 'selected' : ''; ?>>Annulled</option>
                            <option value="LiveIn" <?php echo (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] == 'LiveIn') ? 'selected' : ''; ?>>Live-in</option>
                            <option value="Unknown" <?php echo (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] == 'Unknown') ? 'selected' : ''; ?>>Unknown</option>
                        </select>
                        <small class="error-message" id="status-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="purpose">Purpose:</label>
                        <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Enter purpose" value="<?php echo isset($_SESSION['form_data']['purpose']) ? $_SESSION['form_data']['purpose'] : ''; ?>" required>
                        <small class="error-message" id="purpose-error"></small>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <a href="userDashboard.php" class="btn-custom" id="back-btn">Back</a>
                <button type="submit" class="custom-btn" id="next-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<div id="read-only-form" style="display: none;">
    <h2>Barangay Certificate</h2>
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

    function confirmSubmission() {
        if (confirm("Are you sure all information is correct?")) {
            
            document.getElementById("registrationForm").submit();
        } else {
            
        }
    }

    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        
        event.preventDefault();
        
        confirmSubmission();
    });

    
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        
        setTimeout(function() {
            document.getElementById('name').value = '';
            document.getElementById('purok').selectedIndex = 0;
            document.getElementById('age').value = '';
            document.querySelectorAll('input[name="sex"]').forEach(function(radio) {
                radio.checked = false;
            });
            document.getElementById('status').selectedIndex = 0;
            document.getElementById('purpose').value = '';
        }, 500); 
    });

</script>

</body>
</html>