function addProducto(){
    if($.validarCampos("#frmProducto")){
        //Revisamos si el navegador soporta el objeto FormData
        if(window.FormData){         
            //procesando la imagen
            //var inputFileImage = document.getElementById("txtImagenProducto");
            var inputFileImage = $("#txtImagenProducto")[0];
            var file = inputFileImage.files[0];
            var data = new FormData();

            data.append('txtImagenProducto',file);
            data.append('txtProducto',$('#txtProducto').attr('value'));
            data.append('idMarca',$('#selMarca').attr('value'));
            data.append('idCategoria',$('#selCategoria').attr('value'));
            data.append('txtDescripcionProducto',$('#txtDescripcionProducto').attr('value'));
            data.append('txtExistenciaProducto',$('#txtExistenciaProducto').attr('value'));
            data.append('txtCostoProducto',$('#txtCostoProducto').attr('value'));
            data.append('txtType','add');
            
            var url = "modules/procedures/producto.procedure.php";
            $.ajax({
                url:url,
                type:'POST',
                contentType:false,
                data:data,
                processData:false,  
                cache:false,
                success: function(data) {                    
                    if(data=="true"){
                        $.mensajeInformativo('Producto agregado exitosamente','i');				
                        $.limpiarCampos("#frmProducto");  
                    //cargarComboProducto("#selArea", "-");
                    }else if(data=="error"){                    
                        $.mensajeInformativo('El archivo no es una imagen.','e');

                    }else{
                        $.mensajeInformativo('Hubo un error al guardar el Producto. Intente de nuevo.','e');					
                    }	
                }
            });
        }else{
            $.mensajeInformativo('Error al subir imagen. Utilice otro navegador', 'e');  
        }                                       
    }
}

function searchProducto(){    
    if($.validarCampos("#frmSearchProducto")){
        $.ajax({
            type: 'POST',
            url: 'modules/procedures/producto.procedure.php',
            dataType:'html',
            data: {
                txtProducto: $('#txtSearchProducto').attr('value'), 
                txtTipoSearch:$('#txtTipoSearchProducto').attr('value'),
                txtType: "search"
            },
            success:function(response){
                $('#searchProducto').html(response);
            }
        }
                        
        );           
    }
}
function selProducto(id,des){
    $("#txtIdProducto").attr("value", id);
    $("#txtProducto").attr("value",des);
    $("#btnProducto").attr("value","Guardar");
}

function updateProducto(){
    if($.validarCampos("#frmProducto")){
            
        $.post('modules/procedures/producto.procedure.php',
        {
            txtIdProducto:$('#txtIdProducto').attr('value'),
            txtProducto:$('#txtProducto').attr('value'),
            txtType:"update"
        },
        function(data){
            if(data=="true"){
                $.mensajeInformativo('Producto actualizada exitosamente','i');				
                $.limpiarCampos("#frmProducto");
                //restableciendo botones
                $("#btnProducto").attr("value","Agregar");
                searchProducto();     
            //cargarComboProducto("#selArea", "-");
            }else{                    
                $.mensajeInformativo('Hubo un error al modificar el Producto. Intente de nuevo.','e');					
            }							
        }
        );
                               
    }else{
        $.mensajeInformativo('Faltan campos por llenar','e');
    }
    
}


function deleteProducto(id){
    var res=confirm("¿Desea eliminar el registro?");   
    if(res==true){
        $.post('modules/procedures/producto.procedure.php',
        {
            txtIdProducto:id,            
            txtType:"delete"
        },
        function(data){
            if(data=="true"){
                $.mensajeInformativo('Producto eliminada exitosamente','i');				                
                $.limpiarCampos("#frmProducto");
                //restableciendo botones
                $("#btnProducto").attr("value","Agregar");
                searchProducto();  
            //cargarComboProducto("#selArea", "-");
            }else{                                    
                $.mensajeInformativo('Hubo un error al eliminar el Producto. Intente de nuevo.','e');					
            }							
        }
        );
    }
}

function cargarComboProducto(idCaja,fijar){
    $.post('modules/procedures/producto.procedure.php',
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