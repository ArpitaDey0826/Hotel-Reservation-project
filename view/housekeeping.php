<?php

$rooms = [
    ['number' => 101, 'status' => 'available', 'last_cleaned' => '10:00 AM'],
    ['number' => 102, 'status' => 'occupied', 'last_cleaned' => '9:00 AM'],
    ['number' => 103, 'status' => 'cleaning', 'last_cleaned' => '8:00 AM'],
];

$maintenanceIssues = [
    ['room' => 101, 'issue' => 'Broken Light', 'status' => 'Pending'],
    ['room' => 102, 'issue' => 'Leaky Faucet', 'status' => 'In Progress'],
    ['room' => 103, 'issue' => 'No Issue', 'status' => 'Resolved'],
];

$reportSuccess = '';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['report_issue'])) {
    $reportedRoom = $_POST['room_number'] ?? '';
    $issueDescription = $_POST['issue_description'] ?? '';

    if ($reportedRoom && $issueDescription) {
        
        $reportSuccess = "Issue reported for room $reportedRoom.";
     
        $maintenanceIssues[] = [
            'room' => htmlspecialchars($reportedRoom),
            'issue' => htmlspecialchars($issueDescription),
            'status' => 'Pending',
        ];
    } else {
        $reportSuccess = "Please fill in both room number and issue description.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Housekeeping Status Screens</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .housekeeping-container {
            max-width: 1200px;
            margin: 40px auto;
        }
        .room-status-board {
            margin-top: 20px;
        }
        .maintenance-tracker {
            margin-top: 20px;
        }
        .turnover-alert {
            margin-top: 20px;
        }
        .tab-content {
            padding: 20px;
        }
        .report-issue-button {
            margin-bottom: 10px;
        }
        .room-card {
            margin-bottom: 10px;
        }
        .room-card .card-body {
            padding: 10px;
        }
        .room-card .card-title {
            font-size: 18px;
            font-weight: bold;
        }
        .room-card .card-text {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="housekeeping-container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="room-status-tab" data-toggle="tab" data-target="#room-status" type="button" role="tab" aria-controls="room-status" aria-selected="true">Room Status Board</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="maintenance-tracker-tab" data-toggle="tab" data-target="#maintenance-tracker" type="button" role="tab" aria-controls="maintenance-tracker" aria-selected="false">Maintenance Tracker</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="turnover-alert-tab" data-toggle="tab" data-target="#turnover-alert" type="button" role="tab" aria-controls="turnover-alert" aria-selected="false">Turnover Alert</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="room-status" role="tabpanel" aria-labelledby="room-status-tab">
            <h2>Room Status Board</h2>
            <div class="row" id="room-list">
                <?php foreach ($rooms as $room): ?>
                <div class="col-md-4">
                    <div class="room-card" data-status="<?php echo htmlspecialchars($room['status']); ?>">
                        <div class="card-body">
                            <h5 class="card-title">Room <?php echo $room['number']; ?></h5>
                            <p class="card-text">Status:
                                <?php
                                    $status = $room['status'];
                                    if ($status === 'available') {
                                        echo '<span class="text-success">Available</span>';
                                    } elseif ($status === 'occupied') {
                                        echo '<span class="text-danger">Occupied</span>';
                                    } elseif ($status === 'cleaning') {
                                        echo '<span class="text-warning">Cleaning</span>';
                                    } else {
                                        echo htmlspecialchars($status);
                                    }
                                ?>
                            </p>
                            <p class="card-text">Last Cleaned: <?php echo htmlspecialchars($room['last_cleaned']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="maintenance-tracker" role="tabpanel" aria-labelledby="maintenance-tracker-tab">
            <h2>Maintenance Tracker</h2>

            <div class="report-issue-button">
                <button class="btn btn-primary" data-toggle="modal" data-target="#report-issue-modal">Report Issue</button>
            </div>

            <?php if ($reportSuccess): ?>
                <div class="alert alert-info"><?php echo $reportSuccess; ?></div>
            <?php endif; ?>

            <table class="table">
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Issue</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($maintenanceIssues as $issue): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($issue['room']); ?></td>
                        <td><?php echo htmlspecialchars($issue['issue']); ?></td>
                        <td><?php echo htmlspecialchars($issue['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="turnover-alert" role="tabpanel" aria-labelledby="turnover-alert-tab">
            <h2>Turnover Alert</h2>
            <p>Room 101 is due for turnover in 30 minutes.</p>
            <button class="btn btn-primary">Start Turnover</button>
        </div>
    </div>
</div>

<!-- Report Issue Modal -->
<div class="modal fade" id="report-issue-modal" tabindex="-1" role="dialog" aria-labelledby="report-issue-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="report-issue-modal-label">Report Issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="report_issue" value="1" />
                <div class="form-group">
                    <label for="room-number">Room Number:</label>
                    <input type="text" class="form-control" id="room-number" name="room_number" placeholder="Enter room number" required />
                </div>
                <div class="form-group">
                    <label for="issue-description">Issue Description:</label>
                    <textarea class="form-control" id="issue-description" name="issue_description" placeholder="Enter issue description" required></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTab button').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
</body>
</html>
