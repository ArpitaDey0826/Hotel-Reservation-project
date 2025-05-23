<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f4;
    }
    header, footer {
      background: #333;
      color: #fff;
      padding: 1em;
      text-align: center;
    }
    main {
      padding: 2em;
    }
    .button-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 1.5em;
      margin-top: 2em;
    }
    .button-grid a {
      display: block;
      padding: 1em;
      background: #007bff;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s ease;
    }
    .button-grid a:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <header>
    <h1>User Dashboard</h1>
  </header>

  <main>
    <div class="button-grid">
      <a href="profile.php">Profile</a>
      <a href="search.php">Search</a>
      <a href="contact.php">Contact Us</a>
      <a href="export.php">Export Data</a>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Your Website. All rights reserved.</p>
  </footer>
</body>
</html>
