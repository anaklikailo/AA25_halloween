<?php
    include('./includes/conexion.php');
    conectar();
    
    $mensaje = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = isset($_POST['login-username']) ? htmlspecialchars($_POST['login-username']) : '';
        $password = isset($_POST['login-password']) ? $_POST['login-password'] : '';

        $sql = mysqli_query($conexion, "SELECT nombre, clave FROM usuarios WHERE nombre = '$user'");
        
        if ($sql && mysqli_num_rows($sql) > 0) {
                $mensaje = "<script>alert('¡Bienvenido " . $user . "!');</script>";
            } else {
                $mensaje = "<script>alert('Contraseña incorrecta');</script>";
            }
    }
?> 
   

<section id="login" class="section">
    <h2>Iniciar Sesión</h2>
    <?php echo $mensaje; ?>
    <form action="index.php?modulo=login" method="POST">
        <label for="login-username">Nombre de Usuario:</label>
        <input type="text" id="login-username" name="login-username" required>
        
        <label for="login-password">Contraseña:</label>
        <input type="password" id="login-password" name="login-password" required>
        
        <button type="submit">Iniciar Sesión</button>
    </form>
</section>



