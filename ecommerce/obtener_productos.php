<?php
include("conexion.php"); 

if (isset($_POST['categoria_id'])) {
    $categoriaId = $_POST['categoria_id'];

    $sqlProductos = "SELECT * FROM producto WHERE id_tipo_producto = $categoriaId OR id_tipo_producto IN (SELECT id_tipo_producto FROM tipo_producto WHERE parent_id = $categoriaId)";
    $resultProductos = $conn->query($sqlProductos);

    if ($resultProductos->num_rows > 0) {
        echo '<div class="container">';
        echo '<div class="row">';
        while ($rowProducto = $resultProductos->fetch_assoc()) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card">';
            echo '<img src="imagen_producto.jpg" class="card-img-top" alt="' . $rowProducto['nombre'] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $rowProducto['nombre'] . '</h5>';
            echo '<p class="card-text">Precio: $' . $rowProducto['precio'] . '</p>';
            echo '<p class="card-text">Descripción: ' . $rowProducto['descripcion'] . '</p>';
            echo '<p class="card-text">Disponibles: ' . $rowProducto['cantidad_disponible'] . '</p>';
            echo '<a href="detalle.php?id=' . $rowProducto['id_producto'] . '" class="btn btn-primary">Detalles</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">No hay productos disponibles en esta categoría.</div>';
    }
}
?>
