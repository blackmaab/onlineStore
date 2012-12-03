

$(document).ready(function(){
    
    $('#txtCantidad').keypress(function(event){
        return $.validarTecla(event,'#txtCantidad','numero');
    });
    
    $('#btnCar').click(function (e) {
        
        //        var unique_id =$.gritter.add({
        //            // (string | mandatory) the heading of the notification
        //            title: 'Agregado al carrito',
        //            // (string | mandatory) the text inside the notification
        //            text: 'Adaptador de Audio 3-D <br />Marca: Manhattan<br /> Cantidad: '+$('#txtCantidad').attr('value'),
        //            // (string | optional) the image to display on the left
        //            image: 'images/accesorios/adaptadorAudio.jpg',
        //            // (bool | optional) if you want it to fade out on its own or just sit there
        //            sticky: true,
        //            // (int | optional) the time you want it to be alive for before fading out
        //            time: '',
        //            // (string | optional) the class name you want to apply to that specific message
        //            class_name: 'my-sticky-class'
        //        });
        //        
        //        setTimeout(function(){
        //            $.gritter.remove(unique_id, {
        //                fade: true,
        //                speed: 'slow'
        //            });
        //
        //        }, 6000)
        return false;
    });
    
    
    $("#btnLogin").click(function(){
        //verificacion que los campos esten llenos
        if($.validarCampos("#frmLogin")==true){
            var user=$("#txtUsuario").attr("value");
            var password=$("#txtPassword").attr("value");
            
            if(user==password){
                if(user=="admin"){
                    $.mensajeInformativo('Bienvenido Administrador','loginAdmin');
                }else if(user=="empresa"){
                    $.mensajeInformativo('Bienvenida Empresa','loginEmpresa');
                    
                }else{
                    $.mensajeInformativo('Bienvenido Usuario','loginUser');
                }
            }else{
                $.mensajeInformativo('Usuario y Contraseña incorrectos','e');
            }
        }else{
            $.mensajeInformativo('Faltan campos por llenar','e');
        }    
    });
});


