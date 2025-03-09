<?php
header("Content-Type: application/json");
include '../db.php';

// --- QUERY FOR TRAFFIC CHOROPLETH MAP

$query = "SELECT UPPER(a.airport_country) AS country, COUNT(f.flightNum) AS departure_count, COUNT(f2.flightNum) AS arrival_count
        FROM airport a
        LEFT JOIN flight f ON a.airportCode = f.depart_airportCode
        LEFT JOIN flight f2 ON a.airportCode = f2.arrive_airportCode
        GROUP BY a.airport_country
        ORDER BY departure_count + arrival_count DESC;";

$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data['flight_traffic'][] = $row;
}

// --- QUERY FOR TODAY BOOKING

$query = "SELECT COUNT(*) AS today_booking FROM booking";
$result = $conn->query($query);

$data['today_booking'] = $result->fetch_assoc()['today_booking'];

// --- QUERY FOR TODAY RAVENUE

// ----- nothing yet

// --- QUERY FOR TODAY MEMBER

$query = "SELECT COUNT(*) AS new_member FROM `user`";
$result = $conn->query($query);

$data['new_member'] = $result->fetch_assoc()['new_member'];

echo json_encode($data);
?>