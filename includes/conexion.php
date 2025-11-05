<?php
function conectar() {
    global $conexion;
    $conexion = mysqli_connect("localhost", "root", "", "halloween") or 
    die("Se produjo un error al hacer la conexion: " . mysqli_connect_error());
}

function desconectar() {
    global $conexion;
    mysqli_close($conexion);
}
?>