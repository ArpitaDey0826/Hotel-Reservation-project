<?php
session_start();


$users = [
    'Alice' => 'Editor',
    'Bob' => 'User',
];

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'User'; 
}

if (isset($_POST['set_role'])) {
    $selectedRole = $_POST['role'] ?? 'User';
    $_SESSION['role'] = $selectedRole;
}

if (isset($_POST['assign_roles']) && $_SESSION['role'] === 'Admin') {
    foreach ($users as $username => $role) {
        if (isset($_POST['role_' . $username])) {
            $users[$username] = $_POST['role_' . $username];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Reservation - Role Access</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Hotel Reservation - Role Access Control</h1>

 
    <form method="POST" action="">
      <label for="role">Simulate Logged-in Role:</label>
      <select name="role" id="role" onchange="this.form.submit()">
        <option value="Admin" <?php if ($_SESSION['role'] === 'Admin') echo 'selected'; ?>>Admin</option>
        <option value="Editor" <?php if ($_SESSION['role'] === 'Editor') echo 'selected'; ?>>Editor</option>
        <option value="User" <?php if ($_SESSION['role'] === 'User') echo 'selected'; ?>>User</option>
      </select>
      <input type="hidden" name="set_role" value="1" />
    </form>

    <nav id="navigation">
      <ul>
        <?php if ($_SESSION['role'] === 'Admin'): ?>
          <li>Permission Settings</li>
          <li>Role Assignment</li>
        <?php endif; ?>

        <?php if ($_SESSION['role'] === 'Editor' || $_SESSION['role'] === 'Admin'): ?>
          <li>Edit Bookings</li>
        <?php endif; ?>

        <?php if ($_SESSION['role'] === 'User' || $_SESSION['role'] === 'Editor' || $_SESSION['role'] === 'Admin'): ?>
          <li>View Bookings</li>
          <li>Profile</li>
        <?php endif; ?>
      </ul>
    </nav>

    <?php if ($_SESSION['role'] === 'Admin'): ?>
      <div class="admin-panel" id="admin-panel">
        <h2>Admin Panel - Assign Roles</h2>
        <form method="POST" action="">
          <table>
            <tr><th>Username</th><th>Current Role</th><th>Assign New Role</th></tr>
            <?php foreach ($users as $username => $role): ?>
              <tr>
                <td><?php echo htmlspecialchars($username); ?></td>
                <td><?php echo htmlspecialchars($role); ?></td>
                <td>
                  <select name="role_<?php echo htmlspecialchars($username); ?>">
                    <option value="Admin" <?php if ($role === 'Admin') echo 'selected'; ?>>Admin</option>
                    <option value="Editor" <?php if ($role === 'Editor') echo 'selected'; ?>>Editor</option>
                    <option value="User" <?php if ($role === 'User') echo 'selected'; ?>>User</option>
                  </select>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
          <button type="submit" name="assign_roles">Update Roles</button>
        </form>
      </div>
    <?php endif; ?>

  </div>
</body>
</html>
