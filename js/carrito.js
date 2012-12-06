

$(document).ready(function(){
    
    $('.txtCantidad').keypress(function(event){
        return $.validarTecla(event,'.txtCantidad','numero');
    });
    
    $('#btnDetalleCarrito').click(function () {
        if(!$('#cellTotal').html()=="$ 00.00"){
            $('#divCarrito').modal({
                minHeight: 100,
                minWidth: 1000,
                maxHeight: 500,
                maxWidth: 2000
            });
        }else{
            $.mensajeInformativo("No se han agregado articulos al carrito", "i");
        }
        return false;
    });
    
    $('#btnFacturar').click(function(){
        //verificacion si esta logeado
        $.post('modules/procedures/usuario.procedure.php',
        {            
            txtType:"verificar"
        },
        function(data){ 
            
            if(data=="true"){
                alert("autenticado");
            
            //                $.mensajeInformativo('Categoria agregada exitosamente','i');				
            //                $.limpiarCampos("#frmCategoria");  
            //                cargarComboCategoria("#selCategoria", "-");
            }else{                    
                $.mensajeInformativo('Para poder realizar su factura debe de iniciar sesion.','e');					
            }							
        }
        );
        
    });
    
    $('#btnSession').click(function(){
        $('#divLogin').modal({
            minHeight: 100,
            minWidth: 100,
            maxHeight: 200,
            maxWidth: 200
        });
          
          
    //        //verificacion si esta logeado
    //        $.post('modules/procedures/usuario.procedure.php',
    //        {            
    //            txtType:"autenticar"
    //        },
    //        function(data){ 
    ////            alert(data);
    ////            if(data=="true"){
    ////                alert("autenticado");
    ////            
    ////            //                $.mensajeInformativo('Categoria agregada exitosamente','i');				
    ////            //                $.limpiarCampos("#frmCategoria");  
    ////            //                cargarComboCategoria("#selCategoria", "-");
    ////            }else{                    
    ////                $.mensajeInformativo('Para poder realizar su factura debe de iniciar sesion.','e');					
    ////            }							
    //        }
    //        );
        
    });
    
    $("#btnLogin").click(function(){
        //verificacion que los campos esten llenos
        if($.validarCampos("#frmLogin")==true){
            $.post('modules/procedures/usuario.procedure.php',
            {            
                txtType:"autenticar",
                txtUser:$('#txtUser').attr("value"),
                txtPass:$('#txtPassword').attr("value")
            },
            function(data){ 
                //            alert(data);
                //            if(data=="true"){
                //                alert("autenticado");
                //            
                //            //                $.mensajeInformativo('Categoria agregada exitosamente','i');				
                //            //                $.limpiarCampos("#frmCategoria");  
                //            //                cargarComboCategoria("#selCategoria", "-");
                //            }else{                    
                //                $.mensajeInformativo('Para poder realizar su factura debe de iniciar sesion.','e');					
                //            }							
                }
                );
        }else{
            $.mensajeInformativo('Faltan campos por llenar','e');
        }    
    });
});

var contador=0;
function agregarCarrito(idProducto,titulo,marca,costo,idCajaCantidad,url_image){
       
    //validacion de la caja cantidad
    if($.validarUniqueText(idCajaCantidad)==true){
        //verificacion si no existe en articulo en el carrito
        
        if($('#txtIdProductoCarrito'+idProducto).val()==undefined){
            inputHidden="<input type='hidden' name='txtIdProductoCarrito"+idProducto+"' id='txtIdProductoCarrito"+idProducto+"' size='1' value='"+idProducto+"'>";
            
            inputCantidad="<input type='text' name='txtCantidadProducto"+idProducto+"' id='txtCantidadProducto"+idProducto+"' alt='*' title='Campo Requerido' size='6' value='"+$(idCajaCantidad).attr('value')+"' onkeypress=\"return $.validarTecla(event,'#txtCantidadProducto"+idProducto+"','numero')\" onblur=\"recalcularCantidad('"+idProducto+"','"+costo+"')\">";
            tdNumero="<td>"+(contador+1)+inputHidden+"</td>";
            tdTitulo="<td>"+titulo+"</td>";
            tdMarca="<td>"+marca+"</td>";
            tdImagen="<td><img src='"+url_image+"' alt='' height='96' width='96'/></td>";
            tdCosto="<td>$ "+costo+"</td>";
            total=parseFloat(costo*$(idCajaCantidad).attr('value'));
            inputHiddenTotal="<input type='hidden' name='txtTotalProductoCarrito"+idProducto+"' id='txtTotalProductoCarrito"+idProducto+"' value='"+total.toFixed(2)+"' class='txtTotalProductoCarrito'>";
            
            tdCantidad="<td>"+inputCantidad+"</td>";
            tdTotal="<td id='rowTotal"+idProducto+"'>$ "+total.toFixed(2)+inputHiddenTotal+"</td>";
            tdOpcion="<td><img src='images/tabla/del.png' onclick=\"deleteRow('#row"+idProducto+"')\" title='Eliminar del carrito'></td>";
            
            newRow=tdNumero+tdTitulo+tdMarca+tdImagen+tdCosto+tdCantidad+tdTotal+tdOpcion;
            $("#tableCarritoBody").append("<tr id='row"+idProducto+"'>"+newRow+"</tr>");
            
            //    $('#txtCantidadProducto'+idProducto).addClass("txtCantidad")
            //alert($('#txtCantidadProducto'+idProducto).attr("class"));
            //aumentando el contador
            contador++;
            //mensaje informativo
            $.mensajeInformativo("PRODUCTO AGREGADO AL CARRITO.<br />"+titulo, "i");
        }else{
            //agregar mas datos al campo cantidad
            //alert($('#txtCantidadProducto'+idProducto).attr('value'));
            
            newcantidad=parseInt($('#txtCantidadProducto'+idProducto).attr('value'))+parseInt($(idCajaCantidad).attr('value'));
            $('#txtCantidadProducto'+idProducto).attr('value',newcantidad);
            total=parseFloat(costo*newcantidad);
            inputHiddenTotal="<input type='hidden' name='txtTotalProductoCarrito"+idProducto+"' id='txtTotalProductoCarrito"+idProducto+"' value='"+total.toFixed(2)+"' class='txtTotalProductoCarrito'>";
            $('#rowTotal'+idProducto).html("$ "+total.toFixed(2)+inputHiddenTotal);           
            //mensaje informativo
            $.mensajeInformativo("PRODUCTO ACTUALIZADO.<br />"+titulo, "i");           
        }
        calcularTotalFactura();
        $('#divCarrito').css("display", "block");
    }// end if validarUniqueText

}

function deleteRow(idRow){
    confir=confirm("¿Desea eliminarlo del carrito?");
    if(confir==true){
        $(idRow).remove();
        calcularTotalFactura();        
    }    
}

function calcularTotalFactura(){
    var calculado=0;
    //class='txtTotalProductoCarrito';
    $('.txtTotalProductoCarrito').each(function(index){
        calculado+=parseFloat($(this).attr('value'));        
    });  
    
    if(calculado==0){
        $('#divCarrito').css("display", "none");
    //$('.simplemodal-close').trigger('click');
    }
    //asignando valor
    $('#cellTotal').html("$ "+calculado.toFixed(2));
    $('#tituloTotalCarrito').html("$ "+calculado.toFixed(2));    
}

function recalcularCantidad(idProducto,costo){   
    newcantidad=parseInt($('#txtCantidadProducto'+idProducto).attr('value'));
    $('#txtCantidadProducto'+idProducto).attr('value',newcantidad);
    total=parseFloat(costo*newcantidad);
    inputHiddenTotal="<input type='hidden' name='txtTotalProductoCarrito"+idProducto+"' id='txtTotalProductoCarrito"+idProducto+"' value='"+total.toFixed(2)+"' class='txtTotalProductoCarrito'>";
    $('#rowTotal'+idProducto).html("$ "+total.toFixed(2)+inputHiddenTotal);           
    calcularTotalFactura();
}


