<?php
session_start();

include("conexion.php");

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$pais = $_POST['pais'];
$estado = $_POST['estado'];
$ciudad = $_POST['ciudad'];
$calle = $_POST['calle'];
$codigo_postal = $_POST['codigo_postal'];

$sql = "INSERT INTO cliente (nombres, apellidos, correo, telefono) VALUES ('$nombres', '$apellidos', '$correo', '$telefono')";

if ($conn->query($sql)) {
    $idCliente = $conn->insert_id;

    $_SESSION['id_cliente'] = $idCliente;

    $sqlDomicilio = "INSERT INTO domicilio (id_cliente, pais, estado, ciudad, calle, codigo_postal) VALUES ('$idCliente', '$pais', '$estado', '$ciudad', '$calle', '$codigo_postal')";

    if ($conn->query($sqlDomicilio)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error al registrar el domicilio: " . $conn->error;
    }
} else {
    echo "Error al registrar el cliente: " . $conn->error;
}

?>