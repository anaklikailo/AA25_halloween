<?php
session_start();

include('./includes/conexion.php');
conectar();



// si llega un voto
if(isset($_POST['id_disfraz'])){

    // si no está logueado no puede votar
    if(!isset($_SESSION['id'])){
        echo "<script>alert('Para votar primero debes iniciar sesión.');
                window.location='index.php?modulo=login';
        </script>";
        exit;
    }

    $id_usuario = $_SESSION['id'];
    $id_disfraz = $_POST['id_disfraz'];

    // verificar si ya votó ese disfraz
    $q = mysqli_query($conexion, "SELECT * FROM votos WHERE id_usuario=$id_usuario AND id_disfraz=$id_disfraz");

    if(mysqli_num_rows($q) > 0){
        echo "<script>alert('Ya votaste este disfraz!');</script>";
    } else {

        /* ALTER TABLE votos
        MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT,
        ADD PRIMARY KEY (id); */

        // registrar voto
        mysqli_query($conexion, "INSERT INTO votos (id_usuario, id_disfraz) VALUES ($id_usuario, $id_disfraz)") 
            or die("Error al registrar voto: ".mysqli_error($conexion));

        // actualizar contador
        mysqli_query($conexion, "UPDATE disfraces SET votos = votos + 1 WHERE id=$id_disfraz")
            or die("Error al actualizar cantidad: ".mysqli_error($conexion));

        echo "<script>alert('¡Gracias por tu voto!'); window.location='index.php?modulo=disfraces-list';</script>";
        exit;
    }
}
?>

<section id="disfraces-list" class="section">
    <h2>Lista de Disfraces</h2>
    <?php
    $sql = mysqli_query($conexion, "SELECT * FROM disfraces WHERE eliminado = 0");

    while($disfraz = mysqli_fetch_assoc($sql)){
        echo "<div class='disfraz'>";
        echo "<h2>".htmlspecialchars($disfraz['nombre'])."</h2>";
        echo "<p>".htmlspecialchars($disfraz['descripcion'])."</p>";
        echo "<p>Cantidad de votos: ".$disfraz['votos']."</p>";
        echo '<img src="images/'.$disfraz['foto'].'" width="100%">';

        echo "<form method='POST' action='index.php?modulo=disfraces-list'>";
        echo "<input type='hidden' name='id_disfraz' value='".$disfraz['id']."'>";
        echo "<button type='submit'>Votar</button>";
        echo "</form>";
        echo "</div><hr>";
    }
    desconectar();
    ?>
</section>