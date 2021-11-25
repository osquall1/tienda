<?php
	session_start();
	if (!isset($_SESSION['nomusu'])) {
		header('location: ../index.php');
	}
?>
<?php
include_once("../servicios/conexionPDO.php");
$sentencia = $conn->query("SELECT codpro, nompro, despro, prepro FROM producto");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);;
?>

<html>
         <head>
          <title>Listado de productos</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
          <script src="../js/scrips.js" type="text/javascript"></script>
          <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
	        <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	        <link rel="stylesheet" type="text/css" href="../css/index.css">
          <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      </head>

      <header>
		<div><a href="../insertarProducto.php" title="Agragar productos de la tienda">Agregar Producto</a></div>
		<div><a class="salid" href="../index.php" title="Opcion para salir"> SALIR</a></div>
	</header>

      <div class="container">
      	<br>
      	<br>
      	<br>
        <center> <h1>Listado Productos</h1>
       </center>
      
  <body class="cuerpo" >
  
<div class="borde">
	<div class="col-12">
		
		<a class="aviso" href="../insertarProducto.php">Agregar Producto</a></li>
		<br><br>
		<div class="table-responsive">
			<table id="example" class="display" style="width:100%">
				<thead>
					<tr>
					  <th>Codigo</th>
						<th>Nombre producto</th>
						<th>Descripcion</th>
            <th>Precio</th>
            
            <th>Editar</th>                       
            <th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					
					<?php foreach($productos as $producto){ ?>
                                                      
						<tr>  
                <td><?php echo $producto->codpro ?></td>
							  <td><?php echo $producto->nompro ?></td>
							  <td><?php echo $producto->despro ?></td>
							  <td><?php echo $producto->prepro ?></td>
               <td><a class="btn btn-warning" href="<?php echo "../servicios/editar.php?codpro=" . $producto->codpro?>">Editar 📝</a></td>                                     
							<td>  
               	<a class="btn btn-danger" href="<?php echo "../servicios/eliminar.php?codpro=" . $producto->codpro?>" title="click para borrar" onclick="return confirm('seguro que quieres eliminar ?')">Eliminar 🗑️</a></td>
             	</tr>
             <?php } ?>                        
				</tbody>
			</table>
		</div>
	</div>
</div>
<br><br>
      
</body>

</html>

