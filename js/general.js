//incluyendo mas archivos
document.write("<script type='text/javascript' src='js/jquery.simplemodal-1.4.3.js'></script>");
document.write("<script type='text/javascript' src='js/jquery.gritter.js'></script>");
document.write("<script type='text/javascript' src='js/start_validate.js'></script>");
document.write("<script type='text/javascript' src='js/categoria.js'></script>");
document.write("<script type='text/javascript' src='js/marca.js'></script>");
document.write("<script type='text/javascript' src='js/producto.js'></script>");

$(document).ready(function(){
    //validacion de formulario categoria    
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
    
   
    $('#btnSearchCategoria').click(function(){
        searchCategoria();
    });
    
    cargarComboCategoria("#selCategoria", "-");
    
    //validacion de formulario marca    
    $("#btnMarca").click(function(){
        if($(this).attr("value")=="Agregar"){
            addMarca();            
        }else{
            updateMarca();
        }
        
    });
    
    $('#txtMarca').keypress(function(event){
        return $.validarTecla(event,'#txtMarca','texto');
    });
    
   
    $('#btnSearchMarca').click(function(){
        searchMarca();
    });
    cargarComboMarca("#selMarca", "-");
    
    
    //validacion de formulario producto   
    $("#btnProducto").click(function(){
        if($(this).attr("value")=="Agregar"){
            addProducto();            
        }else{
            updateProducto();
        }
        
    });
    
    $('#txtProducto').keypress(function(event){
        return $.validarTecla(event,'#txtProducto','texto');
    });
    
    
    $('#txtExistenciaProducto').keypress(function(event){
        return $.validarTecla(event,'#txtExistenciaProducto','numero');
    });
    
    $('#txtCostoProducto').keypress(function(event){
        return $.validarTecla(event,'#txtCostoProducto','dinero');
    });
   
    $('#btnSearchProducto').click(function(){
        searchProducto();
    });
    
    
});
