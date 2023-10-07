<!DOCTYPE html>
<html>

<head>
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <?php
        include("conexion.php"); 

     
        if (isset($_GET['id'])) {
            $idProducto = $_GET['id'];

            $sql = "SELECT * FROM producto WHERE id_producto = $idProducto";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <div class="card">
                    <img src="imagen_producto.jpg" class="card-img-top" alt="<?php echo $row['nombre']; ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $row['nombre']; ?></h2>
                        <p class="card-text">Precio: $<?php echo $row['precio']; ?></p>
                        <p class="card-text">Descripción: <?php echo $row['descripcion']; ?></p>
                        <p class="card-text">Disponibles: <?php echo $row['cantidad_disponible']; ?></p>
                        <form method="post" action="carrito.php">
                            <div class="form-group">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="<?php echo $row['cantidad_disponible']; ?>" class="form-control">
                            </div>
                            <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
                            <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
        <?php
            } else {
                echo '<div class="alert alert-danger" role="alert">No se encontró el producto.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">ID de producto no válido.</div>';
        }
        ?>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
