function addMarca(){
    if($.validarCampos("#frmMarca")){
            
        $.post('modules/procedures/marca.procedure.php',
        {
            txtMarca:$('#txtMarca').attr('value'),
            txtType:"add"
        },
        function(data){           
            if(data=="true"){
                $.mensajeInformativo('Marca agregada exitosamente','i');				
                $.limpiarCampos("#frmMarca");  
                cargarComboMarca("#selMarca", "-");
            }else{                    
                $.mensajeInformativo('Hubo un error al guardar el Marca. Intente de nuevo.','e');					
            }							
        }
        );
                               
    }
}

function searchMarca(){
    if($.validarCampos("#frmSearchMarca")){
        $.ajax({
            type: 'POST',
            url: 'modules/procedures/marca.procedure.php',
            dataType:'html',
            data: {
                txtMarca: $('#txtSearchMarca').attr('value'), 
                txtType: "search"
            },
            success:function(response){
                $('#searchMarca').html(response);
            }
        }
                        
        );           
    }
}
function selMarca(id,des){
    $("#txtIdMarca").attr("value", id);
    $("#txtMarca").attr("value",des);
    $("#btnMarca").attr("value","Guardar");
}

function updateMarca(){
    if($.validarCampos("#frmMarca")){
            
        $.post('modules/procedures/marca.procedure.php',
        {
            txtIdMarca:$('#txtIdMarca').attr('value'),
            txtMarca:$('#txtMarca').attr('value'),
            txtType:"update"
        },
        function(data){
            if(data=="true"){
                $.mensajeInformativo('Marca actualizada exitosamente','i');				
                $.limpiarCampos("#frmMarca");
                //restableciendo botones
                $("#btnMarca").attr("value","Agregar");
                searchMarca();     
                cargarComboMarca("#selMarca", "-");
            }else{                    
                $.mensajeInformativo('Hubo un error al modificar el Marca. Intente de nuevo.','e');					
            }							
        }
        );
                               
    }else{
        $.mensajeInformativo('Faltan campos por llenar','e');
    }
    
}


function deleteMarca(id){
    var res=confirm("¿Desea eliminar el registro?");   
    if(res==true){
        $.post('modules/procedures/marca.procedure.php',
        {
            txtIdMarca:id,            
            txtType:"delete"
        },
        function(data){
            if(data=="true"){
                $.mensajeInformativo('Marca eliminada exitosamente','i');				                
                $.limpiarCampos("#frmMarca");
                //restableciendo botones
                $("#btnMarca").attr("value","Agregar");
                searchMarca();  
                cargarComboMarca("#selMarca", "-");
            }else{                                    
                $.mensajeInformativo('Hubo un error al eliminar el Marca. Intente de nuevo.','e');					
            }							
        }
        );
    }
}

function cargarComboMarca(idCaja,fijar){
    $.post('modules/procedures/marca.procedure.php',
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