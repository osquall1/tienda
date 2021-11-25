<?php
session_start();
extract ($_REQUEST);
require "../servicios/conexionBasesDatos.php";
/* los variables que viene del formulario son: $login, $password */

/*asigno a la variable password el valor encriptado de lo que colocaron
en el password del formulario, ya que así esta en la base de datos  nos confundird */ 
$pass = hash('sha256', $_POST['pass']);
$cuenta = $_REQUEST['cuenta'];

$objConexion=Conectarse();
// Vamos a realizar el proceso para consultar 
//Guardamos en una variable la sentencia sql
$sql="select * from usuario where nomusu = '$cuenta' and pasusu = '$pass'";
//Asignar a una variable el resultado de la consulta
$resultado=$objConexion->query($sql);
//verifico si existe el usuario
$existe = $resultado->num_rows;

if ($existe==1)  //quiere decir que los datos estan bien
{
	$usuario=$resultado->fetch_object();
        session_start();
	$_SESSION['nomusu']= $usuario->nomusu;	
    header('Location: ../servicios/productos.php');
	
}
else
{
    echo"<script>  alert('Usuario o clave incorrecta. Vuelva a digitarlos por favor, tener en cuenta que es para los que administran la plataforma'); window.location.href='../index.php'; </script>";
}

?>