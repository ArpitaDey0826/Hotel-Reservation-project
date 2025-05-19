<?php

$hotels = [
    ['id' => 1, 'name' => 'Hotel A', 'location' => 'New York', 'price' => 150, 'rating' => 4],
    ['id' => 2, 'name' => 'Hotel B', 'location' => 'Los Angeles', 'price' => 200, 'rating' => 3],
    ['id' => 3, 'name' => 'Hotel C', 'location' => 'Chicago', 'price' => 100, 'rating' => 2],
    ['id' => 4, 'name' => 'Hotel D', 'location' => 'New York', 'price' => 250, 'rating' => 5],
    ['id' => 5, 'name' => 'Hotel E', 'location' => 'Los Angeles', 'price' => 180, 'rating' => 4],
];


$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$location = isset($_GET['location']) ? strtolower($_GET['location']) : 'all';
$price = isset($_GET['price']) ? intval($_GET['price']) : 500;
$rating = isset($_GET['rating']) ? intval($_GET['rating']) : 0;

$filtered = array_filter($hotels, function ($hotel) use ($search, $location, $price, $rating) {
    if ($location !== 'all' && strtolower($hotel['location']) !== $location) {
        return false;
    }
    if ($hotel['price'] > $price) {
        return false;
    }
    if ($rating !== 0 && $hotel['rating'] < $rating) {
        return false;
    }
    if ($search && strpos(strtolower($hotel['name']), $search) === false) {
        return false;
    }
    return true;
});

header('Content-Type: application/json');
echo json_encode(array_values($filtered));
