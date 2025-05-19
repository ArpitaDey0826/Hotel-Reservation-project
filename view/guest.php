<?php
session_start();

if (!isset($_SESSION['preferences'])) {
    $_SESSION['preferences'] = [
        'room_preference' => '',
        'special_requests' => '',
        'allergies' => '',
        'accessibility' => ''
    ];
}

$success_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $_SESSION['preferences']['room_preference'] = htmlspecialchars($_POST['room_preference'] ?? '');
    $_SESSION['preferences']['special_requests'] = htmlspecialchars($_POST['special_requests'] ?? '');
    $_SESSION['preferences']['allergies'] = htmlspecialchars($_POST['allergies'] ?? '');
    $_SESSION['preferences']['accessibility'] = htmlspecialchars($_POST['accessibility'] ?? '');

    $success_message = 'Preferences saved successfully.';
}

$prefs = $_SESSION['preferences'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Guest Profiles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .guest-profiles-container {
            max-width: 800px;
            margin: 40px auto;
        }
        .preference-center {
            margin-top: 20px;
        }
        .stay-history {
            margin-top: 20px;
        }
        .loyalty-dashboard {
            margin-top: 20px;
        }
        .tab-content {
            padding: 20px;
        }
        .success-message {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="guest-profiles-container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="preference-center-tab" data-bs-toggle="tab" data-bs-target="#preference-center" type="button" role="tab" aria-controls="preference-center" aria-selected="true">Preference Center</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="stay-history-tab" data-bs-toggle="tab" data-bs-target="#stay-history" type="button" role="tab" aria-controls="stay-history" aria-selected="false">Stay History</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="loyalty-dashboard-tab" data-bs-toggle="tab" data-bs-target="#loyalty-dashboard" type="button" role="tab" aria-controls="loyalty-dashboard" aria-selected="false">Loyalty Dashboard</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="preference-center" role="tabpanel" aria-labelledby="preference-center-tab">
            <h2>Preference Center</h2>
            <?php if ($success_message): ?>
                <div class="success-message"><?= $success_message ?></div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="room-preference">Room Preference:</label>
                    <select class="form-control" id="room-preference" name="room_preference" required>
                        <option value="">Select Room Preference</option>
                        <option value="low-floor" <?= $prefs['room_preference'] === 'low-floor' ? 'selected' : '' ?>>Low Floor</option>
                        <option value="high-floor" <?= $prefs['room_preference'] === 'high-floor' ? 'selected' : '' ?>>High Floor</option>
                        <option value="city-view" <?= $prefs['room_preference'] === 'city-view' ? 'selected' : '' ?>>City View</option>
                        <option value="ocean-view" <?= $prefs['room_preference'] === 'ocean-view' ? 'selected' : '' ?>>Ocean View</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="special-requests">Special Requests:</label>
                    <textarea class="form-control" id="special-requests" name="special_requests" rows="3"><?= $prefs['special_requests'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="allergies">Allergies:</label>
                    <input type="text" class="form-control" id="allergies" name="allergies" value="<?= $prefs['allergies'] ?>" />
                </div>
                <div class="form-group">
                    <label for="accessibility">Accessibility Needs:</label>
                    <input type="text" class="form-control" id="accessibility" name="accessibility" value="<?= $prefs['accessibility'] ?>" />
                </div>
                <button type="submit" class="btn btn-primary">Save Preferences</button>
            </form>
        </div>
        <div class="tab-pane fade" id="stay-history" role="tabpanel" aria-labelledby="stay-history-tab">
            <h2>Stay History</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Stay Date</th>
                        <th>Room Type</th>
                        <th>Room Number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2022-01-01 - 2022-01-03</td>
                        <td>Standard</td>
                        <td>101</td>
                    </tr>
                    <tr>
                        <td>2022-02-01 - 2022-02-03</td>
                        <td>Deluxe</td>
                        <td>202</td>
                    </tr>
                    <tr>
                        <td>2022-03-01 - 2022-03-03</td>
                        <td>Suite</td>
                        <td>303</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="loyalty-dashboard" role="tabpanel" aria-labelledby="loyalty-dashboard-tab">
            <h2>Loyalty Dashboard</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Loyalty Points:</h3>
                    <p>100 points</p>
                </div>
                <div class="col-md-6">
                    <h3>Loyalty Benefits:</h3>
                    <ul>
                        <li>Free Breakfast</li>
                        <li>Room Upgrade</li>
                        <li>Late Check-out</li>
                    </ul>
                </div>
            </div>
            <button type="button" class="btn btn-primary">Redeem Points</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTab button').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
</body>
</html>
