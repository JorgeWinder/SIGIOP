
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

        // ------------------ Funciones -------------------- //

        async function ConsultarPedido(pedido){

            let suma = 0.00

            const data_pedido = await getData("./api-sigop/pedido/getPedidoNC?idPedido=" + pedido)

            if(data_pedido.Respuesta.length>=1){

                console.log(data_pedido.Respuesta[0])

                document.querySelector('#dni').value = data_pedido.Respuesta[0].RucDnICL
                document.querySelector('#cliente').value = data_pedido.Respuesta[0].RazonSocial
                document.querySelector('#idColaborador').value = data_pedido.Respuesta[0].idColaborador
                document.querySelector('#atendido').value = data_pedido.Respuesta[0].NombresCol
                document.querySelector('#idTienda').value = data_pedido.Respuesta[0].idTienda
                document.querySelector('#nombretienda').value = data_pedido.Respuesta[0].NombreTienda
                document.querySelector('#EstadoPedidoID').value = data_pedido.Respuesta[0].EstadoPedidoID
                document.querySelector('#estado').value = data_pedido.Respuesta[0].EstadoPedido
                document.querySelector('#EmpresaRuc').value = data_pedido.Respuesta[0].EmpresaRuc            
                document.querySelector('#empresa').value = data_pedido.Respuesta[0].NombreEmpresa            
                document.querySelector('#EstadoCobroID').value = data_pedido.Respuesta[0].EstadoCobroID
                document.querySelector('#EstadoCobro').value = data_pedido.Respuesta[0].EstadoCobro
                document.querySelector('#tablapedido').children[1].innerHTML = data_pedido.Respuesta[0].detalle

                // document.querySelector('#MontoEfectivo').value = data_pedido.Respuesta[0].MontoEfectivo 
                // document.querySelector('#MontoDeposito').value = data_pedido.Respuesta[0].MontoDeposito
                // document.querySelector('#MontoSaldo').value = data_pedido.Respuesta[0].MontoSaldo
                
                suma = parseFloat(document.querySelector('#MontoEfectivo').value) + parseFloat(document.querySelector('#MontoDeposito').value) + parseFloat(document.querySelector('#MontoSaldo').value)
                //document.querySelector('#total').value = suma.toFixed(2)
                

                document.querySelectorAll('.btnEliminar').forEach(element => {
                    element.addEventListener('click', function(){
                        element.parentNode.parentNode.remove()
                        CalcularTotal()
                        recalcularTotal()
                    })
                });

                CalcularTotal()
                recalcularTotal()

                document.querySelector('#btnRegistrarNC').disabled = false
                document.querySelector('#nc').value = ''

            }else{
                alert('No existen datos para el pedido ' + pedido)
            }

            
        } 

        async function RegistrarNotaCreditoCabecera(form){


            // FECHA AUTOMÁTICA
            var d = new Date();
            var n = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate())).slice(-2);
            
            /*
                RucDnICL: $("#idcliente").val() , idTienda: $("#idtienda").val() , idColaborador: $("#colaborador").val() , FechaEntrega: $("#fechaentrega").val() , EmpresaRuc: $("#empresa option:selected").attr("value") , EstadoPedido: estado , MontoEfectivo : $("#MontoEfectivo").val() , MontoDeposito : $("#MontoDeposito").val() , Nota: $("#nota").val() , MontoSaldo: $("#MontoSaldo").val()
                FechaEntrega
                EstadoPedido = R
            */

            const url = './api-sigop/pedido/add'

            form.append('FechaEntrega', n)
            form.append('TipoComprobante', 'NC')
            form.append('RucDnICL', form.get('dni'))
            form.delete('dni')
            form.set('EstadoCobro','C')
            form.set('EstadoPedido', 'R')

            form.set('MontoEfectivo', document.querySelector('#MontoEfectivo').value * -1)  
            form.set('MontoDeposito', document.querySelector('#MontoDeposito').value * -1)  
            form.set('MontoSaldo', document.querySelector('#MontoSaldo').value  * -1)  

            for (const key of form.keys()) {            
                console.log(`${key} -> ${form.get(key)}`)
            }

            const nc = await postData(url,form)
            //alert(`Nota de crédito ${nc.Respuesta[0].Id}`)
            console.log(`Nota de crédito ${nc.Respuesta[0].Id}: Cabecera registrada`)

            await RegistrarNotaCreditoDetalle(nc.Respuesta[0].Id,form)

        }
        

        async function RegistrarNotaCreditoDetalle(nc,form){

            const $detalle = document.querySelector('#tablapedido').children[1].querySelectorAll('tr')

                form.append('StockMoviento','')

                $detalle.forEach(async element => {


                    // idPedido: idPedido, idProducto: idProducto, Cantidad: Cantidad, PrecioUnit: PrecioUnit, PrecioTotal: PrecioTotal, Desct: Desct
                    // Datos para detalle de pedido //

                    form.append('idPedido',nc)
                    form.append('idProducto', element.children[1].querySelector('input').value)
                    form.append('Cantidad', element.children[2].querySelector('input').value)
                    form.append('PrecioUnit', element.children[3].querySelector('input').value * -1)
                    form.append('PrecioTotal', element.children[4].querySelector('input').value * -1)
                    form.append('Desct', element.children[5].querySelector('input').value * -1)

                    // idTipoMovimiento: 5 , idTienda: $("#idTienda").val() , StockMoviento: StockMoviento , idProducto: $("#idProducto" + index).val() , idColaborador: $("#idColaborador").val() , idPedido: $("#pedido").val() 
                    // Datos para movimiento  de almacen

                    form.append('idTipoMovimiento', 2)
                    form.set('StockMoviento', element.children[2].querySelector('input').value)

                    alert(form.get('StockMoviento'))

                    for (const key of form.keys()) {            
                        console.log(`${key} -> ${form.get(key)}`)
                    }
        
                    postData('./api-sigop/detallepedido/add', form)
                    postData('./api-sigop/MovimientoAlmacenOP/add', form)

                    console.log(`Detalle producto - ${form.get('idProducto')} - registrado`)

                });

                document.querySelector('#btnRegistrarNC').disabled = true
                document.querySelector('#btnImprimirCobro').disabled = false
                document.querySelector('#nc').value = nc
                
                alert(`Registrada: Nota de crédito ${nc}`)

        }


        function recalcularTotal(){

            const $detalle = document.querySelector('#tablapedido').children[1].querySelectorAll('tr')

            $detalle.forEach(async element => {
                element.children[2].querySelector('input').addEventListener('input',function(){
                    element.children[4].querySelector('input').value = parseFloat(element.children[3].querySelector('input').value  * this.value).toFixed(2)
                    CalcularTotal()
                })                
            });

        }

        function CalcularTotal(){

            const $detalle = document.querySelector('#tablapedido').children[1].querySelectorAll('tr')
            let suma = 0.00

            $detalle.forEach(async element => {

                suma = suma + parseFloat(element.children[4].querySelector('input').value)
                                
            });

            document.querySelector('#MontoEfectivo').value = suma.toFixed(2)
            document.querySelector('#total').value = document.querySelector('#MontoEfectivo').value
        }

        // ------------------ Eventos -------------------- //

        const $form = document.querySelector("form")

        $form.addEventListener("submit", function(e){

            e.preventDefault()

            const data = document.querySelector('form')
            const form = new FormData(data)

            if (confirm('¿Confirma registrar nota de crédito?')) {

                if ((document.querySelector('#MontoEfectivo').value == document.querySelector('#total').value) || (document.querySelector('#MontoDeposito').value == document.querySelector('#total').value) ) {
                    RegistrarNotaCreditoCabecera(form) 
                }else{
                    alert('El monto efectivo o depósito no coinciden con el total')
                }
               
            }
            
        })    


        const $pedido = document.querySelector("#pedido")

        $pedido.addEventListener("keydown", function(e){

            if(e.which == 13){

                ConsultarPedido($pedido.value)

            }

        })

        document.querySelector('#pedido').addEventListener('click', function(){
            this.select()
        })


        // Bloqueo de submit en inputs al presionar enter

        const inputs = document.querySelectorAll("form")

        inputs.forEach(element => {
            element.addEventListener("keypress",function(e){
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) { 
                    e.preventDefault();
                    return false;
                }
            })    
        });



    })()



})


//  https://stackoverflow.com/questions/43742840/how-to-get-element-by-name-with-key