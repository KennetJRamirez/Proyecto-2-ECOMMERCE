<?php
include("conexion.php");

session_start();

if (isset($_SESSION['id_cliente']) && !empty($_SESSION['id_cliente'])) {
    $idCliente = $_SESSION['id_cliente'];

    if (isset($_POST['continuar'])) {
        $tipoPago = $_POST['tipo_pago'];

        $numeroTarjeta = "";
        $correoPaypal = "";
        $numeroCuenta = "";

        if ($tipoPago == 1) {
            $numeroTarjeta = $_POST['numero_tarjeta'];
        } elseif ($tipoPago == 2) {
            $correoPaypal = $_POST['correo_paypal'];
        } elseif ($tipoPago == 3) {
            $numeroCuenta = $_POST['numero_cuenta'];
        }

        foreach ($_SESSION['carrito'] as $item) {
            $idProducto = $item['id_producto'];
            $cantidad = $item['cantidad'];

            $sqlInsertCarrito = "INSERT INTO carrito (id_producto, id_cliente, cantidad) 
                                VALUES ($idProducto, $idCliente, $cantidad)";

            if ($conn->query($sqlInsertCarrito) !== TRUE) {
                echo "Error al insertar en carrito: " . $conn->error;
                exit;
            }
        }

        $sqlObtenerDomicilio = "SELECT id_domicilio FROM domicilio WHERE id_cliente = $idCliente";
        $resultObtenerDomicilio = $conn->query($sqlObtenerDomicilio);

        if ($resultObtenerDomicilio->num_rows > 0) {
            $rowDomicilio = $resultObtenerDomicilio->fetch_assoc();
            $idDomicilio = $rowDomicilio['id_domicilio'];

            $total = 0;
            foreach ($_SESSION['carrito'] as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            }

            $sqlInsertOrden = "INSERT INTO orden (id_cliente, id_tipo_pago, total, id_domicilio) 
                            VALUES ($idCliente, $tipoPago, $total, $idDomicilio)";

            if ($conn->query($sqlInsertOrden) === TRUE) {
                $idOrden = mysqli_insert_id($conn);

                foreach ($_SESSION['carrito'] as $item) {
                    $idProducto = $item['id_producto'];
                    $cantidad = $item['cantidad'];

                    $sqlRestarStock = "UPDATE producto SET cantidad_disponible = cantidad_disponible - $cantidad WHERE id_producto = $idProducto";
                    if ($conn->query($sqlRestarStock) !== TRUE) {
                        echo "Error al actualizar el stock del producto: " . $conn->error;
                        exit;
                    }
                }

                $sqlInsertClienteMetodoPago = "INSERT INTO cliente_metodo_pago (id_cliente, id_tipo_pago, tarjeta, efectivo, correo_paypal) 
                            VALUES ($idCliente, $tipoPago, '$numeroTarjeta', '$numeroCuenta', '$correoPaypal')";

                if ($conn->query($sqlInsertClienteMetodoPago) !== TRUE) {
                    echo "Error al insertar en cliente_metodo_pago: " . $conn->error;
                    exit;
                }

                foreach ($_SESSION['carrito'] as $item) {
                    $idProducto = $item['id_producto'];
                    $cantidad = $item['cantidad'];
                    $precio = $item['precio'];

                    $sqlInsertDetalleOrden = "INSERT INTO detalle_orden (id_orden, id_producto, cantidad, precio) 
                            VALUES ($idOrden, $idProducto, $cantidad, $precio)";

                    if ($conn->query($sqlInsertDetalleOrden) !== TRUE) {
                        echo "Error al insertar en detalle_orden: " . $conn->error;
                        exit;
                    }
                }

                $_SESSION['carrito'] = array();

                echo "Pago realizado con éxito. <a href='index.php' class='btn btn-primary'>Ir a la página de inicio</a>";
            } else {
                echo "Error al insertar en orden: " . $conn->error;
            }
        } else {
            echo "Error: No se encontró un domicilio para el cliente.";
        }
    } else {
        echo 'El formulario no se ha enviado correctamente.';
    }
} else {
    echo 'Error: No se ha definido el ID del cliente.';
}

$conn->close();
?>
