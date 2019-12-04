/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 $(document).ready(function () {

            $('[data-toggle="popover"]').popover();

            // FECHA AUTOMÁTICA
            var d = new Date();
            var n = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate())).slice(-2);
            $('#fechapedido').val(n);
            $('#fechaentrega').val(n);
            
            //$("#empresa option[value=1]").attr('selected', 'selected');
     
            //AGREGAR DETALLE DEL PEDIDO
            $("#BtnAdd").click(function () {
                var cant = $("#tablapedido tr").length;
                //var contenido = "<tr><td align='center'>" + cant + "</td><td><input id='nompro" + cant + "' type='text' placeholder='Ingresar producto' class='form-control' onkeyup='autocompleta(" + cant + ")'><input type='hidden' id='codpro" + cant + "' value=''><ul id='autoproducto" + cant + "' class='list-group'></ul></td><td><input id='cantidad" + cant + "' onchange='CalValTotal(" + cant + ",this.value)' class='form-control' type='number' required maxlength='2' value='0'></td><td><select id='preciounit" + cant + "' class='form-control'><option value='0'>---</option></select></td><td><input id='total" + cant + "' class='form-control' onkeyup='CalPreUnit(" + cant + ",this.value)' onclick='CalPreUnit(" + cant + ",this.value)' value='0.00' readonly='true'><input id='totalx" + cant + "' type='hidden' value='0.00'><input id='stockmax" + cant + "' type='hidden' value='0'></td><td><button class='btn btn-danger' id='BtnDelete'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Eliminar</button></td><td style='width: 150px;'><div class='form-group'><div class='radio'><label><input id='Pormayor" + cant + "' type='checkbox' value='" + cant + "'> POR MAYOR</label></div></div></td><td></td></tr>";
                var contenido = "<tr><td align='center'>" + cant + "</td><td><input id='nompro" + cant + "' type='text' placeholder='Ingresar producto' class='form-control' onkeyup='autocompleta(" + cant + ")'><input type='hidden' id='codpro" + cant + "' value=''><ul id='autoproducto" + cant + "' class='list-group'></ul></td><td><input id='cantidad" + cant + "' onchange='CalValTotal(" + cant + ",this.value)' class='form-control' type='number' required maxlength='2' value='0'></td><td><select id='preciounit" + cant + "' class='form-control'><option value='0'>---</option></select></td><td><input id='total" + cant + "' class='form-control' value='0.00' readonly='true'><input id='totalx" + cant + "' type='hidden' value='0.00'><input id='stockmax" + cant + "' type='hidden' value='0'></td><td><button class='btn btn-danger' id='BtnDelete'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Eliminar</button></td><td style='width: 150px;'><div class='form-inline'><input id='Desct" + cant + "' type='number' class='form-control'  value='0.00' style='width: 81px; margin-right: 10px;'><label for='Desct1'> DESC.</label></div></td><td></td></tr>";
                $("#tablapedido").append(contenido);  
                      
            });
            
            //ELIMINAR PRODUCTO
            $(document).on("click", "#BtnDelete", function () {
                if ($("#tablapedido").find('tr').length > 2)
                {
                    $(this).parents().get(1).remove();
                }
                
                $("#tablapedido tr").each(function (index) {
                    if (index > 0)
                    {
                        $(this).children('td').eq(0).text(index.toString());

                        $(this).children('td').eq(1).children('input').eq(0).prop("id","nompro" + index.toString());
                        $(this).children('td').eq(1).children('input').eq(0).attr("onkeyup","autocompleta(" + index.toString() + ")");
                        $(this).children('td').eq(1).children('input').eq(1).prop("id","codpro" + index.toString());
                        $(this).children('td').eq(1).children('ul').eq(0).prop("id","autoproducto" + index.toString());

                        $(this).children('td').eq(2).children('input').eq(0).prop("id","cantidad" + index.toString());
                        $(this).children('td').eq(2).children('input').eq(0).attr("onchange","CalValTotal(" + index.toString() + ",this.value)");

                        $(this).children('td').eq(3).children('select').eq(0).prop("id","preciounit" + index.toString());

                        $(this).children('td').eq(4).children('input').eq(0).prop("id","total" + index.toString());
                        //$(this).children('td').eq(4).children('input').eq(0).attr("onkeyup","CalPreUnit(" + index.toString() + ",this.value)");
                        //$(this).children('td').eq(4).children('input').eq(0).attr("onclick","CalPreUnit(" + index.toString() + ",this.value)");
                        $(this).children('td').eq(4).children('input').eq(1).prop("id","totalx" + index.toString());
                        $(this).children('td').eq(4).children('input').eq(2).prop("id","stockmax" + index.toString());

                        $(this).children('td').eq(6).children('.form-inline').eq(0).children('input').eq(0).prop("id","Desct" + index.toString());
                    }
                });

                CalValTotalGeneral();

            });     
            
            //REGISTRAR PEDIDO
            
            $("#btnRegistrarPedido").click(function () {
                
                if(confirm("¿CONFIRMA REGISTRAR PEDIDO?"))
                {
                    // alert("PEDIDO REGISTRADO:\n\n1700001");  'abc'.padStart(10, "0");
                    
                        RegistrarPedido();                      
                }
                                
            });

            //REGISTRAR CLIENTE

            $("#nuevocli").click(function () {

                window.open ("./mantenimiento-de-cliente","Registrar cliente","menubar=1,resizable=1,width=500,height=550,left=300,top=80");                 
            
            });

            //VER DATOS CLIENTE
            
                    
            $("#vercli").click(function () {

                window.open ("./datos-de-cliente?dni=" + $("#idcliente").val(),"Registrar cliente","menubar=1,resizable=1,width=450,height=550,left=300,top=80");                 
            
            });

            ///-------- PANEL BUSQUEDA ----- ///

            $("#btnNuevo").click(function () {

                location.reload();
            
            });

            ///-------- VALIDAR ACCESO A DESCUENTO ----- ///

            $('#acceso').keydown(function (e) {
                        
                if (e.which == 13) {                	

                    if ($('#acceso').val()==235411) {
                        valoracceso=1;
                        pase=1;
                        $('#acceso').val("");
                        $("#panelacceso").css({"display": "none"});                        
                        //alert("ACCESO VALIDO.\n\nPor favor, ahora presione el botón 'Registrar pedido'");   
                        if (confirm("ACCESO VALIDO.\n\n¿ Confirma registrar pedido ?")) {
                            RegistrarPedido();                         
                        }                        
                    }else{ alert("EL ACCESO NO ES VALIDO."); }

                } 
    
            });

                                        
 });


 

 function VistaPanelBusqueda(){

    if($("#busqueda").css("display")=="block"){

        $("#busqueda").css({"display": "none"});

    }else if($("#busqueda").css("display")=="none"){

        $("#busqueda").css({"display": "block"});        
        $("#autocliente li").remove();
        $("#cliente").val("");
        $("#cliente").focus();
    }


 }


  function VistaPanelNotas(){

    if($("#panelnotas").css("display")=="block"){

        $("#panelnotas").css({"display": "none"});

    }else if($("#panelnotas").css("display")=="none"){

        $("#panelnotas").css({"display": "block"});                          
        $("#nota").focus();
    }


 }




 function VistaPanelAcceso(){

    if($("#panelacceso").css("display")=="block"){

        $("#panelacceso").css({"display": "none"});

    }else if($("#panelacceso").css("display")=="none"){

        $("#panelacceso").css({"display": "block"});                          
        $("#nota").focus();
    }


 }


 var valoracceso=1;
 var pase=0;


function RegistrarPedido(){


                var str = "REGISTRADO";
                estado = str.substring(0, 1);
                cantidadcero=1;

                // Validar cantidades desct
                
                $("#tablapedido tr").each(function (index) {
                              if (index > 0)
                              {                        
            
                                    if( cantidadcero!=0 && $(this).children('td').eq(6).children('.form-inline').eq(0).children('input').eq(0).val() > 0.00 ){                                                            
                                        if(pase==0){
                                            valoracceso=0; 
                                            $("#panelacceso").css({"display": "block"});  
                                        }                                
                                    }    
                                                                                
                              
                              }                                          
                });
                

                // Validar cantidades en cero
                
                $("#tablapedido tr").each(function (index) {
                    if (index > 0)
                    {
                        if( parseFloat($(this).children('td').eq(2).children('input').eq(0).val()) == 0.00 ){
                            cantidadcero=0;                                                                                 
                        }                 
                                                    
                    }                                          
                });

               
                // ---Suma de total---
                sumatotal =  parseFloat($("#MontoEfectivo").val()) + parseFloat($("#MontoDeposito").val()) + parseFloat($("#MontoSaldo").val()); 
                //--------------------
                
                if( sumatotal==parseFloat($("#total").val()) ){


                    //--------------------------------------------//

                    
                        if(cantidadcero!=0){


                            if( $("#idcliente").val()!="" && $("#empresa").val() > 0){

                                if(valoracceso==1){

                                    $.ajax({
                                    type: "POST",
                                    url: './api-sigop/pedido/add',
                                    data:  {RucDnICL: $("#idcliente").val() , idTienda: $("#idtienda").val() , idColaborador: $("#colaborador").val() , FechaEntrega: $("#fechaentrega").val() , EmpresaRuc: $("#empresa option:selected").attr("value") , EstadoPedido: estado , MontoEfectivo : $("#MontoEfectivo").val() , MontoDeposito : $("#MontoDeposito").val() , Nota: $("#nota").val() , MontoSaldo: $("#MontoSaldo").val() , TipoComprobante: 'NP' },
                                    success: function (response) {
                                                    var obj = $.parseJSON(response);                                       
                                                    $("#pedido").val(obj.Respuesta[0].Id);
                                                    RegistrarDetallePedido(obj.Respuesta[0].Id);                                       
                                                    $("#btnRegistrarPedido").prop("disabled","true");

                                                    const $despacho = document.querySelector('#despacho')
                                                    if ($despacho) {


                                                        $.ajax({
                                                            type: "POST",
                                                            url: './api-sigop/entrega/add',
                                                            data:  {idPedido: $("#pedido").val() , Encargado: $("#Encargado").val().toUpperCase() , Destino: $("#Destino").val().toUpperCase(), Receptor: $("#Receptor").val().toUpperCase() },
                                                            success: function (response) {
                                                                            var obj = $.parseJSON(response);                                       
                                                                            console.log("Se registro entrega de pedido")
                                                                            
                                                                }
                                                            });

                                                        
                                                    }

                                                    alert("PEDIDO " + obj.Respuesta[0].Id + ", REGISTRADO"); 
                                                    pase=0;                                            
                                                    
                                        }
                                    });

                                }else{ alert("EXISTEN VALORES DE DESCUENTO.\nNECESITA EL ACCESO DEL ADMINISTRADO.");}

                            }else{ alert("FLATAN COMPLETAR DATOS DE PEDIDO"); } 

                        }else{ alert("EXISTEN CANTIDADES EN CERO");}

                    
                    

                    //--------------------------------------------//                  


                }else{

                  alert("Los  montos de efectivo, depósito y saldo no suman el monto total");
                }



              
 }


 function RegistrarDetallePedido(pedido){

                        $("#tablapedido tr").each(function (index) {
                            if (index > 0)
                            {   

                                /*if($('#Radio_' + index + '_1').prop("checked")==true){
                                    Asistio=1;
                                }else{
                                    Asistio=0;
                                }*/

                                //InsertarDetalle( pedido , $("#codpro" + index).val() , $("#cantidad" + index).val() , $("#preciounit" + index).val() , $("#total" + index).val() );
                                InsertarDetalle( pedido , $("#codpro" + index).val() , $("#cantidad" + index).val() , $("#preciounit" + index).val() , $("#total" + index).val() , $("#Desct" + index).val() );
                                
                            }
                        });

    
 }


 function InsertarDetalle(idPedido , idProducto , Cantidad , PrecioUnit , PrecioTotal , Desct){

            $.ajax({
               type: "POST",
               url: './api-sigop/detallepedido/add',
               data:  {idPedido: idPedido, idProducto: idProducto, Cantidad: Cantidad, PrecioUnit: PrecioUnit, PrecioTotal: PrecioTotal, Desct: Desct },
               success: function (response) {
                              var obj = $.parseJSON(response);                      
                               //obj ? alert("ASISTENCIA REGISTRADA") : alert("HUBO PROBLEMAS AL REGISTRAR LA ASISTENCIA");
                              
                    }
            });

 }



//BUSQUEDA AUTOCOMPLETADO PRODUCTO

 function autocompleta(itempro){
        
        //$(".list-group li").remove();

        if($("#nompro" + itempro).val()!="")
        {

            $.ajax({
               type: "POST",
               url: './api-sigop/producto/busqueda',
               data:  {NombreProducto: $("#nompro" + itempro).val() , idTienda: $("#idtienda").val() },
               success: function (response) {
                              var obj = $.parseJSON(response);             
                              $("#autoproducto" + itempro).css("display","block");                 
                              $("#autoproducto" + itempro +" li").remove();

                              for (var i = 0; i < obj.length; i++) {
                                  //alert(obj[i].idProducto.toString());
                                   //textoprecios= "<a href='javascript:void()' style='text-decoration:none; position: absolute;' data-toggle='popover' title='Precios' data-trigger='click' data-html='true' data-content='" + obj[i].PrecioVenta.toString()  + "<br> l2'> <span class='label label-info'>Ver precios</span> </a>"; // + "<span style='background-color: white;cursor: pointer;' title='Información' data-toggle='popover' data-trigger='hover' data-html='true' data-content='¿Ha olvidado su comtraseña?'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span></span>"; 
                                   let textoprecios= " <span class='label label-default'>PV : " + obj[i].PrecioVenta.toString() + "</span>";
                                   textoprecios = textoprecios + " <span class='label label-default'>PM : " + obj[i].PrecioxMayor.toString() + "</span>";                                   
                                   textoprecios = textoprecios + " <span class='label label-default'>PF : " + obj[i].PrecioVenta2.toString() + "</span>";                                   
                                   textoprecios = textoprecios + " <span class='label label-default'>PL : " + obj[i].PrecioVenta3.toString() + "</span>";                                   

                                    if(obj[i].getStock > 0){
                                        html="<a href='javascript:setProducto("+ itempro +","+ obj[i].idProducto.toString() +",\"" + obj[i].NombreProducto.toString() + "\"," + obj[i].PrecioVenta.toString() + ","  + obj[i].PrecioVenta2.toString() + ","  + obj[i].PrecioVenta3.toString() + "," + obj[i].PrecioxMayor.toString() + "," + obj[i].getStock.toString() + ")' style='text-decoration:none;'><li class='list-group-item'>" + obj[i].idProducto.toString() + " - " + obj[i].NombreProducto.toString() + " <span class='label label-primary'>STOCK : " + obj[i].getStock.toString() + "</span></li></a>";    
                                    }else{
                                        html="<li class='list-group-item'><a href='javascript:void()' style='text-decoration:none;'>" + obj[i].idProducto.toString() + " - " + obj[i].NombreProducto.toString() + " <span class='label label-danger'>STOCK : " + obj[i].getStock.toString() + "</span></a> " + textoprecios + "</li>";                                            
                                    }
                                    
                                    $("#autoproducto" + itempro).append(html);
                              }

                              //obj ? alert("CLIENTE REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL CLIENTE");
                    }
            });	 

        }else{ $("#autoproducto" + itempro + " a").remove(); }


 }

 

 function setProducto(item,cod,nombre,preciounit,preciounit2,preciounit3,PrecioxMayor,stockmax){

    $("#autoproducto" + item).css("display","none");
    $("#nompro" + item).val(nombre);
    //$("#nompro" + item).prop("readonly",true);
    $("#nompro" + item).prop("disabled",true);
    //$("#preciounit" + item).prop("readonly","");
    $("#total" + item).prop("readonly","true");   

    $("#codpro" + item).val(cod);
    //$("#preciounit" + item).val(preciounit.toFixed(2));
    var cadena= "<option value=" + preciounit + ">" + preciounit + " (PV)</option><option value=" + PrecioxMayor + ">" + PrecioxMayor + " (PM)</option><option value=" + preciounit2 + ">" + preciounit2 + " (PF)</option><option value=" + preciounit3 + ">" + preciounit3 + " (PL)</option>";
    $("#preciounit" + item).append(cadena);
    //$("#preciounit" + item + " option:selected").attr("value")==$("#preciounit" + item).val(preciounit);

    var total = parseFloat($("#cantidad" + item).val()).toFixed(2) * parseFloat($("#preciounit" + item).val()).toFixed(2);
    
    $("#total" + item).val(total.toFixed(2));    
    $("#totalx" + item).val(PrecioxMayor.toFixed(2).toString());

    $("#stockmax" + item).val(stockmax);


    $("input[type='checkbox']").click(function () {                    

        var itemx = $(this).val();
        
        //$("#preciounit" + itemx).val($("#totalx" + itemx).val());
        //var total = parseFloat($("#cantidad" + itemx).val()).toFixed(2) * parseFloat($("#preciounit" + itemx).val()).toFixed(2);    
        //$("#total" + itemx).val(total.toFixed(2)); 

        //CalValTotalGeneral();

    });

    $("[id*=preciounit]").change(function () {
                //alert("dfgfd");
                                        
                      lista = $(this).prop("id").split("preciounit");
                      var i=lista[1];
                            
                      var total = (parseFloat($("#cantidad" + i).val()).toFixed(2) * parseFloat($("#preciounit" + i).val()).toFixed(2)) - parseFloat($("#Desct" + i).val()).toFixed(2);  
                      $("#total" + i).val(total.toFixed(2));   
                      
                      CalValTotalGeneral();

                         
    });

    $("[id*=Desct]").change(function () {
        CalValTotalGeneral();
    });    


    CalValTotalGeneral();

    $("#cantidad" + item).focus();

 }


 function CalPreUnit(item,valor){

    var PrecioUnit = parseFloat(valor).toFixed(2) / parseFloat($("#cantidad" + item).val()).toFixed(2);
    $("#preciounit" + item).val(PrecioUnit.toFixed(2));

    CalValTotalGeneral();

 }


 function CalValTotal(item,valor){
    //var total = parseFloat(valor).toFixed(2) * parseFloat($("#preciounit" + item).val()).toFixed(2);
    //$("#total" + item).val(total.toFixed(2));

    var total = parseFloat($("#cantidad" + item).val()).toFixed(2) * parseFloat($("#preciounit" + item).val()).toFixed(2);
    
    $("#total" + item).val(total.toFixed(2));

    // Validar Stock máximo con el valor stock ingresado
    if( parseFloat($("#cantidad" + item).val()).toFixed(2) > parseFloat($("#stockmax" + item).val()) ){

        alert("El stock ingresado es  mayor al stcok existente..");        
        $("#tablapedido tr").eq(item).css({"background-color": "#ff6666"});

    }else{
        $("#tablapedido tr").eq(item).css({"background-color": "transparent"});
    }

    $("#tablapedido tr").each(function (index) {
        if (index > 0)
        {                        
            if( $(this).css("background-color") == "rgb(255, 102, 102)" ){
                  //alert("hay rojo"); 
                  $("#btnRegistrarPedido").prop("disabled","true"); 
            }else{$("#btnRegistrarPedido").prop("disabled",""); }
            
        }
    });

    //------------------

    CalValTotalGeneral();
 }

  function CalValTotalGeneral(){

                sum=0.00;

                $("#tablapedido tr").each(function (index) {
                    if (index > 0)
                    {       
                        //td = parseFloat($("#total" + index).val()).toFixed(2) - parseFloat($("#Desct" + index).val()).toFixed(2);               
                        sum = sum + (parseFloat($("#total" + index).val()).toFixed(2) - parseFloat($("#Desct" + index).val()).toFixed(2));
                        //sum = sum + parseFloat($(this).children('td').eq(4).children('input').val());
                    }
                });              

                $("#MontoEfectivo").val(sum.toFixed(2));
                $("#total").val(sum.toFixed(2));

 }

//BUSQUEDA AUTOCOMPLETADO CLIENTE

 function autocompletacliente(){       
        
        //$(".list-group li").remove();      

        if($("#cliente").val()!="")
        {

            $.ajax({
               type: "POST",
               url: './api-sigop/cliente/busqueda',
               data:  {RazonSocial: $("#cliente").val() },
               success: function (response) {
                              var obj = $.parseJSON(response);             
                              $("#autocliente").css("display","block");                 
                              $("#autocliente li").remove();

                              for (i = 0; i < obj.length; i++) {                                  

                                  html="<a href='javascript:setCliente(\""+ obj[i].RucDnICL.toString() +"\",\"" + obj[i].RazonSocial.toString() + "\")' style='text-decoration:none;'><li class='list-group-item' style='text-align: left;'>" + obj[i].RucDnICL.toString() + " - " + obj[i].RazonSocial.toString() + "</li></a>";                                    
                                    
                                  $("#autocliente").append(html);
                              }

                              //obj ? alert("CLIENTE REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL CLIENTE");
                    }
            });  

        }else{ $("#autocliente li").remove(); }


 }

  function setCliente(RUC,NombreCliente){

    $("#idcliente").val(RUC.toString());
    $("#clientenom").val(NombreCliente);

    $("#busqueda").css({"display": "none"});

 }




 
document.addEventListener("DOMContentLoaded", function(){


    (async function Load(){

        async function getData(url){

            const response = await fetch(url);
            const data = await response.json();
            return data;
  
        }
  
        async function postData(url, form){
  
              const response = await fetch(url,
                {
                  method: "POST",
                  body: form
                }
                );    
                const data = await response.json();              
                return data;                          
        }


       // ------------------ Funciones --------------- // 



       function GruardarDatosEntrega(){

            const data = document.querySelector('form')
            const form = new FormData(data)

            form.set('Encargado',document.querySelector('#Encargado').value.toUpperCase())
            form.set('Receptor',document.querySelector('#Receptor').value.toUpperCase())
            form.set('Destino',document.querySelector('#Destino').value.toUpperCase())
            
            for (const key of form.keys()) {            
                console.log(`${key} -> ${form.get(key)}`)
            }

            postData('./api-sigop/entrega/add', form)

       }
        

       // ------------------ Eventos --------------- // 

       const $despacho = document.querySelector('#despacho')
       
       $despacho.addEventListener('input', function(){

            if(this.checked){
                document.querySelector('#panelentrega').style.display = 'block'
                document.querySelector('#btnRegistrarPedido').disabled = true
            }else{
                document.querySelector('#panelentrega').style.display = 'none'
                document.querySelector('#Encargado').value = ''
                document.querySelector('#Receptor').value = ''
                document.querySelector('#Destino').value = ''
            }

       })


       document.querySelector('#cerrardestino').onclick = function(){

        document.querySelector('#panelentrega').style.display = 'none'
        document.querySelector('#Encargado').value = ''
        document.querySelector('#Receptor').value = ''
        document.querySelector('#Destino').value = ''
        document.querySelector('#despacho').checked = false

        document.querySelector('#btnRegistrarPedido').disabled = false

       }

       document.querySelector('#btnGuardarEntrega').onclick = function(){

        if (confirm('¿Confirma guardar los datos de despacho a domicilio?')) {

            if(document.querySelector('#Encargado').value != '' && document.querySelector('#Receptor').value != '' && document.querySelector('#Destino').value != ''){
                
                document.querySelector('#panelentrega').style.display = 'none'
                document.querySelector('#btnRegistrarPedido').disabled = false
                alert("Los datos de encargado y destino se guardarón")

            }else{
                alert("Debe registar los datos de encargado, receptor y destino")
            }
            
        }

            
       }




    })()


})