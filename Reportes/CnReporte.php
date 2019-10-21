<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Conectando, seleccionando la base de datos
$link = mysql_connect('localhost', 'publifac_userbd', 'Publifac2354#')   or die('No se pudo conectar: ' . mysql_error());
//echo 'Connected successfully';
mysql_select_db('publifac_sigop',$link) or die('No se pudo seleccionar la base de datos');

?>