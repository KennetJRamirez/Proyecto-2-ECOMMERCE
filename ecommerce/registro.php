<!DOCTYPE html>
<html>

<head>
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Registro de Cliente</h2>
        <form method="post" action="registro_procesar.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                </div>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <h3>Dirección:</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pais">País:</label>
                    <input type="text" class="form-control" id="pais" name="pais" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="estado">Estado:</label>
                    <input type="text" class="form-control" id="estado" name="estado" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="calle">Calle:</label>
                    <input type="text" class="form-control" id="calle" name="calle" required>
                </div>
            </div>
            <div class="form-group">
                <label for="codigo_postal">Código Postal:</label>
                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
