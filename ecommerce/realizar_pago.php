<!DOCTYPE html>
<html>

<head>
    <title>Realizar Pago</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Realizar Pago</h1>

        <?php
        include("conexion.php");

        session_start();
        if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
            echo '<p>El carrito está vacío.</p>';
        } else {
            if (!isset($_SESSION['id_cliente']) || empty($_SESSION['id_cliente'])) {

                echo 'Error: No se ha definido el ID del cliente.';

                exit; 
            }

            echo '<h3>Resumen de la Compra:</h3>';
            echo '<table class="table">';
            echo '<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr></thead>';
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
                echo '</tr>';
            }

            echo '<tr><td colspan="3"><strong>Total:</strong></td><td>$' . $total . '</td></tr>';
            echo '</tbody>';
            echo '</table>';

            $sqlTiposPago = "SELECT * FROM tipo_pago";
            $resultTiposPago = $conn->query($sqlTiposPago);

            if ($resultTiposPago->num_rows > 0) {
                echo '<h3>Seleccione un Tipo de Pago:</h3>';
                echo '<form method="post" action="procesar_pago.php">';
                echo '<div class="form-group">';
                echo '<label for="tipo_pago">Tipo de Pago:</label>';
                echo '<select class="form-control" id="tipo_pago" name="tipo_pago">';

                while ($rowTipoPago = $resultTiposPago->fetch_assoc()) {
                    echo '<option value="' . $rowTipoPago['id_tipo_pago'] . '">' . $rowTipoPago['descripcion'] . '</option>';
                }

                echo '</select>';
                echo '</div>';

                echo '<div id="campos_pago" style="display:none;">';

                echo '<div id="campos_tarjeta" style="display:none;">';
                echo '<div class="form-group">';
                echo '<label for="numero_tarjeta">Número de Tarjeta:</label>';
                echo '<input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta">';
                echo '</div>';
                echo '</div>';


                echo '<div id="campos_paypal" style="display:none;">';
                echo '<div class="form-group">';
                echo '<label for="correo_paypal">Correo de PayPal:</label>';
                echo '<input type="text" class="form-control" id="correo_paypal" name="correo_paypal">';
                echo '</div>';
                echo '</div>';

                echo '<div id="campos_transferencia" style="display:none;">';
                echo '<div class="form-group">';
                echo '<label for="numero_cuenta">Número de Cuenta:</label>';
                echo '<input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta">';
                echo '</div>';
                echo '</div>';

                echo '<button type="submit" class="btn btn-primary" name="continuar">Continuar</button>';
                echo '</form>';
            } else {
                echo 'No se encontraron tipos de pago en la base de datos.';
            }
        }
        ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        $(document).ready(function () {
            $('#tipo_pago').change(function () {
                var tipoPagoSeleccionado = $(this).val();
                if (tipoPagoSeleccionado != '') {
                    $('#campos_pago').show();

                    if (tipoPagoSeleccionado == 1) { // Tarjeta de Crédito
                        $('#campos_tarjeta').show();
                        $('#campos_paypal').hide();
                        $('#campos_transferencia').hide();
                    } else if (tipoPagoSeleccionado == 2) { // PayPal
                        $('#campos_tarjeta').hide();
                        $('#campos_paypal').show();
                        $('#campos_transferencia').hide();
                    } else if (tipoPagoSeleccionado == 3) { // Efectivo
                        $('#campos_tarjeta').hide();
                        $('#campos_paypal').hide();
                        $('#campos_transferencia').show();
                    }
                } else {
                    $('#campos_pago').hide();
                }
            });
        });
    </script>
</body>

</html>