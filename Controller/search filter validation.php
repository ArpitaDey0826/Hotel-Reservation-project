<?php

header('Content-Type: application/json');

function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$hotels = [
    ["name" => "Hotel A", "location" => "new york", "price" => 150, "rating" => 4],
    ["name" => "Hotel B", "location" => "los angeles", "price" => 200, "rating" => 3],
    ["name" => "Hotel C", "location" => "chicago", "price" => 100, "rating" => 2],
    ["name" => "Hotel D", "location" => "new york", "price" => 250, "rating" => 5],
    ["name" => "Hotel E", "location" => "los angeles", "price" => 180, "rating" => 4],
];

$search = isset($_GET['search']) ? clean_input($_GET['search']) : '';
$location = isset($_GET['location']) ? strtolower(clean_input($_GET['location'])) : 'all';
$price = isset($_GET['price']) ? intval($_GET['price']) : 500;
$rating = isset($_GET['rating']) ? intval($_GET['rating']) : 0;

$valid_locations = ['all', 'new york', 'los angeles', 'chicago'];
$errors = [];

if (!in_array($location, $valid_locations)) {
    $errors[] = "Invalid location selected.";
}
if ($price < 0 || $price > 500) {
    $errors[] = "Price must be between 0 and 500.";
}
if ($rating < 0 || $rating > 5) {
    $errors[] = "Rating must be between 0 and 5.";
}

if (!empty($errors)) {
    echo json_encode([
        "success" => false,
        "errors" => $errors
    ]);
    exit;
}

$filtered = array_filter($hotels, function ($hotel) use ($search, $location, $price, $rating) {
    if ($location !== 'all' && $hotel['location'] !== $location) return false;
    if ($hotel['price'] > $price) return false;
    if ($rating > 0 && $hotel['rating'] < $rating) return false;
    if (!empty($search) && stripos($hotel['name'], $search) === false) return false;
    return true;
});

echo json_encode([
    "success" => true,
    "results" => array_values($filtered)
]);
?>
