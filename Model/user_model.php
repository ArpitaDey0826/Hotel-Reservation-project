<?php
require_once 'db.php';

function loginUser($email, $password) {
    $con = getConnection();
    $sql = "SELECT * FROM signup WHERE s_email = '$email' AND s_password = '$password'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    mysqli_close($con);
    return $count === 1;  
}


function registerUser($email, $password) {
    $con = getConnection();
    $checkSql = "SELECT * FROM signup WHERE s_email = '$email'";
    $checkResult = mysqli_query($con, $checkSql);
    if (mysqli_num_rows($checkResult) > 0) {
        mysqli_close($con);
        return "exists";
    }
    $sql = "INSERT INTO signup (s_email, s_password) VALUES ('$email', '$password')";
    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        return "success";
    } else {
        mysqli_close($con);
        return "DB error";
    }
}

function insertConciergeRequest( $service, $request_details, $booking_id) {
    $con = getConnection();
    $sql = "INSERT INTO conciergerequest ( service_experience, additional_details, booking_name) VALUES ('$service', '$request_details', '$booking_id')";
    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        return "success";
    } else {
        mysqli_close($con);
        return "DB error";
    }
}

function insertReview($rating, $comment, $traveler_type) {
    $con = getConnection();
    $sql = "INSERT INTO reviewsystem (star_rating, r_comment, traveler_type) VALUES ('$rating', '$comment', '$traveler_type')";
    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        return "success";
    } else {
        mysqli_close($con);
        return "DB error";
    }
}

function insertBillingSummary($booking_id, $email, $split_count, $amount, $method, $payer) {
    $con = getConnection();

    $sql = "INSERT INTO billingsummery (booking_id, email_receipt, split_number, split_amount, split_method, payer_name)
            VALUES ('$booking_id', '$email', $split_count, $amount, '$method', '$payer')";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        return "success";
    } else {
        $error = mysqli_error($con);
        mysqli_close($con);
        return "DB error: $error";
    }
}




function insertRoomBooking($guest_name, $room_type, $check_in_date, $check_out_date, $rate_type) {
    $con = getConnection();
    $sql = "INSERT INTO bookroom (guest_name, room_type, check_in_date, check_out_date, rate_type) 
            VALUES ('$guest_name', '$room_type', '$check_in_date', '$check_out_date', '$rate_type')";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        return "success";
    } else {
        $error = mysqli_error($con);
        mysqli_close($con);
        return "DB error: $error";  
    }
}



function insertGroupBooking($group_name, $contact_email, $room_number, $check_in, $check_out, $payment_terms, $event_space) {
    $con = getConnection();

    $sql = "INSERT INTO groupbookroom (group_name, group_booking_email, group_room_number , check_in_date, check_out_date, payment_term, event_space) 
            VALUES ('$group_name', '$contact_email', '$room_number', '$check_in', '$check_out', '$payment_terms', '$event_space')";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        return "success";
    } else {
        $error = mysqli_error($con);
        mysqli_close($con);
        return "DB error: $error";
    }
}

function searchRoomBookings($query) {
    $con = getConnection(); 

    $safeQuery = mysqli_real_escape_string($con, $query);

    $sql = "SELECT * FROM room_bookings WHERE guest_name LIKE '%$safeQuery%'";
    $result = mysqli_query($con, $sql);

    $filtered = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $filtered[] = $row;
        }
    }

    mysqli_close($con);
    return $filtered;
}

function getRoomBookings() {
    $con = getConnection();
    $sql = "SELECT * FROM bookroom";
    $result = mysqli_query($con, $sql);
    $bookings = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($con);
    return $bookings;
}

function getGroupBookings() {
    $con = getConnection();
    $sql = "SELECT * FROM groupbookroom";
    $result = mysqli_query($con, $sql);
    $groupBookings = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $groupBookings[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($con);
    return $groupBookings;
}

function getBillingSummaries() {
    $con = getConnection();
    $sql = "SELECT * FROM billingsummery";
    $result = mysqli_query($con, $sql);
    $billingSummaries = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $billingSummaries[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($con);
    return $billingSummaries;
}
?>