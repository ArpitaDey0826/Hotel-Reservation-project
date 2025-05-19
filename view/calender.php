<?php

$rooms = [
    "Standard" => ["rate" => "$100", "available" => true],
    "Deluxe" => ["rate" => "$150", "available" => false],
    "Suite" => ["rate" => "$200", "available" => true],
];

$checkInDate = $_POST['check-in-date'] ?? '';
$checkOutDate = $_POST['check-out-date'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability Calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .calendar-container { max-width: 800px; margin: 40px auto; }
        .rate-viewer, .stay-duration-selector, .room-availability { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="calendar-container">
        <div id="calendar"></div>
    </div>

    <div class="rate-viewer">
        <h2>Rate Viewer</h2>
        <table class="table">
            <thead><tr><th>Room Type</th><th>Rate</th></tr></thead>
            <tbody>
                <?php foreach ($rooms as $type => $info): ?>
                    <tr><td><?= $type ?></td><td><?= $info['rate'] ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="stay-duration-selector">
        <h2>Stay Duration Selector</h2>
        <form method="post">
            <input type="date" name="check-in-date" id="check-in-date" value="<?= $checkInDate ?>" required>
            <input type="date" name="check-out-date" id="check-out-date" value="<?= $checkOutDate ?>" required>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" id="extend-stay" class="btn btn-success">Extend Stay</button>
            <button type="button" id="shorten-stay" class="btn btn-danger">Shorten Stay</button>
        </form>
    </div>

    <div class="room-availability">
        <h2>Room Availability</h2>
        <table class="table">
            <thead><tr><th>Room Type</th><th>Availability</th></tr></thead>
            <tbody>
                <?php foreach ($rooms as $type => $info): ?>
                    <tr>
                        <td><?= $type ?></td>
                        <td><?= $info['available'] ? 'Available' : 'Not Available' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                start: 'title',
                end: 'today prev,next'
            },
            initialView: 'dayGridMonth',
            selectable: true,
            selectMirror: true,
            select: function(arg) {
                console.log('Selected range:', arg.startStr, 'to', arg.endStr);
            }
        });
        calendar.render();

        document.getElementById('extend-stay').addEventListener('click', function() {
            var checkOutInput = document.getElementById('check-out-date');
            var date = new Date(checkOutInput.value);
            date.setDate(date.getDate() + 1);
            checkOutInput.value
