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
        
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Bootstrap -->
        <link href="<?php echo URL;?>/Recursos/css/bootstrap.min.css" rel="stylesheet">
        
         <link href="<?php echo URL;?>/Recursos/css/csi.css" rel="stylesheet">
         <link rel="stylesheet" href="<?php echo URL;?>/Recursos/css/animate.css">
         
         <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/Recursos/css/jquery.fullPage.css" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo URL;?>/Recursos/js/bootstrap.min.js"></script>
        
        <!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
        <script type="text/javascript" src="<?php echo URL;?>/WEBALTARGET/Recursos/js/vendors/scrolloverflow.min.js"></script>
        <script type="text/javascript" src="<?php echo URL;?>/WEBALTARGET/Recursos/js/jquery.fullPage.js"></script>
        
        <!-- bxSlider Javascript file -->
        <script src="<?php echo URL;?>/Recursos/js/jquery.bxslider.min.js"></script>
        <!-- bxSlider CSS file -->
        <link href="<?php echo URL;?>/Recursos/css/jquery.bxslider.css" rel="stylesheet" />      
        
<script>


$(document).ready(function(){
    
    ////////////////////////
$('body').css('opacity','1');
$('#slide2o1').hide();
$('#slide2o2').hide();
$('#slide2o3').hide();


////////////////////////

setInterval(function () {

    $('#slide2o1').show();
    $('#slide2o1').addClass('animated fadeIn');     
        
},1000);


setInterval(function () {

    $('#slide2o3').show();
    $('#slide2o3').addClass('animated fadeInRight');     
        
},3000);


//////////////////////////

    
    
    
}); 

</script>
    </head>
    <body style="background: white;opacity: 0;">

        <img id="slide2o1" style="position: relative;left: 250px;top: 250px;" src="<?php echo URL;?>/Recursos/img/LogoALT-azul.png">
                    
                    <div id="slide2o3" class="text-center" style="position: absolute;right: 250px;top: 380px;">
                        <span class="texto-cabecera" style="color: #faa51a;line-height: 70px;text-shadow: 0 1px 1px black;font-size: 34pt;">Conocimiento del mercado</span>
                    </div>                                                   
                    
    </body>
</html>
