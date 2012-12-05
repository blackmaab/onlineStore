

$(document).ready(function(){
    
    $('.txtCantidad').keypress(function(event){
        return $.validarTecla(event,'.txtCantidad','numero');
    });
    
//    $('#btnDetalleCarrito').click(function (e) {
//        
//                var unique_id =$.gritter.add({
//                    // (string | mandatory) the heading of the notification
//                    title: 'Agregado al carrito',
//                    // (string | mandatory) the text inside the notification
//                    text: 'Adaptador de Audio 3-D <br />Marca: Manhattan<br /> Cantidad: '+$('#txtCantidad').attr('value'),
//                    // (string | optional) the image to display on the left
//                    image: 'images/accesorios/adaptadorAudio.jpg',
//                    // (bool | optional) if you want it to fade out on its own or just sit there
//                    sticky: true,
//                    // (int | optional) the time you want it to be alive for before fading out
//                    time: '',
//                    // (string | optional) the class name you want to apply to that specific message
//                    class_name: 'my-sticky-class'
//                });
//                
//                setTimeout(function(){
//                    $.gritter.remove(unique_id, {
//                        fade: true,
//                        speed: 'slow'
//                    });
//        
//                }, 6000)
//        return false;
//    });
    
    
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


