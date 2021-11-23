<?php 
session_start();
 ?>


<!DOCTYPE html>

<html>
    <head>
     <meta charset="utf-8">
          
        <meta name="Language" content="español">
	  <title>Micelanea</title><!--titulo de la pagina-->
	  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron&family=Questrial&family=Quintessential&display=swap" rel="stylesheet">


   <script src="js/jquery.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="css/index.css" type="text/css">
     
    </head>
    <body>
<header> 
<div class="logo-place"> <img src="imagenes/tiendita.png" width="50" height="30" > </div>
<div class="search-place"><input type="text" name="idbusqueda" placeholder="introdusca su busqueda">
   <button class="btn-main btn-search"><i class="fa fa-search" aria-hidden="true">  </i></button>  
</div>
<div class="options-place"> 
   <?php //codigo para ocular el div cuando haya iniciado la sesion
   if (isset($_SESSION['codusu'])){
   echo '<div class="estilo_usuario" ><i class="fa fa-user-circle-o" aria-hidden="true"></i>'.$_SESSION['nomusu'].'</div';
   
   }else{

   
    ?> 
  
    <div class="item-option" title="Registro"><i class="fa fa-user-circle-o" aria-hidden="true"></i> </div>
    
    <div class="item-option" title="Ingreso"><i class="fa fa-sign-in" aria-hidden="true"></i></div>
  <?php  
  
}
  ?>
    <div class="item-option" title="a comprar!"><i class="fa fa-shopping-cart" aria-hidden="true"></i> </div>

       </div>


  </header>
<div class="main-content">
   <div class="content-page">
       <div class="title-section">Productos destacados</div>
         <div class="products-list" id="space_list"> 
              
         </div> 

       </div>
    </div>
</div>
<script type="text/javascript">
 $(document).ready(function(){
    $.ajax({
      url:'modelo/obenterProductos.php',
      type:'POST',
      data:{},
      success:function(data){
          console.log(data);
          let html='';
          for (var i = 0; i< data.datos.length; i++){
            html+=
           ' <div class="product-box">'+
            '<a href="producto.php?p='+data.datos[i].codpro+' ">'+
              '<div class="product">'+
                '<img src="imagenes/'+data.datos[i].rutimapro+'" >'+
                '<div class="detail-title">'+data.datos[i].nompro+'</div>'+
                '<div class="detail-descripcion">'+data.datos[i].despro+'</div>'+
                '<div class="detail-price">'+formato_precio(data.datos[i].prepro)+'</div>'+ //para separar el decimal
              '</div>'+
              '</a>'+
         '</div>';  
        }
       document.getElementById("space_list").innerHTML=html;




      },
      error:function(err){
        console.error(err);
      }

    });

  });
  function formato_precio(valor){
   //separacion del decimal
   let svalor=valor.toString();
   let array=svalor.split(".");
   return "$="+array[0]+".<span>"+array[1]+"</span>";
  }
</script>
    </body>
</html>