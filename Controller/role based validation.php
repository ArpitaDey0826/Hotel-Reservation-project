<?php
session_start();

$users = [
    'Alice' => 'Editor',
    'Bob' => 'User',
];


if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'User';
}

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['set_role'])) {
        $role = $_POST['role'] ?? '';
        $validRoles = ['Admin', 'Editor', 'User'];
        if (in_array($role, $validRoles)) {
            $_SESSION['role'] = $role;
            $success = "Role changed to $role.";
        } else {
            $errors[] = "Invalid role selected.";
        }
    }

    if (isset($_POST['assign_roles']) && $_SESSION['role'] === 'Admin') {
        foreach ($users as $username => $currentRole) {
            $fieldName = 'role_' . $username;
            if (isset($_POST[$fieldName])) {
                $newRole = $_POST[$fieldName];
                if (in_array($newRole, ['Admin', 'Editor', 'User'])) {
                    $users[$username] = $newRole; 
                } else {
                    $errors[] = "Invalid role for user $username.";
                }
            }
        }
        if (empty($errors)) {
            $success = "Roles updated successfully.";
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
</head>
<body>
  <div class="container">
    <h1>Hotel Reservation - Role Access Control</h1>

    <?php if (!empty($errors)): ?>
      <div style="color:red;">
        <ul>
          <?php foreach ($errors as $error) echo "<li>" . htmlspecialchars($error) . "</li>"; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div style="color:green;"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

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

        <?php if (in_array($_SESSION['role'], ['Admin', 'Editor'])): ?>
          <li>Edit Bookings</li>
        <?php endif; ?>

        <li>View Bookings</li>
        <li>Profile</li>
      </ul>
    </nav>

    <?php if ($_SESSION['role'] === 'Admin'): ?>
      <div class="admin-panel" id="admin-panel">
        <h2>Admin Panel - Assign Roles</h2>
        <form method="POST" action="">
          <table border="1" cellpadding="5" cellspacing="0">
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
