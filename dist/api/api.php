<?php
header("Content-Type: application/json");
include '../pages/db.php';

$table = isset($_GET['table']) ? $_GET['table'] : '';
$query = "SELECT COUNT(*) as total_records FROM `$table`";
$result = $conn->query($query);

$data = [];
if ($result) {
    $data['total_records'] = $result->fetch_assoc()['total_records'];
}

// Example aggregation: count grouped by a column (change `status` to your actual column)
$query = "SELECT `class`, COUNT(*) as count FROM `$table` GROUP BY `class`";
$result = $conn->query($query);

$groupedData = [];
while ($row = $result->fetch_assoc()) {
    $groupedData[] = $row;
}

$data['grouped_by_class'] = $groupedData;

echo json_encode($data);
?>