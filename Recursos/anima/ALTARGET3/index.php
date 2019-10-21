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
$('#slide2o4').hide();

////////////////////////

setInterval(function () {

    $('#slide2o1').show();
    $('#slide2o1').addClass('animated fadeIn');     
        
},1000);


setInterval(function () {
    $('#slide2o2').show();  
    $('#slide2o2').addClass('animated fadeIn');

},3000);

setInterval(function () {

    $('#slide2o3').show();
    $('#slide2o3').addClass('animated fadeIn');     
        
},5000);

setInterval(function () {
    
    $('#slide2o3').addClass('animated fadeOut');     
        
},7000);


setInterval(function () {

    $('#slide2o4').show();
    $('#slide2o4').addClass('animated fadeIn');     
        
},9000);

//////////////////////////

    
    
    
}); 

</script>
    </head>
    <body style="background: #faa51a;opacity: 0;">

<!--                    <img id="slide2o1" style="position: relative;left: 80px;top: 100px;" src="<?php echo URL;?>/Recursos/img/mensaje3-part1.png">
                    <img id="slide2o2" style="position: relative;left: -100px;top: 190px;" src="<?php echo URL;?>/Recursos/img/mensaje3-part2.png">-->
                    
                    <div id="slide2o3" class="text-center" style="position: absolute;right: 100px;top: 250px;">
                        <span class="texto-cabecera" style="color: white;line-height: 70px;text-shadow: 0 0 8px black;font-size: 55pt;">No solo vemos<br>infomación</span>
                    </div>
                    
                    <div id="slide2o4" class="text-center" style="position: absolute;right: 100px;top: 250px;">
                        <span class="texto-cabecera" style="color: white;line-height: 70px;text-shadow: 0 0 8px black;font-size: 55pt;">Vemos las<br>oportunidades</span>
                    </div>
                                        
                    
    </body>
</html>
