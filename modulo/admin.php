<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion</title>
</head>
<body>
     <section id="admin" class="section">
            <h2>Panel de Administración</h2>
            <form action="procesar_disfraz.php" method="POST">
                <label for="disfraz-nombre">Nombre del Disfraz:</label>
                <input type="text" id="disfraz-nombre" name="disfraz-nombre" required>
                
                <label for="disfraz-descripcion">Descripción del Disfraz:</label>
                <textarea id="disfraz-descripcion" name="disfraz-descripcion" required></textarea>
                
                <label for="disfraz-nombre">Foto:</label>
                <input type="file" id="disfraz-foto" name="disfraz-foto" required>

                <button type="submit">Agregar Disfraz</button>
            </form>
        </section>
</body>
</html>