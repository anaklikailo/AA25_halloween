<?php
session_start();
include('./includes/conexion.php');
conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = mysqli_real_escape_string($conexion, trim($_POST['login-username']));
    $password = trim($_POST['login-password']);

    // traer id y clave para login
    $sql = mysqli_query($conexion, "SELECT id, nombre, clave FROM usuarios WHERE nombre='$user'");

    if ($sql && mysqli_num_rows($sql) > 0) {

        $r = mysqli_fetch_assoc($sql);

        // comparar password con hash guardado
        if (password_verify($password, $r['clave'])) {

            $_SESSION['id'] = $r['id'];      // <<--- este es el que usa disfraces-list !!
            $_SESSION['nombre'] = $r['nombre'];

            echo "<script>alert('Bienvenido ".$r['nombre']." !');
                window.location='index.php?modulo=disfraces-list.php';
                </script>";
            exit;

        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }

    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }
}
?>

<section id="login" class="section">
    <h2>Iniciar Sesión</h2>

    <form action="index.php?modulo=login" method="POST">
        <label>Nombre de Usuario:</label>
        <input type="text" name="login-username" required>

        <label>Contraseña:</label>
        <input type="password" name="login-password" required>

        <button type="submit">Iniciar Sesión</button>
    </form>
</section>
