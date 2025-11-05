<?php
    include('./includes/conexion.php');
    conectar();
?>

<section id="disfraces-list" class="section">
    <h2>Lista de Disfraces</h2>
    <?php
        $sql = mysqli_query($conexion, "SELECT * FROM disfraces WHERE eliminado = 0") or 
        die("Se produjo un error en la consulta: " . mysqli_error($conexion));

        while ($disfraz = mysqli_fetch_array($sql)) {
            echo "<div class='disfraz'>";
            echo "<h2>" . htmlspecialchars($disfraz['nombre']) . "</h2>";
            echo "<p>" . htmlspecialchars($disfraz['descripcion']) . "</p>";
            echo "<p>Cantidad de votos: " . $disfraz['votos'] . "</p>";
            echo "<p><img src='imagenes/" . htmlspecialchars($disfraz['foto']) . "' width='100%'></p>";
            echo "<button onclick='votar(" . $disfraz['id'] . ")' class='votar'>Votar</button>";
            echo "</div><hr>";
        }
        
        desconectar();
    ?>
</section>

<script>
    function votar(id) {
        alert("¡Gracias por tu voto!");
        // Aquí puedes agregar la lógica para registrar el voto
    }
</script>