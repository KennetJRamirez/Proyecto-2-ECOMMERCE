<!DOCTYPE html>
<html>

<head>
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Carrito de Compras</h1>

        <?php

        include("conexion.php");

        session_start();
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
            $idProducto = $_POST['id_producto'];
            $cantidad = intval($_POST['cantidad']);

            $sql = "SELECT * FROM producto WHERE id_producto = $idProducto";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $producto = $result->fetch_assoc();
                $producto['cantidad'] = $cantidad;

                $_SESSION['carrito'][] = $producto;
            }
        }

        if (empty($_SESSION['carrito'])) {
            echo '<p>El carrito está vacío.</p>';
        } else {
            echo '<table class="table">';
            echo '<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acción</th></tr></thead>';
            echo '<tbody>';

            $total = 0;

            foreach ($_SESSION['carrito'] as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;

                echo '<tr>';
                echo '<td>' . $item['nombre'] . '</td>';
                echo '<td>$' . $item['precio'] . '</td>';
                echo '<td>' . $item['cantidad'] . '</td>';
                echo '<td>$' . $subtotal . '</td>';
                echo '<td><a href="eliminar_producto.php?id=' . $item['id_producto'] . '" class="btn btn-danger">Eliminar</a></td>';
                echo '</tr>';
            }

            echo '<tr><td colspan="3"><strong>Total:</strong></td><td>$' . $total . '</td><td></td></tr>';
            echo '</tbody>';
            echo '</table>';

            echo '<a href="realizar_pago.php" class="btn btn-primary">Realizar Pago</a>';
            echo '<a href="index.php" class="btn btn-secondary">Seguir Comprando</a>';
        }
        ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
