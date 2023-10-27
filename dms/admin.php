<!-- admin.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    
    <!-- Role Form -->
    <h2>Create/Edit Role</h2>
    <form action="process.php" method="post">
        <input type="hidden" name="action" value="add_role">
        <input type="text" name="role_name" placeholder="Role Name">
        <input type="submit" value="Create Role">
    </form>

    <!-- Permission Form -->
    <h2>Create/Edit Permission</h2>
    <form action="process.php" method="post">
        <input type="hidden" name="action" value="add_permission">
        <input type="text" name="permission_name" placeholder="Permission Name">
        <input type="submit" value="Create Permission">
    </form>

    <!-- List Roles and Permissions -->
    <h2>Roles</h2>
    <ul>
        <!-- Display existing roles fetched from the database -->
        <?php
            // Fetch roles from the database and display them
            // Example query: SELECT * FROM roles
            // Execute the query and loop through the results to display them here
        ?>
    </ul>

    <h2>Permissions</h2>
    <ul>
        <!-- Display existing permissions fetched from the database -->
        <?php
            // Fetch permissions from the database and display them
            // Example query: SELECT * FROM permissions
            // Execute the query and loop through the results to display them here
        ?>
    </ul>
</body>
</html>
