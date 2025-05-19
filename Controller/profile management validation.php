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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');

        if (empty($name)) {
            $profileErrors[] = "Name is required.";
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
            $passwordErrors[] = "New password and confirmation do not match.";
        }

        if (empty($passwordErrors)) {
   
            $user['password'] = $newPass;
            $passwordSuccess = "Password updated successfully.";
        }
    }
}
?>
