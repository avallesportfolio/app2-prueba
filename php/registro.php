<?php
include 'db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$phone = $_POST['phone'];
$address = $_POST['address'];

$response = array();

if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($address)) {
    $response['status'] = 'error';
    $response['message'] = 'Todos los campos son obligatorios.';
} else {
    $sql_check = "SELECT * FROM users WHERE email='$email' OR phone='$phone'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $response['status'] = 'error';
        $response['message'] = 'El correo electrónico o el teléfono ya están registrados.';
    } else {
        $sql = "INSERT INTO users (name, email, password, phone, address) VALUES ('$name', '$email', '$password', '$phone', '$address')";

        if ($conn->query($sql) === TRUE) {
            // Enviar correo de confirmación aquí
            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso. Por favor, revise su correo electrónico para confirmar su cuenta.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
        }
    }
}

$conn->close();

echo json_encode($response);
?>
