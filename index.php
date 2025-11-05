<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halloween</title>
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php?modulo=disfraces-list">Ver Disfraces</a></li>
            <li><a href="index.php?modulo=registro">Registro</a></li>
            <li><a href="index.php?modulo=login">Iniciar Sesión</a></li>
            <li><a href="index.php?modulo=admin">Panel de Administración</a></li>
        </ul>
    </nav>
    <header>
        <h1>Concurso de disfraces de Halloween</h1>
    </header>
    <main>
        <?php
            if (!empty($_GET['modulo'])) {
                $modulo = $_GET['modulo'];
                $ruta_modulo = "modulo/" . $modulo . ".php";
                include($ruta_modulo);
                } else {
                    include("modulo/disfraces-list.php");
                }
        ?>
    </main>
    <script src="js/script.js"></script>
</body>
</html>
