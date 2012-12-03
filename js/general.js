//incluyendo mas archivos
document.write("<script type='text/javascript' src='js/jquery.simplemodal-1.4.3.js'></script>");
document.write("<script type='text/javascript' src='js/jquery.gritter.js'></script>");
document.write("<script type='text/javascript' src='js/start_validate.js'></script>");
document.write("<script type='text/javascript' src='js/categoria.js'></script>");
$(document).ready(function(){
    //validacion de formulario pais    
    $("#btnCategoria").click(function(){
        if($(this).attr("value")=="Agregar"){
            addCategoria();            
        }else{
            updateCategoria();
        }
        
    });
    
    $('#txtCategoria').keypress(function(event){
        return $.validarTecla(event,'#txtCategoria','texto');
    });
    
    //    $("#btnSearchCategoria:button").button();
    $('#btnSearchCategoria').click(function(){
        searchCategoria();
    });
});
