<?php

function check_login($con){
    if(isset($_SESSION['resident_id'])){
        $id = $_SESSION['resident_id'];
        $query = "SELECT * FROM resident_info WHERE resident_id = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    } elseif(isset($_SESSION['staff_id'])) {
        $id = $_SESSION['staff_id'];
        $query = "SELECT * FROM brgy_info WHERE staff_id = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    header("Location: ../loginResponsive.php");
    exit;
}


?>