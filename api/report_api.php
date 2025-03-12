<?php
header("Content-Type: application/json");
include '../db.php';

// --- QUERY FOR TRAFFIC CHOROPLETH MAP

$query = "SELECT 
            UPPER(a.airport_country) AS country,
            COALESCE( departure_count, 0) AS  departure_count,
            COALESCE(arrival_count, 0) AS arrival_count
        FROM airport a
        LEFT JOIN (
            SELECT 
                ap.airport_country,
                COUNT(f.depart_AirportCode) AS  departure_count
            FROM flight f
            JOIN airport ap ON f.depart_AirportCode = ap.airportCode
            GROUP BY ap.airport_country
        ) dep ON a.airport_country = dep.airport_country
        LEFT JOIN (
            SELECT 
                ap.airport_country,
                COUNT(f.arrive_AirportCode) AS arrival_count
            FROM flight f
            JOIN airport ap ON f.arrive_AirportCode = ap.airportCode
            GROUP BY ap.airport_country
        ) arr ON a.airport_country = arr.airport_country
        GROUP BY a.airport_country
        ORDER BY ( departure_count + arrival_count) DESC;";

$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data['flight_traffic'][] = $row;
}

// --- QUERY FOR TODAY BOOKING

$query = "SELECT COUNT(*) AS today_booking FROM booking WHERE DATE(bookingDate) = DATE(now())";
$result = $conn->query($query);

$data['today_booking'] = $result->fetch_assoc()['today_booking'];

// --- QUERY FOR TODAY RAVENUE

// ----- nothing yet

// --- QUERY FOR TODAY MEMBER

$query = "SELECT COUNT(*) AS new_member FROM `user` WHERE DATE(register_Date) = DATE(now())";
$result = $conn->query($query);

$data['new_member'] = $result->fetch_assoc()['new_member'];

// --- QUERY FOR RESEVED/UNRESERVED SEATS

$query = "SELECT reserved, COUNT(*) AS seat_count FROM seat GROUP BY reserved;";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $data['seat_reservation'][] = $row;
}

// --- QUERY FOR BOOKING TREND

$query = "SELECT DATE(bookingDate) AS `date`, COUNT(*) AS booking_count 
        FROM booking 
        WHERE MONTH(bookingDate) = MONTH(NOW()) 
        GROUP BY DATE(bookingDate) 
        ORDER BY DATE(bookingDate);";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $data['booking_monthly'][] = $row;
}

// --- QUERY FOR POPULAR ROUTES
$query = "SELECT depart_airportCode, arrive_airportCode, COUNT(*) AS flight_count
        FROM flight
        GROUP BY depart_AirportCode, arrive_AirportCode
        ORDER BY flight_count DESC
        LIMIT 5;";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $data['top_routes'][] = $row;
}

echo json_encode($data);
?>
