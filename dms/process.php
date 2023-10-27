// process.php

<?php
// Include your database connection code here

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add_role') {
        $roleName = $_POST['role_name'];
        // Insert the role into the database
        // Example query: INSERT INTO roles (name) VALUES ('$roleName')
        // Execute the query

    } elseif ($action === 'add_permission') {
        $permissionName = $_POST['permission_name'];
        // Insert the permission into the database
        // Example query: INSERT INTO permissions (name) VALUES ('$permissionName')
        // Execute the query
    }
}

// Redirect back to the admin page
header("Location: admin.php");
