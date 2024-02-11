<?php


// Start session
session_start();

// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to redirect to login if not logged in
function redirectToLogin() {
    if (!isLoggedIn()) {
        header('Location: index.php');
        exit();
    }
}

// Function to set user session data
function setUserSession($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    // Add other user-related session data as needed
}




?>