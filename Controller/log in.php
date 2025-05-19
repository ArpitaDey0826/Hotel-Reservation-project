<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkin = $_POST['checkin'] ?? '';
    $checkout = $_POST['checkout'] ?? '';
    $errors = [];

    if (empty($checkin) || empty($checkout)) {
        $errors[] = "Both check-in and check-out dates are required.";
    } else {
        $checkinDate = strtotime($checkin);
        $checkoutDate = strtotime($checkout);
        $today = strtotime(date('Y-m-d'));

        if (!$checkinDate || !$checkoutDate) {
            $errors[] = "Invalid date format.";
        } elseif ($checkinDate < $today) {
            $errors[] = "Check-in date cannot be in the past.";
        } elseif ($checkoutDate <= $checkinDate) {
            $errors[] = "Check-out must be after check-in.";
        }
    }

    $seasonalRates = [
        "low" => 100,
        "mid" => 150,
        "high" => 200
    ];

    function getSeason($month) {
        if (in_array($month, [6, 7, 8])) return "high";
        if (in_array($month, [3, 4, 5, 9])) return "mid";
        return "low";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        session_destroy(); 
    } else {
        $nights = 0;
        $total = 0;
        $breakdown = "";
        $current = $checkinDate;

        while ($current < $checkoutDate) {
            $nights++;
            $month = (int)date("n", $current);
            $season = getSeason($month);
            $rate = $seasonalRates[$season];
            $total += $rate;
            $breakdown .= "<li>" . date("D, M j, Y", $current) . ": $$rate ({$season} season)</li>";
            $current = strtotime("+1 day", $current);
        }

        $_SESSION['reservation'] = [
            'checkin' => $checkin,
            'checkout' => $checkout,
            'nights' => $nights,
            'total' => $total
        ];

        echo "<h2>Available Rooms</h2>";
        echo "<p>Check-in: $checkin</p>";
        echo "<p>Check-out: $checkout</p>";
        echo "<p>Nights: $nights</p>";
        echo "<p>Total Cost: $$total</p>";
        echo "<ul>$breakdown</ul>";
    }
}
?>
