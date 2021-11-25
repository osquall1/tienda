<?php
error_reporting( ~E_NOTICE );
 require_once '../servicios/conexionPDO.php';
 
 if(isset($_GET['codpro']) && !empty($_GET['codpro']))
 {
  $id = $_GET['codpro'];
  $stmt_edit = $conn->prepare('SELECT nompro, despro, prepro, rutimapro FROM producto WHERE codpro =:uid');
  $stmt_edit->execute(array(':uid'=>$id));
  $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
  extract($edit_row);
 }
 else
 {
  header("Location: ../index.php");
 }
 
 if(isset($_POST['btn_save_updates']))
 {
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  
  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];
     
  if($imgFile)
  {
   $upload_dir = '../assets/products/';
    
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
   $userpic = rand(1000,1000000).".".$imgExt;
   if(in_array($imgExt, $valid_extensions))
   {   
    if($imgSize < 5000000)
    {
     unlink($upload_dir.$edit_row['userPic']);
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else
    {
     $errMSG = "Lo siento, su archivo sobrepasa el limite permitido de  5MB";
    }
   }
   else
   {
    $errMSG = "Unicamente archivos con extension JPG, JPEG, PNG & GIF que se pueden guardar.";  
   } 
  }
  else
  {
   // if no image selected the old image remain as it is.
   $userpic = $edit_row['userPic']; // old image from database
  } 
      
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $conn->prepare('UPDATE producto 
              SET nompro=:uname, 
               despro=:descri,
               prepro=:preci, 
               rutimapro=:upic 
               WHERE codpro=:uid');
   $stmt->bindParam(':uname',$nombre);
   $stmt->bindParam(':descri',$descripcion);
   $stmt->bindParam(':preci',$precio);

   $stmt->bindParam(':upic',$userpic);
   $stmt->bindParam(':uid',$id);
    
   if($stmt->execute()){
    ?>
                <script>
    alert('Se actualizo la informacion correctamente ...');
    window.location.href='../index.php';
    </script>
                <?php
   }
   else{
    $errMSG = "Sorry Data Could Not Updated !";
   }
  }    
 }
?>
<htmtl>
 <head>
     <meta charset="utf-8" lang="es">
          
        
     <title>Editar producto</title><!--titulo de la pagina-->
       
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/index.css">
 
  
    </head>
     <header>
        <div><a href="../servicios/productos.php">Atras</a></div>
    </header>
    <body>
<br><br><br>
  <div class="borde">
   <form method="post" enctype="multipart/form-data" class="form-horizontal">
 <table class="table table-bordered table-responsive"> 
       
    <tr class="edit_row">
     <td><label class="control-label">Nombre producto.</label></td>
        <td><input class="form-control" type="text" name="nombre" value="<?php echo $nompro; ?>" /></td>
    </tr>
    
    <tr>
     <td class="edit_row" ><label class="control-label">descripcion.</label></td>
        <td><input class="form-control" type="text" name="descripcion" value="<?php echo $despro; ?>" /></td>
    </tr>

   <tr>
     <td class="edit_row" ><label class="control-label">precio.</label></td>
        <td><input class="form-control" type="text" name="precio" value="<?php echo $prepro; ?>" /></td>
    </tr><br>
      <center> 
      <tr class="edit_row">
     <td><label class="control-label">Imagen producto.</label></td><br>

      <img src="../assets/products/<?php echo $edit_row['rutimapro']; ?>" class="img-rounded" width="250px" height="250px" />
       <br><br>
     <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
    </tr>
    <br>

    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Guardar
        </button>
        </td>
    </tr>
    </center>
    </table>
   
</form>
</div>
</body>
<br><br>
<?php include("../layouts/_footer.php"); ?>
</htmtl>