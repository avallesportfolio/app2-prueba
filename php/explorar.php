<?php
include 'db_connect.php';

$location = $_POST['location'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$guests = $_POST['guests'];

$response = array();

$sql = "SELECT * FROM properties WHERE city LIKE '%$location%' AND id NOT IN (
            SELECT property_id FROM reservations WHERE (start_date <= '$end_date' AND end_date >= '$start_date')
        )";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $properties = array();
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row;
    }
    $response['status'] = 'success';
    $response['data'] = $properties;
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se encontraron alojamientos disponibles para los criterios de búsqueda especificados.';
}

$conn->close();

echo json_encode($response);
?>
