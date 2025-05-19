<?php
session_start();

$user = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '+1234567890',
    'address' => '123 Hotel St.',
    'password' => 'password123' 
];

$profileErrors = [];
$passwordErrors = [];
$profileSuccess = '';
$passwordSuccess = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update_profile'])) {
      
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');

        if (empty($name)) {
            $profileErrors[] = "Full Name is required.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $profileErrors[] = "Valid email is required.";
        }
     

        if (empty($profileErrors)) {
            
            $user['name'] = $name;
            $user['email'] = $email;
            $user['phone'] = $phone;
            $user['address'] = $address;
            $profileSuccess = "Profile updated successfully.";
        }
    } elseif (isset($_POST['update_password'])) {
       
        $currentPass = $_POST['current_pass'] ?? '';
        $newPass = $_POST['new_pass'] ?? '';
        $confirmPass = $_POST['confirm_pass'] ?? '';

        if ($currentPass !== $user['password']) { 
            $passwordErrors[] = "Current password is incorrect.";
        }
        if (empty($newPass)) {
            $passwordErrors[] = "New password cannot be empty.";
        }
        if ($newPass !== $confirmPass) {
            $passwordErrors[] = "New password and confirm password do not match.";
        }

        if (empty($passwordErrors)) {
           
            $user['password'] = $newPass;
            $passwordSuccess = "Password updated successfully.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Reservation - Profile</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="profile-container">
    <h1>My Profile</h1>

    <?php if ($profileErrors): ?>
        <div style="color:red;">
          <ul>
            <?php foreach ($profileErrors as $error) echo "<li>$error</li>"; ?>
          </ul>
        </div>
    <?php elseif ($profileSuccess): ?>
        <div style="color:green;"><?php echo $profileSuccess; ?></div>
    <?php endif; ?>

    <div class="profile-card">
      <div class="avatar-section">
        <img id="avatar" src="https://via.placeholder.com/150" alt="Profile Picture"/>
        <input type="file" id="avatar-upload" accept="image/*" hidden />
        <button onclick="document.getElementById('avatar-upload').click()">Change Avatar</button>
      </div>

      <div class="info-section">
        <form id="profile-form" method="POST" action="">
          <label>Full Name:</label>
          <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" />

          <label>Email:</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" />

          <label>Phone:</label>
          <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" />

          <label>Address:</label>
          <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" />

          <button type="submit" name="update_profile">Save Changes</button>
        </form>

        <form id="password-form" method="POST" action="">
          <h3>Change Password</h3>

          <?php if ($passwordErrors): ?>
              <div style="color:red;">
                <ul>
                  <?php foreach ($passwordErrors as $error) echo "<li>$error</li>"; ?>
                </ul>
              </div>
          <?php elseif ($passwordSuccess): ?>
              <div style="color:green;"><?php echo $passwordSuccess; ?></div>
          <?php endif; ?>

          <label>Current Password:</label>
          <input type="password" id="current-pass" name="current_pass" required />

          <label>New Password:</label>
          <input type="password" id="new-pass" name="new_pass" required />

          <label>Confirm Password:</label>
          <input type="password" id="confirm-pass" name="confirm_pass" required />

          <button type="submit" name="update_password">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
