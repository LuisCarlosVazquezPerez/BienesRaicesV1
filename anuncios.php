<?php
include '../bienesraices/includes/templates/header.php'
?>

<main class="contenedor seccion">
    <h2>Casas y depas en venta</h2>

    <?php
    $limite = 10;
    include "includes/templates/anuncios.php"
    ?>
</main>

<?php
include '../bienesraices/includes/templates/footer.php'
?>