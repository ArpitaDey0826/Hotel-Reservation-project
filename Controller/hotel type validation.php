<?php

$roomPreference = $specialRequests = $allergies = $accessibility = "";
$roomPreferenceErr = $specialRequestsErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (empty($_POST["room_preference"])) {
        $roomPreferenceErr = "Room preference is required";
    } else {
        $roomPreference = test_input($_POST["room_preference"]);
    }

    if (!empty($_POST["special_requests"])) {
        $specialRequests = test_input($_POST["special_requests"]);
        if (strlen($specialRequests) > 500) {
            $specialRequestsErr = "Special requests cannot exceed 500 characters";
        }
    }

    if (!empty($_POST["allergies"])) {
        $allergies = test_input($_POST["allergies"]);
    }

    if (!empty($_POST["accessibility"])) {
        $accessibility = test_input($_POST["accessibility"]);
    }

    if (empty($roomPreferenceErr) && empty($specialRequestsErr)) {
        $successMsg = "Preferences saved successfully!";
        
    }
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Preference Center</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
</head>
<body>
<div class="container mt-5">
    <h2>Preference Center</h2>
    <?php if ($successMsg): ?>
        <div class="alert alert-success"><?php echo $successMsg; ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="room_preference">Room Preference:</label>
            <select class="form-control" id="room_preference" name="room_preference">
                <option value="">Select Room Preference</option>
                <option value="low-floor" <?php if ($roomPreference == "low-floor") echo "selected"; ?>>Low Floor</option>
                <option value="high-floor" <?php if ($roomPreference == "high-floor") echo "selected"; ?>>High Floor</option>
                <option value="city-view" <?php if ($roomPreference == "city-view") echo "selected"; ?>>City View</option>
                <option value="ocean-view" <?php if ($roomPreference == "ocean-view") echo "selected"; ?>>Ocean View</option>
            </select>
            <small class="text-danger"><?php echo $roomPreferenceErr; ?></small>
        </div>
        <div class="form-group">
            <label for="special_requests">Special Requests:</label>
            <textarea class="form-control" id="special_requests" name="special_requests" rows="3"><?php echo $specialRequests; ?></textarea>
            <small class="text-danger"><?php echo $specialRequestsErr; ?></small>
        </div>
        <div class="form-group">
            <label for="allergies">Allergies:</label>
            <input type="text" class="form-control" id="allergies" name="allergies" value="<?php echo $allergies; ?>" />
        </div>
        <div class="form-group">
            <label for="accessibility">Accessibility Needs:</label>
            <input type="text" class="form-control" id="accessibility" name="accessibility" value="<?php echo $accessibility; ?>" />
        </div>
        <button type="submit" class="btn btn-primary">Save Preferences</button>
    </form>
</div>
</body>
</html>
