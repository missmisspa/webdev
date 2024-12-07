<?php
session_start();

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $suffix = $_POST['suffix'];
    $purok = $_POST['purok'];
    $brgy = $_POST['barangay'];
    $city = $_POST['city'];
    $prov = $_POST['province'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bdate = $_POST['birthday']; 
    $contact = $_POST['contact_number'];
    $fruit = $_POST['fruit'];
    $cstatus = $_POST['cstatus'];
    $animal = $_POST['animal'];
    $citizen = $_POST['citizenship'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $userType = $_POST['userType'];
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $educ = $_POST['educ'];

    function valueExists($con, $table, $column, $value) {
        $query = "SELECT * FROM $table WHERE $column = '$value'";
        $result = mysqli_query($con, $query);
        return mysqli_num_rows($result) > 0;
    }

    if (
        !empty($email) && !empty($fname) && !empty($lname) && !empty($purok) && !empty($brgy) &&
        !empty($city) && !empty($prov) && !empty($bdate) && !empty($sex) && !empty($password) && !empty($username) &&
        !empty($contact) && !empty($fruit) && !empty($cstatus) && !empty($animal) && !empty($citizen) && !empty($age)
    ) {
        
        if (valueExists($con, 'resident_info', 'resi_username', $username) || valueExists($con, 'brgy_info', 'staff_username', $username)) {
            $_SESSION['notification'] = "Username is already taken.";
            $_SESSION['notification_type'] = "error";
            header("Location: register.php");
            exit();
        }
        
        if (valueExists($con, 'resident_info', 'resi_email', $email) || valueExists($con, 'brgy_info', 'staff_email', $email)) {
            $_SESSION['notification'] = "Email is already taken.";
            $_SESSION['notification_type'] = "error";
            header("Location: register.php");
            exit();
        }

        if ($userType == 'barangay-council') {
            // Check if position is selected
            if (empty($position)) {
                $_SESSION['notification'] = "Please select a position.";
                $_SESSION['notification_type'] = "error";
                header("Location: register.php");
                exit();
            }

            
            $sql_count = "SELECT COUNT(*) as count FROM brgy_info WHERE staff_position = '$position'";
            $result = mysqli_query($con, $sql_count);
            $row = mysqli_fetch_assoc($result);
            $current_count = $row['count'];

            
            $max_count = 7; 
            if ($position == "Barangay Chairman" || $position == "Barangay Secretary" || $position == "Barangay Treasurer" || $position == "SK Chairman") {
                $max_count = 1;
            }

            if ($current_count < $max_count) {
                
                $query = "INSERT INTO brgy_info (staff_fname, staff_mname, staff_lname, staff_suffix, staff_zone, staff_brgy, staff_city, staff_province, staff_age, staff_bdate, staff_cstatus, staff_citizenship, staff_sex, staff_educ, staff_contact, staff_email, staff_position, staff_username, staff_password, staff_fruit, staff_animal) 
                      VALUES ('$fname', '$mname', '$lname', '$suffix', '$purok', '$brgy', '$city', '$prov', '$age', '$bdate', '$cstatus', '$citizen', '$sex', '$educ', '$contact', '$email', '$position', '$username', '$password', '$fruit', '$animal')";

                if (mysqli_query($con, $query)) {
                    $_SESSION['notification'] = "Registration successful!";
                    $_SESSION['notification_type'] = "success";
                } else {
                    $_SESSION['notification'] = "Error: " . $query . "<br>" . mysqli_error($con);
                    $_SESSION['notification_type'] = "error";
                }
            } else {
                $_SESSION['notification'] = "Maximum limit for $position reached. Please try again later.";
                $_SESSION['notification_type'] = "error";
                header("Location: register.php"); 
                exit();
                
            }
        } else {
            
            $query = "INSERT INTO resident_info (resi_fname, resi_mname, resi_lname, resi_suffix, resi_zone, resi_brgy, resi_city, resi_province, resi_age, resi_bdate, resi_cstatus, resi_citizenship, resi_sex, resi_educ, resi_contact, resi_email, resi_username, resi_password, resi_fruit, resi_animal) 
                      VALUES ('$fname', '$mname', '$lname', '$suffix', '$purok', '$brgy', '$city', '$prov', '$age', '$bdate', '$cstatus', '$citizen', '$sex', '$educ', '$contact', '$email', '$username', '$password', '$fruit', '$animal')";

            if (mysqli_query($con, $query)) {
                $_SESSION['notification'] = "Registration successful!";
                $_SESSION['notification_type'] = "success";
            } else {
                $_SESSION['notification'] = "Error: " . $query . "<br>" . mysqli_error($con);
                $_SESSION['notification_type'] = "error";
            }
        }
    } else {
        $_SESSION['notification'] = "Please input all required fields.";
        $_SESSION['notification_type'] = "error";
    }
    
    echo '<script>
            setTimeout(function() {
                window.location.href = "loginResponsive.php";
            }, 2000); // 3 seconds delay
          </script>';
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
    <link rel="stylesheet" href="register.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }
        .regForm {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f0f0f0;
        }
        #content {
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            max-height: 100vh;
            overflow-y: auto;
            margin-right: 0px;
            padding-bottom: 40px;
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
        .form-group {
            margin-bottom: 1rem;
        }
        .form-check-inline {
            margin-right: 10px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .buttonContainer {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }
        .text-danger{
            color: red;
        }
    </style>
</head>

<body>
    <section class="regForm">
    <div class="containerTitle-Logo">
                <div class="logo-container">
                    <img src="icons/Legazpi-LOGO.png" alt="legazpi logo" class="img-fluid mb-2">
                    <img src="icons/BRGY LOGO.png" alt="tamaoyan logo" class="img-fluid mb-2">
                </div>
                <div class="titleText">
                    <p>Barangay<br>Monitoring<br>System</p>
                </div>
            </div>
        <div id="content">
            <h2>Register</h2>
            <?php
                // Check if there is any notification message set
                if (isset($_SESSION['notification'])) {
                    $notification_type = isset($_SESSION['notification_type']) ? $_SESSION['notification_type'] : 'error';
                    echo "<div class='notification $notification_type'>{$_SESSION['notification']}</div>";
                    unset($_SESSION['notification']);
                    unset($_SESSION['notification_type']);
                }
            ?>
            <div id="container">
                <form id="regiForm" method="POST" class="forms">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="fname" placeholder="Enter First Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="mname" placeholder="Enter Middle Name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="lname" placeholder="Enter Last Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control" id="suffix_name" name="suffix" placeholder="Enter Suffix">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="purok">Purok</label>
                                <select class="form-control" id="purok" name="purok" placeholder="Select your purok" required>
                                    <option value="" disabled selected>Select your purok</option>
                                    <option value="Purok 1">Purok 1</option>
                                    <option value="Purok 2">Purok 2</option>
                                    <option value="Purok 3">Purok 3</option>
                                    <option value="Purok 4">Purok 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="barangay">Barangay</label>
                                <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Enter Barangay" value="Tamaoyan" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="Legazpi City" placeholder="Enter City" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province" value="Albay" placeholder="Enter Province" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" onchange="calculateAge()" required>
                                <p id="birthday-error" class="text-danger" style="position: absolute; font-size: 13px;"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="civil_status">Civil Status</label>
                                <select class="form-control" id="status" name="cstatus" placeholder="Select Civil Status" required>
                                    <option value="" disabled selected>Select your civil status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Annulled">Annulled</option>
                                    <option value="LiveIn">Live-in</option>
                                    <option value="Unknown">Unknown</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="citizenship">Citizenship</label>
                                <input type="text" class="form-control" id="citizenship" name="citizenship" value="Filipino" placeholder="Enter Citizenship" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <div class="row">
                                    <div class="col">
                                        <div id="radioBtn" class="radioBtn">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sex" id="male" value="Male" required>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sex" id="female" value="Female" required>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="education">Educational Attainment</label>
                                <select class="form-control" id="education" name="educ" placeholder="Select your educational attainment" required>
                                    <option value="" disabled selected>Select your educational attainment</option>
                                    <option value="No Education">No Formal education</option>
                                    <option value="Primary Level">Primary Level</option>
                                    <option value="Primary Education">Primary Education</option>
                                    <option value="Secondary Education">Secondary Education</option>
                                    <option value="Vocational Level">Vocational Level</option>
                                    <option value="Vocational Education">Vocational Education</option>
                                    <option value="College Level">College Level</option>
                                    <option value="College Education">College Education</option>
                                    <option value="Master Level">Master Level</option>
                                    <option value="Master Education">Master Education</option>
                                    <option value="Doctorate Level">Doctorate Level</option>
                                    <option value="Doctorate Education">Doctorate Education</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="number" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number" required>
                                <p id="contact-number-error" class="text-danger" style="position: absolute; font-size: 13px;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required>
                            </div>                                
                        </div>
                        <div class="container-userType" style="margin-left: 30%;">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col">
                                            <div id="userTypeRadioBtn" class="userTypeRadioBtn" style="padding-bottom: 50px;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="userType" id="barangayCouncil" value="barangay-council" required>
                                                    <label class="form-check-label" for="barangay-council">Barangay Council</label>
                                                    <div id="positionField" style="display:none; position:absolute;">
                                                        <label for="position" style="font-size: 13px;">Position:</label>
                                                        <select id="position" name="position" required>
                                                            <option value="" disabled selected>Select position</option>
                                                            <option value="SK Chairman">SK Chairman</option>
                                                            <option value="Barangay Chairman">Barangay Chairman</option>
                                                            <option value="Barangay Secretary">Barangay Secretary</option>
                                                            <option value="Barangay Treasurer">Barangay Treasurer</option>
                                                            <option value="Barangay Kagawad">Barangay Kagawad</option>
                                                        </select><br><br>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="userType" id="resident" value="resident" required>
                                                    <label class="form-check-label" for="resident">Resident</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                                <p id="username-error" class="text-danger" style="position: absolute; font-size: 13px;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                <p id="password-error" class="text-danger" style="position: absolute; font-size: 13px;"></p>
                            </div>                                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Reenter Password">
                                <p id="confirmpass-error" class="text-danger" style="position: absolute; font-size: 13px;"></p>
                            </div>                                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="securityPrompt">
                                <p>In case you forgot your password, here are your security questions to regain access to your account.</p>
                            </div>                                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="fruit">What is your favorite fruit?</label>
                                <input type="text" class="form-control" id="fruit" name="fruit" placeholder="Enter your favorite fruit">
                            </div>                                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="animal">What is your favorite animal?</label>
                                <input type="text" class="form-control" id="animal" name="animal" placeholder="Enter your favorite animal">
                            </div>                                
                        </div>
                    </div>
                    <div class="button-container">
                        <a href="./loginResponsive.php" class="btn-custom" id="cancel-btn">Cancel</a>
                        <button class="custom-btn" id="register-btn" type="submit" onclick="validateForm(event)">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
    var notification = document.querySelector('.notification');
    if (notification) {
        notification.style.display = 'block';

        setTimeout(function() {
            notification.style.display = 'none';
        }, 5000);
    }

    function calculateAge() {
        var birthdate = document.getElementById('birthday').value;
        var today = new Date();
        var dob = new Date(birthdate);
        var age = today.getFullYear() - dob.getFullYear();
        var m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        document.getElementById('age').value = age;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const userTypeRadios = document.getElementsByName('userType');
        const positionField = document.getElementById('positionField');
        const positionSelect = document.getElementById('position');

        userTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'barangay-council') {
                    positionField.style.display = 'block';
                    positionSelect.required = true;
                } else {
                    positionField.style.display = 'none';
                    positionSelect.required = false;
                }
            });
        });

        function validateForm(event) {
            let isValid = true;

            // Birthdate validation
            const birthdate = document.getElementById('birthday').value;
            const birthdateError = document.getElementById('birthday-error');
            const today = new Date().toISOString().split('T')[0];
            if (birthdate >= today) {
                birthdateError.textContent = 'Birthdate cannot be in the future.';
                isValid = false;
            } else {
                birthdateError.textContent = '';
            }

            // Username validation
            const username = document.getElementById('username').value;
            const usernameError = document.getElementById('username-error');
            if (username.length < 8 || username.length > 20) {
                usernameError.textContent = 'Username must be between 8 and 20 characters.';
                isValid = false;
            } else {
                usernameError.textContent = '';
            }

            // Password validation
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('password-error');
            if (password.length < 8 || password.length > 20) {
                passwordError.textContent = 'Password must be between 8 and 20 characters.';
                isValid = false;
            } else {
                passwordError.textContent = '';
            }

            // Confirm Password validation
            const confirmPassword = document.getElementById('confirm-password').value;
            const confirmPasswordError = document.getElementById('confirmpass-error');
            if (password !== confirmPassword) {
                confirmPasswordError.textContent = 'Passwords do not match.';
                isValid = false;
            } else {
                confirmPasswordError.textContent = '';
            }

            // Contact number validation
            const contactNumber = document.getElementById('contact_number').value;
            const contactNumberError = document.getElementById('contact-number-error');
            if (!/^\d{11}$/.test(contactNumber)) {
                contactNumberError.textContent = 'Contact number must be 11 digits.';
                isValid = false;
            } else {
                contactNumberError.textContent = '';
            }

            if (!isValid) {
                event.preventDefault();
            }
        }

        document.getElementById('regiForm').addEventListener('submit', validateForm);
        
        // Limit contact number input to 11 digits
        document.getElementById('contact_number').addEventListener('input', function() {
            let inputValue = this.value;
            // Trim the input to 11 digits
            inputValue = inputValue.slice(0, 11);
            this.value = inputValue;
        });
    });
</script>
</body>
</html>
