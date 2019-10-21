<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">	
	<?php require_once "plantillas/cabecera.html"; ?>	
	<?php require_once "plantillas/cabecera-estilo.html"; ?>

	<!--Escript de vista-->
    <script type="text/javascript" src="<?php echo URL;?>/Views/script/Login.js"></script>   


<script type="text/javascript">

/*	$(document).ready(function(){

		$("#ingresar").click(function (){
			window.location.href = '<?php //echo URL; ?>/pagina-de-inicio'			
		});



		//////////////////////////////////////




	});*/
	
</script>


</head>
<body style="overflow: hidden !important">
	

<?php require_once "plantillas/menuLogin.html"; ?>


 <div class="row" style="font-family: Nunito;">

 		<div class="container" style="margin: 180px auto 0px; max-width: 450px;">

			<div class="row" style="padding: 50px;border-radius: 20px 20px 20px 20px;border: #293a4a 2px solid;box-shadow: 0 5px 25px rgba(0,0,0,0.1) !important;margin: 5px">
				
				<div class="form-group">
					<div class="input-group" >
						<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span></span>	
		 				<input id="usuario" class="form-control" placeholder="DNI USUARIO" style="width: 100%;" type="text"> 				
 					</div>
				</div>
				
	 			<div class="form-group">
	 				<div class="input-group" >
						<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></span>	
	 					<input id="password" class="form-control" placeholder="CONTRASEÑA" style="width: 100%;" type="password"> 
	 				</div>				
	 			</div>


	 			<div class="form-group">
	 				<a id="ingresar" class="btn btn-primary" style="background: #293a4a;width: 100%;border: #293a4a solid 3px;color: white;margin-bottom: 5px;"> <h4 style="font-size: 12pt;" onclick="javascript:vod()"><b>INGRESAR</b></h4> </a>
	 			</div>	
	 			
			</div>	

	
 		</div>
 		
 </div>

</body>
</html>