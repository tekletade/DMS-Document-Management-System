<!--
		Developer: Tekletsadik Tadesse
        Mobile : +251967267539
        Address : Addiss Ababa, Ethiopia
		-->
<?php
    //session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['id'])) {
            // Redirect to the login page or display an appropriate message
            header("Location: ../auth-sign-in");
            exit();
        }

        // Check if the session has exceeded the 10-minute limit
        $session_timeout = 600; // 10 minutes in seconds
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $session_timeout)) {
            // Session has expired; logout the user
            session_unset();
            session_destroy();
            header("Location: ../auth-sign-in");
            exit();
    }
    // Update the last activity time
    $_SESSION['LAST_ACTIVITY'] = time();

?>
