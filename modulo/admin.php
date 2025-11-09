<?php
session_start();

include('./includes/conexion.php');
conectar();


// admin es id = 1
if(!isset($_SESSION['id']) || $_SESSION['id'] != 1){
    echo "<script>alert('No tenés permisos para acceder a esta sección.');
    window.location='index.php';</script>";
    exit;
}

if(isset($_GET['eliminar'])){
    $id = (int)$_GET['eliminar'];
    mysqli_query($conexion,"UPDATE disfraces SET eliminado = 1 WHERE id = $id");
    echo "<script>alert('Disfraz eliminado');
    window.location='index.php?modulo=admin';</script>";
    exit;
}

if(isset($_POST['disfraz-nombre'])){
    $nombre      = mysqli_real_escape_string($conexion,$_POST['disfraz-nombre']);
    $descripcion = mysqli_real_escape_string($conexion,$_POST['disfraz-descripcion']);
    $archivo     = $_FILES['disfraz-foto']['name']; 

    if($archivo!="" && is_uploaded_file($_FILES['disfraz-foto']['tmp_name'])){
        $trozos = explode(".", $archivo);
        $qu     = time();
        copy($_FILES['disfraz-foto']['tmp_name'], "images/".$qu.".".end($trozos));
        $foto_final = $qu.".".end($trozos);
    } else {
        $foto_final = "";
    }

    /*  ALTER TABLE disfraces
        MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT,
        ADD PRIMARY KEY (id); */

    mysqli_query($conexion, "INSERT INTO disfraces (nombre,descripcion,foto,votos,eliminado)
                             VALUES ('$nombre','$descripcion','$foto_final',0,0)")
    or die(mysqli_error($conexion));
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion</title>
</head>
<body>
     <section id="admin" class="section">
            <h2>Panel de Administración</h2>

            <form action="index.php?modulo=admin" method="POST" enctype="multipart/form-data">
                <label>Nombre del Disfraz:</label>
                <input type="text" name="disfraz-nombre" required>

                <label>Descripción del Disfraz:</label>
                <textarea name="disfraz-descripcion" required></textarea>

                <label>Foto:</label>
                <input type="file" name="disfraz-foto" required>

                <button type="submit">Agregar Disfraz</button>
            </form>
        </section>
</body>
</html>

<?php
$qr = mysqli_query($conexion,"SELECT id,nombre,foto FROM disfraces WHERE eliminado=0");

echo "<h3>Listado de disfraces</h3>";
echo "<table border='1'>";
echo "<tr><th><p>Foto</p></th><th><p>Nombre</p></th><th><p>Accion</p></th></tr>";

while($d = mysqli_fetch_assoc($qr)){
    echo "<tr>";
    echo "<td><img src='images/".$d['foto']."'></td>";
    echo "<td>".$d['nombre']."</td>";
    echo "<td><a href='index.php?modulo=admin&eliminar=".$d['id']."'>Eliminar</a></td>";
    echo "</tr>";
}
echo "</table>";
?>