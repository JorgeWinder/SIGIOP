<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php require_once '../../../ini.php'; ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link rel="stylesheet" href="<?php echo URL;?>/Recursos/css/normalize.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Bootstrap -->
        <link href="<?php echo URL;?>/Recursos/css/bootstrap.min.css" rel="stylesheet">
        
         <link href="<?php echo URL;?>/Recursos/css/csi.css" rel="stylesheet">
         <link rel="stylesheet" href="<?php echo URL;?>/Recursos/css/animate.css">
         
         <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/Recursos/css/jquery.fullpage.css" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo URL;?>/Recursos/js/bootstrap.min.js"></script>
        
        <!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
        <script type="text/javascript" src="<?php echo URL;?>/Recursos/js/vendors/scrolloverflow.min.js"></script>
        <script type="text/javascript" src="<?php echo URL;?>/Recursos/js/jquery.fullPage.min.js"></script>
        
        <!-- bxSlider Javascript file -->
        <script src="<?php echo URL;?>/Recursos/js/jquery.bxslider.min.js"></script>
        <!-- bxSlider CSS file -->
        <link href="<?php echo URL;?>/Recursos/css/jquery.bxslider.css" rel="stylesheet" />      
        
        
        <style>
            
            
 .LupaOff {
  position: relative;
  bottom: -370px;
  left: 0px;
/*  right: 0;*/
  
/*  top: -50px;*/
  width: 350px;
  
  overflow: hidden;
  transition: 2.0s ease;
  
  padding: 0px 0px 0px 0px;
  
}

.LupaOn{
  /*top: -100px;*/
  bottom: 700px;
  left: -500px;  
  width: 2300px;
  z-index: 1001;

  padding: 120px 20px 0px 20px; 
  
  transition: 2.0s ease;
  
}

.LupaOff2{
  /*top: -100px;*/  
  opacity: 0;  
  
}


Lupa2Off{   
  opacity: 0;  
  bottom: 700px;
  left: -500px;  
  width: 2300px;
  z-index: 1001;   
  
  transition: 2.0s ease;
}

Lupa2On{   
  opacity: 1;     
}



.barraOff{
   position: absolute;
   filter: blur(2px);
   width: 850px;
   left: 12%;
   top:15%; 
   
   transition: 2.0s ease;
}


.barraOn{
   filter: blur(0px); 
}

                        
</style>        
        
<script>

$(document).ready(function(){
    
////////////////////////

$('body').css('opacity','1');
$('#slide2o2').hide();
$('#slide2o3').hide();
$('#slide2o4').hide();


////////////////////////

setTimeout(function () {

    $('#slide2o2').show();
    $('#slide2o2').addClass('animated fadeIn');     
        
},100);


setTimeout(function () {     
    $("#slide2o2").addClass("LupaOn");  
},3000);

setTimeout(function () {     
    $("#slide2o2").addClass("LupaOff2");
},4500);

setTimeout(function () {     
    $("#slide2o3").addClass('Lupa2On');
},3600);

setTimeout(function () {    
    $('#slide2o1').addClass('barraOn');     
},3800);
        
setTimeout(function () {
    $("#slide2o2").prop('src','<?php echo URL;?>/Recursos/img/lupa.png');
},4000);


setTimeout(function () {
    $('#slide2o4').show();
    $('#slide2o4').addClass('animated fadeIn');         
},5500);


//////////////////////////

    
    
    
}); 

</script>
    </head>
    <body style="background: #faa51a;opacity: 0;">

        <img class="img-responsive barraOff" id="slide2o1" src="<?php echo URL;?>/Recursos/img/mensaje2V3.png">
        
        <img id="slide2o2" class="LupaOff" src="<?php echo URL;?>/Recursos/img/lupaconluna.png">                                                                                   
        <img id="slide2o3" class="Lupa2Off" src="<?php echo URL;?>/Recursos/img/lupa.png">                                                               
        
<span id="slide2o4" class="texto-cabecera" style="color: white;position: absolute;left: 830px;top: 470px;width: 400px;font-size: 25pt;text-align: center"><i>"La información es más clara si la vemos como oportunidades"</i></span>
    </body>
</html>
