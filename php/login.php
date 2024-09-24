<?php
session_start();
include 'db_connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$response = array();

if (empty($email) || empty($password)) {
    $response['status'] = 'error';
    $response['message'] = 'Todos los campos son obligatorios.';
} else {
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $response['status'] = 'success';
            $response['message'] = 'Inicio de sesión exitoso.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Contraseña incorrecta.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'El correo electrónico no está registrado.';
    }
}

$conn->close();

echo json_encode($response);
?>
