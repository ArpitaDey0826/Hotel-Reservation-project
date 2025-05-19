<?php

$rooms = [
    [
        'name' => 'Standard',
        'image' => 'https://example.com/standard-room.jpg',
        'description' => 'Single bed, en-suite bathroom, TV, and free Wi-Fi',
        'amenities' => ['wi-fi' => true, 'tv' => true, 'en-suite-bathroom' => true],
        'modal_id' => 'standardRoomModal',
        'tour_url' => 'https://www.example.com/standard-room-360-tour',
    ],
    [
        'name' => 'Deluxe',
        'image' => 'https://example.com/deluxe-room.jpg',
        'description' => 'Double bed, en-suite bathroom, TV, and free Wi-Fi',
        'amenities' => ['wi-fi' => true, 'tv' => true, 'en-suite-bathroom' => true],
        'modal_id' => 'deluxeRoomModal',
        'tour_url' => 'https://www.example.com/deluxe-room-360-tour',
    ],
    [
        'name' => 'Suite',
        'image' => 'https://example.com/suite-room.jpg',
        'description' => 'King-size bed, en-suite bathroom, TV, and free Wi-Fi',
        'amenities' => ['wi-fi' => true, 'tv' => true, 'en-suite-bathroom' => true],
        'modal_id' => 'suiteRoomModal',
        'tour_url' => 'https://www.example.com/suite-room-360-tour',
    ],
];

$filterWiFi = isset($_GET['wi-fi']);
$filterTV = isset($_GET['tv']);
$filterEnSuite = isset($_GET['en-suite-bathroom']);

function roomMatchesFilters($room, $filterWiFi, $filterTV, $filterEnSuite) {
    if ($filterWiFi && empty($room['amenities']['wi-fi'])) {
        return false;
    }
    if ($filterTV && empty($room['amenities']['tv'])) {
        return false;
    }
    if ($filterEnSuite && empty($room['amenities']['en-suite-bathroom'])) {
        return false;
    }
    return true;
}

$filteredRooms = array_filter($rooms, function($room) use ($filterWiFi, $filterTV, $filterEnSuite) {
    return roomMatchesFilters($room, $filterWiFi, $filterTV, $filterEnSuite);
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel Reservation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .room-gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
        }
        .room-category {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .room-category img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form label {
            margin-right: 10px;
        }
        .filter-form input[type="checkbox"] {
            margin-right: 10px;
        }
        .compare-amenities {
            margin-top: 20px;
        }
        .compare-amenities table {
            border-collapse: collapse;
            width: 100%;
        }
        .compare-amenities th, .compare-amenities td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Hotel Reservation</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#room-types">Room Types</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="room-types" class="container mt-4">
        <h1>Room Types</h1>
        <form class="filter-form" method="get" action="">
            <label>Filter by amenities:</label>
            <input type="checkbox" id="wi-fi" name="wi-fi" <?= $filterWiFi ? 'checked' : '' ?> />
            <label for="wi-fi">Wi-Fi</label>
            <input type="checkbox" id="tv" name="tv" <?= $filterTV ? 'checked' : '' ?> />
            <label for="tv">TV</label>
            <input type="checkbox" id="en-suite-bathroom" name="en-suite-bathroom" <?= $filterEnSuite ? 'checked' : '' ?> />
            <label for="en-suite-bathroom">En-suite bathroom</label>
            <button type="submit" class="btn btn-primary btn-sm ml-2">Filter</button>
        </form>

        <div class="room-gallery">
            <?php if (count($filteredRooms) === 0): ?>
                <p>No rooms match your filter criteria.</p>
            <?php else: ?>
                <?php foreach ($filteredRooms as $room): ?>
                    <div class="room-category" 
                         data-wi-fi="<?= $room['amenities']['wi-fi'] ? 'true' : 'false' ?>" 
                         data-tv="<?= $room['amenities']['tv'] ? 'true' : 'false' ?>" 
                         data-en-suite-bathroom="<?= $room['amenities']['en-suite-bathroom'] ? 'true' : 'false' ?>">
                        <img src="<?= htmlspecialchars($room['image']) ?>" alt="<?= htmlspecialchars($room['name']) ?> Room" />
                        <h2><?= htmlspecialchars($room['name']) ?></h2>
                        <p><?= htmlspecialchars($room['description']) ?></p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#<?= $room['modal_id'] ?>">View 360° Tour</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Modals -->
        <?php foreach ($rooms as $room): ?>
        <div class="modal fade" id="<?= $room['modal_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $room['modal_id'] ?>Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?= $room['modal_id'] ?>Label"><?= htmlspecialchars($room['name']) ?> Room 360° Tour</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe src="<?= htmlspecialchars($room['tour_url']) ?>" frameborder="0" width="100%" height="500"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="compare-amenities mt-5">
            <h2>Compare Amenities</h2>
            <table>
                <tr>
                    <th>Room Type</th>
                    <th>Wi-Fi</th>
                    <th>TV</th>
                    <th>En-suite Bathroom</th>
                </tr>
                <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= htmlspecialchars($room['name']) ?></td>
                    <td><?= $room['amenities']['wi-fi'] ? '&#10003;' : '&#10007;' ?></td>
                    <td><?= $room['amenities']['tv'] ? '&#10003;' : '&#10007;' ?></td>
                    <td><?= $room['amenities']['en-suite-bathroom'] ? '&#10003;' : '&#10007;' ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
