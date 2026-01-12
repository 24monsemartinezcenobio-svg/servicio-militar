<?php
include("conexion.php");
$id = $_GET['id_asp'];
$query = mysqli_query($conn, "SELECT * FROM aspirantes WHERE id_asp = $id");
$ver = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head><title>Impresión</title></head>
<body onload="window.print()">
    <div style="border: 1px dashed #000; padding: 30px; width: 450px; margin: auto;">
        <h2 style="text-align: center;">COMPROBANTE</h2>
        <p><strong>RFC:</strong> <?php echo $ver['clave_rfc']; ?></p>
        <p><strong>ASPIRANTE:</strong> <?php echo $ver['nom_persona']." ".$ver['ape_paterno'] ; ?></p>
        <p><strong>SITUACIÓN:</strong> <?php echo $ver['situacion']; ?></p>
        <p><strong>GÉNERO:</strong> <?php echo $ver['sexo']; ?></p>
        <br><br>
    </div>
</body>
</html>
