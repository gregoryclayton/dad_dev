
<?php
session_start();

// Handle signout immediately - before any output
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signout'])) {
    // Clear all session data
    $_SESSION = array();
    
    // If a session cookie is used, destroy it
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destroy the session
    session_destroy();
    
    // Redirect to prevent form resubmission
    header("Location: v4.5.php");
    exit;
}
?>