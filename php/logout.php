<?php
session_start();
session_unset();
session_destroy();

$response = array();
$response['status'] = 'success';
$response['message'] = 'Sesión cerrada exitosamente.';

echo json_encode($response);
?>
