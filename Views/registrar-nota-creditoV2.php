<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, |choose Tools | Templates
and open the template in the editor.
-->
<?php  

    session_start(); 

    if(empty($_SESSION['idColaborador'])) {        
        echo '<script>  window.location.href = "'. URL . '/";</script>';
    } 

 ?>

<html>
    <head>
        <meta charset="UTF-8">
	<?php require_once "plantillas/cabeceraV2.html"; ?>	
	<?php //require_once "plantillas/cabecera-estilo.html"; ?>
        
        <!--Escript de vista-->
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/registrar-cobranza.js"></script>

        <script type="text/javascript">

        </script>        
        
    </head>
    <body> 

		<main>

		<nav>
		  <div class="nav-wrapper">
			<div class="container">
			  <a href="#" class="brand-logo">LOGO</a>
			  <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
			  <ul class="right hide-on-med-and-down">
				<li><a href="#">item1</a></li>
				<li><a href="#">item2</a></li>
				<li><a href="#">item3</a></li>
				<li><a href="#">item4</a></li>
			  </ul>
			  <ul class="side-nav" id="mobile-menu">
				<li><a href="#">item1</a></li>
				<li><a href="#">item2</a></li>
				<li><a href="#">item3</a></li>
				<li><a href="#">item4</a></li>
			  </ul>
			</div>
		  </div>
		</nav>


		</main>
		
		
        
    </body>
</html>