<?php
session_start();

$errors = [];
$success_message = '';
$prefs = [
    'room_preference' => '',
    'special_requests' => '',
    'allergies' => '',
    'accessibility' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (empty($_POST['room_preference'])) {
        $errors['room_preference'] = "Please select a room preference.";
    } else {
        $prefs['room_preference'] = htmlspecialchars($_POST['room_preference']);
    }

    $prefs['special_requests'] = htmlspecialchars($_POST['special_requests'] ?? '');
    $prefs['allergies'] = htmlspecialchars($_POST['allergies'] ?? '');
    $prefs['accessibility'] = htmlspecialchars($_POST['accessibility'] ?? '');

  
    if (empty($errors)) {
        $_SESSION['preferences'] = $prefs;
        $success_message = "Preferences saved successfully.";
    }
} else {
   
    if (isset($_SESSION['preferences'])) {
        $prefs = $_SESSION['preferences'];
    }
}
?>
