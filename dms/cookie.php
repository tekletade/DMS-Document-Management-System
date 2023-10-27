<!--
		Developer: Tekletsadik Tadesse
        Mobile : +251967267539
        Address : Addiss Ababa, Ethiopia
		-->

<?php
// Get all cookies sent by the client
$cookies = $_COOKIE;

// Iterate through the cookies and set their expiration time to the past
foreach ($cookies as $cookie_name => $cookie_value) {
    setcookie($cookie_name, '', time() - 3600, '/');
}

// Optionally, unset the cookies from the current request
foreach ($cookies as $cookie_name => $cookie_value) {
    unset($_COOKIE[$cookie_name]);
}

// Redirect to the login page or display a message
header("Location: ../index"); // Replace with the appropriate URL
exit();
?>
