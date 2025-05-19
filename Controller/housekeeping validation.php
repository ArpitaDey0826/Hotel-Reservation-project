<?php
$errors = [];
$room_number = '';
$issue_description = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $room_number = trim($_POST['room_number'] ?? '');
    $issue_description = trim($_POST['issue_description'] ?? '');

    
    if (empty($room_number)) {
        $errors['room_number'] = "Room number is required.";
    } elseif (!is_numeric($room_number)) {
        $errors['room_number'] = "Room number must be a number.";
    }

    if (empty($issue_description)) {
        $errors['issue_description'] = "Issue description is required.";
    } elseif (strlen($issue_description) < 5) {
        $errors['issue_description'] = "Issue description must be at least 5 characters.";
    }


    if (empty($errors)) {
        $success_message = "Issue reported successfully for Room " . htmlspecialchars($room_number) . ".";
      
        $room_number = '';
        $issue_description = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Report Issue - Housekeeping</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
<style>
    .error { color: red; font-size: 0.9em; }
</style>
</head>
<body>
<div class="container mt-5">
    <h2>Report Issue</h2>

    <?php if ($success_message): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="room_number">Room Number:</label>
            <input type="text" id="room_number" name="room_number" class="form-control" value="<?php echo htmlspecialchars($room_number); ?>">
            <?php if (!empty($errors['room_number'])): ?>
                <small class="error"><?php echo $errors['room_number']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="issue_description">Issue Description:</label>
            <textarea id="issue_description" name="issue_description" class="form-control" rows="4"><?php echo htmlspecialchars($issue_description); ?></textarea>
            <?php if (!empty($errors['issue_description'])): ?>
                <small class="error"><?php echo $errors['issue_description']; ?></small>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit Issue</button>
    </form>
</div>
</body>
</html>
