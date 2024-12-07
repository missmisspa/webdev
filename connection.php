<?php
    $host = 'blv.h.filess.io';
    $database = 'brgyMonitoringSystem_finallyraw';
    $user = 'brgyMonitoringSystem_finallyraw';
    $port = 3307;
    $password = 'password';

    // Create connection
    $con = new mysqli($host, $user, $password, $database, $port);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

?>