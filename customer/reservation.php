<?php
    $nic      = $_POST["nic"];
    $name     = $_POST["name"];
    $number   = $_POST["number"];
    $start_date = $_POST["start_date"];
    $inTime   = $_POST["inTime"];
    $outTime  = $_POST["outTime"];
    $trainer  = $_POST["trainer"];
    $email    = $_POST["email"];

    $conn = new mysqli('localhost', 'root', '', 'gymx');
    if ($conn->connect_error) {
        die('Connection Failed  : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO reservations (nic,name,number,start_date,inTime,outTime,trainer,email)
            values(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $nic, $name, $number, $start_date, $inTime, $outTime, $trainer, $email);
        $query_result = $stmt->execute();
        
        if ($query_result) {
            // Query was successful, display success message
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '  swal("Success", "Reservation added successfully!", "success").then(function() {';
            echo '    window.location.href = "index.php";';
            echo '  });';
            echo '});';
            echo '</script>';
        } else {
            // Query failed, display error message
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '  swal("Error", "Failed to add reservation!", "error");';
            echo '});';
            echo '</script>';
        }
        
        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    
    }
?>
