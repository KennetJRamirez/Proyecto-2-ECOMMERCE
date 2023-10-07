<?php
session_start();

if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    foreach ($_SESSION['carrito'] as $key => $producto) {
        if ($producto['id_producto'] == $idProducto) {
            unset($_SESSION['carrito'][$key]);
            break;
        }
    }
}

header('Location: carrito.php');
exit;
?>
