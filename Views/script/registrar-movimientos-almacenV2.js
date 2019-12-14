
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
                }
            });

            document.querySelector('#divcarga').style.display = 'none'
            document.querySelector('#producto').disabled = false
            document.querySelector("#producto").focus()

            //var instances2 = M.Autocomplete.init(elems2, { data: JSON.stringify(lista)});

        }

    

        // ------------------ Eventos -------------------- //

        // const $form = document.querySelector("form")

        // $form.addEventListener("submit", function(e){

        //     e.preventDefault()

        //     const data = document.querySelector('form')
        //     const form = new FormData(data)

            
        // })    

        const $categoria = document.querySelector('#CategoriaProducto')

        $categoria.addEventListener('change', function(){

            //alert(this.value)
            document.querySelector('#producto').value=''
            ListarProductos(this.value)

        })

        //---------------------------------------------//

        CargarComboTipoMovimiento()
        ListarTienda()
        ListaCategoriaProducto()

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