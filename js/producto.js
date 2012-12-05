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
                        $("#txtDescripcionProducto").wysiwyg("setContent","");
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
function selProducto(id,titulo,des,exis,costo,idmarca,idcategoria,url_image){
    
    $("#txtIdProducto").attr("value", id);
    $("#txtProducto").attr("value",titulo);
    //llena el textarea
    $("#txtDescripcionProducto").wysiwyg("setContent",des);
    //quita el campo que sea requerido por si no se desea actualizar la imagen
    $("#txtImagenProducto").attr("alt","");
    $("#txtImagenProducto").attr("title","");
    $("#txtUrlImage").attr("value",url_image);
    
    $("#txtExistenciaProducto").attr("value",exis);
    $("#txtCostoProducto").attr("value",costo);
    cargarComboMarca("#selMarca", idmarca);
    cargarComboCategoria("#selCategoria", idcategoria);
    $("#btnProducto").attr("value","Guardar");
}

function updateProducto(){
    if($.validarCampos("#frmProducto")){               
        //Revisamos si el navegador soporta el objeto FormData
        if(window.FormData){         
            //procesando la imagen
            //var inputFileImage = document.getElementById("txtImagenProducto");
            var inputFileImage = $("#txtImagenProducto")[0];
            var file = inputFileImage.files[0];
            var data = new FormData();

            data.append('txtImagenProducto',file);
            data.append('txtIdProducto',$('#txtIdProducto').attr('value'));             
            data.append('txtProducto',$('#txtProducto').attr('value'));
            data.append('idMarca',$('#selMarca').attr('value'));
            data.append('idCategoria',$('#selCategoria').attr('value'));
            data.append('txtDescripcionProducto',$('#txtDescripcionProducto').attr('value'));
            data.append('txtExistenciaProducto',$('#txtExistenciaProducto').attr('value'));
            data.append('txtCostoProducto',$('#txtCostoProducto').attr('value'));
            data.append('txtType','update');
            data.append('txtUrlImage',$("#txtUrlImage").attr("value"));
            
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
                        $.mensajeInformativo('Producto actualizado exitosamente','i');				
                        $.limpiarCampos("#frmProducto");  
                        //quita el campo que sea requerido por si no se desea actualizar la imagen
                        $("#txtImagenProducto").attr("alt","*");
                        $("#txtImagenProducto").attr("title","Campo Requerido");
                        $("#btnProducto").attr("value","Agregar");
                        $("#txtDescripcionProducto").wysiwyg("setContent","");
                        searchProducto();                    
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


function deleteProducto(id,url_image){
    var res=confirm("¿Desea eliminar el registro?");   
    if(res==true){
        $.post('modules/procedures/producto.procedure.php',
        {
            txtIdProducto:id,
            txtImage:url_image,            
            txtType:"delete"
        },
        function(data){
            if(data=="true"){
                $.mensajeInformativo('Producto eliminado exitosamente','i');				                
                $.limpiarCampos("#frmProducto");
                $("#txtDescripcionProducto").wysiwyg("setContent","");
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