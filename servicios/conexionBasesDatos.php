<?php
function Conectarse()
{
	$objConexion = new mysqli("localhost","root","","tiendaoscar");//aca la conexion con la BD esta sin contraseña
	if ($objConexion->connect_error)
	{
		echo "Error de conexion a la Base de Datos ".$objConexion->connect_error;
		exit();
	}
	else
	{
		return $objConexion;
	}
}
?>
