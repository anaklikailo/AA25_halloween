<?php
    include('./includes/conexion.php');
    conectar();
    
    $mensaje = '';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
        $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

        $sql = mysqli_query($conexion, "INSERT INTO usuarios (nombre, clave) VALUES ('$user', '$password')");
        if($sql) {
            $mensaje = "<script>alert('Registro exitoso!');</script>";
        }
    }
?>

<section id="registro" class="section">
    <h2>Registro</h2>
    <?php echo $mensaje; ?>
    <form action="index.php?modulo=registro" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Registrarse</button>
    </form>
</section>