<?php
$conn = mysqli_connect("localhost", "root", "", "registro_general");

if(!$conn){
    echo "No se pudo conectar a la base";
}
?>