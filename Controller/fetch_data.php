<?php
header('Content-Type: application/json');
require_once '../Model/user_model.php';

try {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    $bookings = ($search === '') ? getRoomBookings() : searchRoomBookings($search);

    $data = [
        'bookings' => $bookings,
        'groupBookings' => getGroupBookings(),
        'billingSummaries' => getBillingSummaries()
    ];

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
?>
