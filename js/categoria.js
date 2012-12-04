function addCategoria(){
    if($.validarCampos("#frmCategoria")){
            
        $.post('modules/procedures/categoria.procedure.php',
        {
            txtCategoria:$('#txtCategoria').attr('value'),
            txtType:"add"
        },
        function(data){           
            if(data=="true"){
                $.mensajeInformativo('Categoria agregada exitosamente','i');				
                $.limpiarCampos("#frmCategoria");  
                cargarComboCategoria("#selCategoria", "-");
            }else{                    
                $.mensajeInformativo('Hubo un error al guardar el Categoria. Intente de nuevo.','e');					
            }							
        }
        );
                               
    }
}

function searchCategoria(){
    if($.validarCampos("#frmSearchCategoria")){
        $.ajax({
            type: 'POST',
            url: 'modules/procedures/categoria.procedure.php',
            dataType:'html',
            data: {
                txtCategoria: $('#txtSearchCategoria').attr('value'), 
                txtType: "search"
            },
            success:function(response){
                $('#searchCategoria').html(response);
            }
        }
                        
        );           
    }
}
function selCategoria(id,des){
    $("#txtIdCategoria").attr("value", id);
    $("#txtCategoria").attr("value",des);
    $("#btnCategoria").attr("value","Guardar");
}

function updateCategoria(){
    if($.validarCampos("#frmCategoria")){
            
        $.post('modules/procedures/categoria.procedure.php',
        {
            txtIdCategoria:$('#txtIdCategoria').attr('value'),
            txtCategoria:$('#txtCategoria').attr('value'),
            txtType:"update"
        },
        function(data){
            if(data=="true"){
                $.mensajeInformativo('Categoria actualizada exitosamente','i');				
                $.limpiarCampos("#frmCategoria");
                //restableciendo botones
                $("#btnCategoria").attr("value","Agregar");
                searchCategoria();     
                cargarComboCategoria("#selCategoria", "-");
            }else{                    
                $.mensajeInformativo('Hubo un error al modificar el Categoria. Intente de nuevo.','e');					
            }							
        }
        );
                               
    }else{
        $.mensajeInformativo('Faltan campos por llenar','e');
    }
    
}


function deleteCategoria(id){
    var res=confirm("¿Desea eliminar el registro?");   
    if(res==true){
        $.post('modules/procedures/categoria.procedure.php',
        {
            txtIdCategoria:id,            
            txtType:"delete"
        },
        function(data){
            if(data=="true"){
                $.mensajeInformativo('Categoria eliminado exitosamente','i');				                
                $.limpiarCampos("#frmCategoria");
                //restableciendo botones
                $("#btnCategoria").attr("value","Agregar");
                searchCategoria();  
                cargarComboCategoria("#selCategoria", "-");
            }else{                                    
                $.mensajeInformativo('Hubo un error al eliminar el Categoria. Intente de nuevo.','e');					
            }							
        }
        );
    }
}

function cargarComboCategoria(idCaja,fijar){
    $.post('modules/procedures/categoria.procedure.php',
    {
        //txtIdPais:id,            
        txtType:"cargar",
        txtFijar:fijar
    },
    function(data){            
        $(idCaja).html(data);
    }
    );
}