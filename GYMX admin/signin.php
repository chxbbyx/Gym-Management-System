<?php

    $username = $_POST["name"];
    $password = $_POST["password"];

    $conn = new mysqli('localhost', 'root', '', 'gymx');

    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("SELECT * FROM users WHERE name=?");
        $stmt->bind_param("s", $name);
        $stmt->execute();

        }




    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get username and password from the form
        $name = $_POST["name"];
        $password = $_POST["password"];
        
        // Create a database connection
        $conn = new mysqli('localhost', 'root', '', 'gymx');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare a SQL query to fetch user data based on username
        $stmt = $conn->prepare("SELECT * FROM users WHERE name=?");
        $stmt->bind_param("s", $name);
        
        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['password']=== $password) {
                
                $_SESSION['name'] = $name;
                header("Location: http://localhost/chxbbyx/GYMX%20admin/dash.php");
                exit(); // Make sure to exit after redirection
            } else {
                //
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script>';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo '  swal("Error", "Invalid username and password", "error");';
                echo '});';
                echo '</script>';
            }
        } else {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script>';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo '  swal("Error", "connection error", "error");';
                echo '});';
                echo '</script>';
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
?>
