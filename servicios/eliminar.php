<?php

if (!isset($_GET["codpro"])) {
    exit();
}

$codpro = $_GET["codpro"];
include_once "../servicios/conexionPDO.php";
$sentencia = $conn->prepare("DELETE FROM producto WHERE codpro = ?;");
$resultado = $sentencia->execute([$codpro]);
if ($resultado === true) {
    header("Location: ../index.php");
} else {
    echo "Algo salió mal";
}