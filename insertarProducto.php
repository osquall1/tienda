
<?php
error_reporting( ~E_NOTICE ); 
 require_once 'servicios/conexionPDO.php';
 
 if(isset($_POST['btnsave']))
 {
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];

  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];
  
  
  if(empty($nombre)){
   $errMSG = "Por favor coloque el nombre del producto.";
  }
  else if(empty($descripcion)){
   $errMSG = "coloque la descripcion.";
  }
  else if(empty($precio)){
   $errMSG = "coloque el precio";
  }
  else if(empty($imgFile)){
   $errMSG = "Por favor seleccione la imagen.";
  }
  else
  {
   $upload_dir = 'assets/products/'; 
    
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
  
   // rename uploading image
   $userpic = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else{
     $errMSG = "el tamaño del archivo sobrepasa el permitido.";
    }
   }
   else{
    $errMSG = "Unicamente archivos JPG, JPEG, PNG & GIF permitidos.";  
   }
  }
  
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $conn->prepare('INSERT INTO producto(nompro,despro,prepro,rutimapro) VALUES(:uname, :descripcion, :precio, :upic)');
   $stmt->bindParam(':uname',$nombre);
   $stmt->bindParam(':descripcion',$descripcion);
   $stmt->bindParam(':precio',$precio);
   $stmt->bindParam(':upic',$userpic);
   
   if($stmt->execute())
   {
    $successMSG = "new record succesfully inserted ...";
    header("refresh:5;index.php"); 
   }
   else
   {
    $errMSG = "error while inserting....";
   }
  }
 }
?>

<head>
     <meta charset="utf-8" lang="es">
          
        
     <title>Agregar producto</title><!--titulo de la pagina-->
       <link rel="stylesheet" href="estilo/estilos.css" type="text/css">
               <script src="estilo/docjava.js"></script>
               <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
 
  
    </head>

     <header>
        <div><a href="servicios/productos.php">Atras</a></div>
    </header>
    <body>

<br><br><br><br>
<div class="borde">
<form method="post" enctype="multipart/form-data" class="form-horizontal">
     
 <table class="table table-bordered table-responsive">
 
    <tr>
     <td><label class="control-label">Nombre Producto</label></td>
        <td><input class="form-control" type="text" name="nombre" placeholder="coloque el nombre del producto" /></td>
    </tr>
    
    <tr>
     <td><label class="control-label">Descripcion.</label></td>
        <td><input class="form-control" type="text" name="descripcion" placeholder="Descripcion del producto" /></td>
    </tr>
   <tr>
     <td><label class="control-label">Precio.</label></td>
        <td><input class="form-control" type="number" step="any" name="precio" placeholder="coloque el precio"  /></td>
    </tr>    


    <tr>
     <td><label class="control-label">Imagen del Producto.</label></td>
        <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Guardar
        </button>
        </td>
    </tr>
    
    </table>
    
</form>
</div>
</body>
<br><br><br><br><br>
<?php include("layouts/_footer.php"); ?>
</html>