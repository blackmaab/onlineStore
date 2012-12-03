//funcion para validacion de campos
jQuery.validarCampos=function(nameForm){
    var contadorErrores=0;
    var required;	
    //verificacion de type="text"
    $(nameForm + ' input:text').each(function(index){
        //verificacion si el campo esta vacio
        $(this).removeClass();
        
        required= $(this).attr('alt');
        
        if(($(this).attr('value')=="" || $(this).attr('value')==null) && required=="*"){            
            $(this).addClass('errorText');
            contadorErrores++;
        }else{
        //$(this).addClass('defaultText');		
        }
    });
		
    //verificacion de type="password"
    $(nameForm +' input:password').each(function(index){
        //verifiacion si el campo esta vacio
        $(this).removeClass();
        required= $(this).attr('alt');
        if(($(this).attr('value')=="" || $(this).attr('value')==null) && required=="*"){                        
            $(this).addClass('errorText');
            contadorErrores++;
        }else{
        //$(this).addClass('defaultText');
        }
    });
		
    //verificacion de textarea
    $(nameForm + ' textarea').each(function(index){
        //verificacion si el campo esta vacio
        $(this).removeClass();
        required= $(this).attr('alt');
        if(($(this).attr('value')=="" || $(this).attr('value')==null) && required=="*"){                    
            $(this).addClass('errorTextArea');
            contadorErrores++;
        }else{
        //$(this).addClass('contact_textarea');
        }
    });
		
    //verifiacion de select
    $(nameForm + ' select').each(function(){
        //verificacion si no se ha seleccionado nada
        $(this).removeClass();
        required= $(this).attr('alt');
        if($(this).attr('value')=="-" && required=="*"){            
            $(this).addClass('errorSelect');
            contadorErrores++;
        }else{
        //$(this).addClass('defaultSelect');
        }
    });
		
    //verifiacion de los errores
    if(contadorErrores>0){
        return false;
    }else{
        return true;
    }			
}//fin de funcion validarCampos


//validacion de tecla
jQuery.validarTecla=function(event,caja,opc){
    tecla = (document.all) ? event.keyCode : event.which;
	
    if(tecla==0 || tecla==8) return true;
    convertirTecla=String.fromCharCode(tecla);
    var valorCaja,partir,patron;
    switch(opc){
        case "nombre":
            patron=/[A-Za-zñÑáéíóúÁÉÍÓÚ\s ]{1}/;
            break;
        case "numero":
            patron=/^[0-9]{1}/;
            break;
        case "anio":
            patron=/^[0-9]{1}/;
            //verificacion que el primer numero sea 1 u 2
            if($(caja).attr('value').length==0){
                patron=/[12]{1}/;								
            }else if($(caja).attr('value').length<=3){
                patron=/[0-9]{1}/;
            }else{
                return false;
            }
            break;
        case "texto":
            patron=/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ\s:;,."¿?!¡ ]{1}/;
            break;	
        case "email":
            patron=/^[0-9a-z_.@]{1}/;
            break;	
        case "telefono":

            //verificacion que el primer numero sea 7 u 2
            if($(caja).attr('value').length==0){
                patron=/[27]{1}/;								
            }else if($(caja).attr('value').length<=8){
                patron=/[0-9]{1}/;
            }else{
                return false;
            }
			
            //agregando el guion
            if($(caja).attr('value').length==4){
                $(caja).attr('value',$(caja).attr('value')+'-');
            }
            break;
            
        case "dinero":
            patron=/[0-9.]{1}/;
            if($(caja).attr('value').length==0){
                patron=/[0-9]{1}/;								
            }else{
                var punto=$(caja).attr('value').split('.');                
                if(punto[1]!=undefined){
                    if(punto[1].length>=0 &&punto[1].length<2){                    
                        patron=/[0-9]{1}/;
                    }else{
                        return false;
                    }
                }
            //return false;
            }            
            break;
    }//switch
    //alert(String.fromCharCode(tecla));		    
    return patron.test(convertirTecla);
}//fin de funcion validarTecla

//validacion de correo
jQuery.validarEmail=function(caja){
    var patron=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;
    if(!patron.test($(caja).attr('value'))){
        $(caja).removeClass();
        $(caja).attr('title','Email no valido');
        $(caja).addClass('errorText');
        return false
    }else{
        return true;	
    }
}

//validacion de telefono 
jQuery.validarTelefono=function(caja){
    var patron=/^[0-9]{4}[-]{1}[0-9]{4}$/;
    if(!patron.test($(caja).attr('value'))){
        $(caja).removeClass();
        $(caja).attr('title','Telefono no valido');
        $(caja).addClass('errorText');
        return false
    }else{
        return true;	
    }
}

//mensajes de informacion
jQuery.mensajeInformativo=function(mensaje,tipoError){
    var titl,image,h,w,funcion;
    funcion=function(){};
    switch (tipoError){
        case 'e':
            titl='Error';
            image='images/notificacion/advertencia.png';
            w=255;
            h=100;		
            break;
            ;
		
        case 'i':
            titl='Éxito';
            image='images/notificacion/exito.png';
            w=270;
            h=100;
            break;
		
        case 'loginAdmin':
            titl='Éxito';
            image='images/notificacion/exito.png';
            w=270;
            h=100;
            funcion=function(){
                window.location='?mod=homeAdministrator';
            };
            break;
            ;
            
        case 'loginEmpresa':
            titl='Éxito';
            image='images/exito.png';
            w=270;
            h=100;
            funcion=function(){
                window.location='?mod=homeCompany';
            };
            break;
            ;

        case 'loginUser':
            titl='Éxito';
            image='images/exito.png';
            w=270;
            h=100;
            funcion=function(){
                window.location='?mod=homeUser';
            };
            break;
            ;
        case 'logout':
            titl='Información';
            image='images/informacion.png';
            w=270;
            h=100;
            funcion=function(){
                window.location='?mod=home';
            };
            break;
            ;
    }

    $.gritter.add({
        title:titl,
        text:mensaje,
        image:image
    });
            
//    $('#divMensaje')
//    .html('<img src="'+image+'" class="imgInformacion"/><div class="mensInformation">'+mensaje+'</div>')		
//    //.addClass('mensInformation')
//    .dialog({
//        title:titl,
//        draggable:false,
//        width:w,
//        height:h,
//        resizable:false,
//        show:'bounce',
//        modal:false, //pantalla congelada
//        hide: {
//            effect: 'explode', 
//            direction: 'down',
//            speed:'slow'
//        } ,
//        position:['right','top'],
//        /*buttons:{
//            "Ok":function(){
//                $(this).dialog("close");
//                funcion();
//            }
//        },*/
//        close:function(){
//            funcion();
//        }
//    });
//        
//    setTimeout('$("#divMensaje").dialog("close");', 5000);
        
}



jQuery.limpiarCampos=function(nameForm){	
    //limpiando type="text"
    $(nameForm + ' input:text').each(function(index){
        $(this).attr('value','');
    });
		
    //limpiando type="password"
    $(nameForm +' input:password').each(function(index){
        $(this).attr('value','');
    });
		
    //limpiando textarea
    $(nameForm + ' textarea').each(function(index){
        $(this).attr('value','');
    });
		
    //limpiando select
    $(nameForm + ' select').each(function(){
        $(this).attr('value','-');
    });
}//fin de funcion limpiarCampos


