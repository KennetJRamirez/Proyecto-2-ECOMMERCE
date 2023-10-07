
$(document).ready(function () {
    $('.carousel').slick({
        autoplay: true,
        autoplaySpeed: 3000, // Cambia de imagen cada 3 segundos
        dots: true, // Muestra los puntos de navegación
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear'
    });

    // Manejo de clics en categorías
    $('.categoria').click(function (e) {
        e.preventDefault();
        var categoriaId = $(this).data('id');
        cargarProductosPorCategoria(categoriaId);
    });
});

function cargarProductosPorCategoria(categoriaId) {
    $.ajax({
        method: 'POST',
        url: 'obtener_productos.php',
        data: { categoria_id: categoriaId },
        success: function (response) {
            $('.productos').html(response);
        },
        error: function (error) {
            console.error(error);
        }
    });
}
