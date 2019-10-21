$(document).ready(function () {


    $('body').keydown(function (e) {
                
                if (e.which == 13) {                    
                    Login();
                }     
    });


    $("#ingresar").click(function (){
 
        Login();

    }); 




});



function Login(){


            if($("#usuario").val()!='' && $("#password").val()!='')
            {                                                  
                
                $.ajax({
                    type: 'POST',
                    url: './api-sigop/usuario/acceso-colaborador',                    
                    data:  {dni: $("#usuario").val() , password: $("#password").val()},
                    success: function (response) {
                          var obj = $.parseJSON(response);
                          obj ? window.location.href = './pagina-de-inicio' : alert("Verifique su usuario y/o password");
                    },
                    error: function (response) {
                        alert("Hubo un error");
                    }
                });                                
            }else{
                alert("Debes ingresar tu usuario y password");
            }



}


