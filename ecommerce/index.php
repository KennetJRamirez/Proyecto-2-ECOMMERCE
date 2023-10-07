<!DOCTYPE html>
<html>

<head>
    <title>Tienda</title>
    <link rel="stylesheet" href="css/styleindex.css">
    <!-- Agrega la biblioteca Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
    <!-- Agrega Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Agrega Font Awesome para el icono del carrito -->
  <!-- Agrega Font Awesome para el ícono del carrito -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">My Ecommerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carrito.php">
                        <i class="fas fa-shopping-cart"></i> Carrito
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="categorias-tienda mt-4">
        <div class="container">
            <h2 class="text-center">Categorías de Tienda</h2>
            <ul class="list-group text-center">
                <?php
                include("conexion.php"); 

                $sql = "SELECT * FROM tipo_producto WHERE parent_id IS NULL";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item categoria" data-id="' . $row['id_tipo_producto'] . '"><a href="#">' . $row['tipo_producto_descripcion'] . '</a></li>';
                    }
                } else {
                    echo 'No hay categorías disponibles.';
                }
                ?>
            </ul>
        </div>
    </section>

    <section class="productos mt-4">
        <div class="container">
            <div class="row">
                <?php
                $sqlProductos = "SELECT * FROM producto";
                $resultProductos = $conn->query($sqlProductos);

                if ($resultProductos->num_rows > 0) {
                    while ($rowProducto = $resultProductos->fetch_assoc()) {
                        echo '<div class="col-md-4 mb-4">';
                        echo '<div class="card">';
                        echo '<img src="ruta_imagen.jpg" class="card-img-top" alt="Imagen de Producto">';
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
                } else {
                    echo 'No hay productos disponibles.';
                }
                ?>
            </div>
        </div>
    </section>

    <footer class="mt-4">
        <div class="container">
            <p class="text-center">&copy; My Ecommerce</p>
        </div>
    </footer>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/cargar_por_categoria.js"></script>

</body>

</html>
