
document.addEventListener("DOMContentLoaded", function(){

    
    (async function Load(){
            
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);

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

        async function CargarComboTipoMovimiento(){

            const lista = await getData('./api-sigop/tipomovimiento/getTipo')
            document.querySelector('#tipomovimiento').innerHTML= lista

        }

        async function ListarTienda(){

            const lista = await getData('./api-sigop/area/ListarTienda')
            document.querySelector('#cbotiendades').innerHTML= lista

        }

        async function ListaCategoriaProducto(){

            const lista = await getData('./api-sigop/producto/getTipo')
            document.querySelector('#CategoriaProducto').innerHTML= lista
            

        }

        instances2 = null;

        async function ListarProductos(categoria){

            document.querySelector('#divcarga').style.display = 'block'
            document.querySelector('#producto').disabled = true


            const lista = await getData('./api-sigop/producto/getLista?idTienda=' + document.querySelector('#idTienda').value + '&idCategoriaProducto=' + categoria)
            let objdata = new Object()

            await lista.forEach(element => {
                console.log(element.NombreProducto)
                objdata[`${element.idProducto.padStart(3,"0")} - ${element.NombreProducto} &nbsp;&nbsp;&nbsp; ➤➤ Stock: ${element.getStock}`]= null
            });

            console.log(objdata)

            var elems2 = document.querySelectorAll('.autocomplete');
            instances2 = M.Autocomplete.init(elems2, { 
                data: objdata,
                onAutocomplete: function(txt) {
                    //alert(txt.split('-')[0].trim());
                    ListarMovimientos(txt.split('-')[0].trim())
                    document.querySelector('#idProducto').value = txt.split('-')[0].trim()

                }
            });

            document.querySelector('#divcarga').style.display = 'none'
            document.querySelector('#producto').disabled = false
            document.querySelector("#producto").focus()

            //var instances2 = M.Autocomplete.init(elems2, { data: JSON.stringify(lista)});

        }

        async function ListarMovimientos(producto){

            document.querySelector('#detamov').children[1].innerHTML = ''

            const lista = await getData('./api-sigop/MovimientoAlmacen/getMovimientos?idTienda=' + document.querySelector('#idTienda').value + '&idProducto=' + producto)

            document.querySelector('#detamov').children[1].innerHTML = lista
            document.querySelector('#detamov').children[1].querySelectorAll('tr').forEach(element => {
              
                element.querySelector('button').addEventListener('click', async function(){
                    //alert(element.querySelector('input').value)

                    const form = new FormData()
                    form.append('idMovimientoAlmacen', element.querySelector('input').value)

                    if(confirm('Confirma eliminar movimiento?')){

                        await postData('./api-sigop/MovimientoAlmacenID/delete', form)
                        element.querySelector('input').parentNode.parentNode.remove()
                        alert('Movimiento eliminado')
                        //alert(form.get('idMovimientoAlmacen'))
                    }


                })

            });
            

        }


        async function RegistrarMovimiento(form){

            // url: './api-sigop/MovimientoAlmacen/add',
            // data:  {idTipoMovimiento: tipomovimiento , idTienda: origen , StockMoviento: StockMoviento , idProducto: idProducto , 
            // idColaborador: idColaborador, GuiaRemision: GuiaRemision, idTiendaDestino: idTiendaDestino, ValorCompra: ValorCompra },

            if(confirm('¿Confirma registar movimiento?')){

                const producto = document.querySelector('#idProducto').value

                form.append('idTipoMovimiento', form.get("tipomovimiento"))
                form.append('StockMoviento', form.get("stock"))
                form.append('GuiaRemision', form.get("nrodoc"))
                form.append('idTiendaDestino', form.get("cbotiendades"))
                form.append('ValorCompra', form.get("vcompra"))
        
                await postData('./api-sigop/MovimientoAlmacen/add',form)

                ListarMovimientos(producto)
                alert('Movimiento registrado')


            }

        }

        // ------------------ Eventos -------------------- //

        const $form = document.querySelector("form")

        $form.addEventListener("submit", function(e){

            e.preventDefault()

            const data = document.querySelector('form')
            const form = new FormData(data)
            RegistrarMovimiento(form)

            
        })    

        const $categoria = document.querySelector('#CategoriaProducto')

        $categoria.addEventListener('change', function(){

            //alert(this.value)
            document.querySelector('#producto').value=''
            ListarProductos(this.value)

        })

        const $tipomovimiento = document.querySelector('#tipomovimiento')

        $tipomovimiento.addEventListener('change', function(){

            document.querySelector('#vcompra').value = ''
            document.querySelector('#stock').value = 0
            
            if(this.value==6){
                document.querySelector('#etiquetadoc').textContent = "Número de guia remisión" 
                document.querySelector('#cbotiendades').disabled = false
                document.querySelector('#vcompra').disabled = true
                document.querySelector('#nrodoc').disabled = false
                
            }else if(this.value==1){ 
                document.querySelector('#etiquetadoc').textContent = "Número de documento de compra"            
                document.querySelector('#vcompra').disabled = false
                document.querySelector('#nrodoc').disabled = false
                document.querySelector('#vcompra').value = 0          
            }else{
                document.querySelector('#cbotiendades').disabled = true
                document.querySelector('#etiquetadoc').textContent = "Número de guia / documento de compra"   
                document.querySelector('#nrodoc').disabled = true
                document.querySelector('#vcompra').disabled = true
            }



        })

        //---------------------------------------------//

        CargarComboTipoMovimiento()
        ListarTienda()
        ListaCategoriaProducto()


        document.querySelector('#producto').value= ''
        document.querySelector('#cbotiendades').disabled = true
         
        producto

        //---------------------------------------------//

        document.querySelector('#producto').addEventListener('click', function(){
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

        //---------------------------------------------//
        

    })()


})


//  https://stackoverflow.com/questions/43742840/how-to-get-element-by-name-with-key