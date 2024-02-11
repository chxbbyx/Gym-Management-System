<?php
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $acctype = isset($_POST["acctype"]) ? $_POST["acctype"] : '';

    $conn = new mysqli('localhost', 'root', '', 'gymx');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, acctype) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            // Handle the error, such as printing an error message or logging the error
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssss", $name, $email, $password, $acctype);
        $query_result = $stmt->execute();
        
        if ($query_result) {
            // Query was successful, display success message
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '  swal("Success", "Registered successfully!", "success").then(function() {';
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
