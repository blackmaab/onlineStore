<?php
/**
 * Nombre de Archivo: defaultHome.php
 * Fecha Creación: 12-02-2012 
 * Hora: 05:30:47 PM
 * @author Mario Alvarado
 */
include_once 'modules/class/Categoria.class.php';
include_once 'modules/class/Producto.class.php';
$newCategoria = new Categoria();
$resulCategoria = $newCategoria->listarCategoria();

$newProducto = new Producto();
?>
<!-- Tabs -->
<div class="tabs">
    <ul>
        <?php
        if ($resulCategoria != null && $resulCategoria != false) {
            $cont = 1;
            foreach ($resulCategoria as $row => $data) {
                if ($cont == 1) {
                    $class = "active";
                } elseif ($cont % 3 == 0) {
                    $class = "red";
                } else {
                    $class = "";
                }
                ?>
                <li><a href="#" class="<?php echo $class; ?>"><span><?php echo $data[1]; ?></span></a></li>
                <?php
                $cont++;
            }
        } else {
            ?>
            <li><a href="#" class="active"><span>No hay productos registrados</span></a></li>
            <?php
        }
        ?>
    </ul>
</div>
<!-- Tabs -->

<!-- Container -->
<div id="container">     
    <!-- tabbed -->
    <div class="tabbed">
        <?php
        //verificacion si existen categorias
        if ($resulCategoria != null && $resulCategoria != false) {
            //recorriendo las categorias
            foreach ($resulCategoria as $row => $data) {
                $newProducto->idCategoria = $data[0];
                $resulProductos = $newProducto->listarProductoPorCategoria();
                //verificacion si ha devuelto registros
                if ($resulProductos != null && $resulProductos != false) {
                    ?>
                    <div class="tab-content" style="display:block;">
                        <div class="items">
                            <div class="cl">&nbsp;</div>
                            <ul>
                                <?php
                                foreach ($resulProductos as $rowP => $dataP) {
                                    ?>

                                    <li>
                                        <div class="image">
                                            <a href="#"><img src="<?php echo $dataP[4]; ?>" alt="" height="83"/></a>
                                        </div>
                                        <p>
                                            <?php
                                            //reducir el titulo
                                            if (strlen($dataP[1]) > 15) {
                                                $titulo = substr($dataP[1], 0, 15) . "...";
                                            } else {
                                                $titulo = $dataP[1];
                                            }
                                            ?>
                                            Producto: <span><?php echo $titulo; ?></span><br />                                                        
                                            Marca: <span><?php echo $dataP[2]; ?></span><br />
                                            Detalle: &nbsp;<a href="#">Ver m&aacute;s</a>       
                                        </p>
                                        <p class="price">Precio:&nbsp;&nbsp;<strong>$ <?php echo $dataP[3]; ?></strong></p>
                                        <table>
                                            <tr>
                                                <td>Cantidad a Comprar:</td>
                                                <td>
                                                    <input type="text" name="txtCantidad<?php echo $dataP[0] . $dataP[5] . $dataP[6]; ?>" id="txtCantidad<?php echo $dataP[0] . $dataP[5] . $dataP[6]; ?>" size="1" class="txtCantidad" alt="*" title="Campo Requerido">
                                                </td>
                                                <td>
                                                    <img src="images/car.png" title="Comprar" alt="Comprar" width="32" height="32" align="right" id="btnCar<?php echo $dataP[0] . $dataP[5] . $dataP[6]; ?>" onclick="agregarCarrito('<?php echo $dataP[0]; ?>','<?php echo $dataP[1]; ?>','<?php echo $dataP[2]; ?>','<?php echo $dataP[3]; ?>','#txtCantidad<?php echo $dataP[0] . $dataP[5] . $dataP[6]; ?>','<?php echo $dataP[4]; ?>')"/> 
                                                </td>
                                            </tr>                            
                                        </table>

                                    </li>

                                    <?php
                                }//end foreach $resulProductos
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                } else {
                    //imprimir div vacio en caso de no encontrar productos en 
                    //la categoria que esta recorriendo
                    ?>
                    <div class="tab-content" style="display:block;">
                        <div class="items">
                            <div class="cl">&nbsp;</div>
                            <ul><li></li></ul>
                        </div>
                    </div>
                    <?php
                }
            }//end foreach categoria
        } else {
            ?>
            <div class="tab-content" style="display:block;">
                <div class="items">
                    <div class="cl">&nbsp;</div>
                    <ul><li></li></ul>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
    <!-- end tabbed -->

    <div id="divCarrito" align="center" style="display: none">
        <h1>Detalle de articulos a comprar</h1>        
        <br>
        <form name="frmCarrito" id="frmCarrito">
            <table class="ui-widget ui-widget-content">
                <thead>
                    <tr class="ui-widget-header">
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Marca</th>
                        <th>Imagen</th>
                        <th>Costo</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody id="tableCarritoBody">

                </tbody>
                <tfoot id="tableCarritoFoot">
                    <tr id='rowFoot'>
                        <td colspan='6' align='left' style="font-size: 14px;color: #cd0a0a;font-weight: bold;">Total a pagar</td>
                        <td id='cellTotal' style="font-size: 14px;color: #cd0a0a;font-weight: bold;">$ 00.00</td>
                    </tr>
                </tfoot>
            </table>
        </form>
        
        
    </div>


    <div id="divLogin" style="display: none">
        <h1>Iniciar Session</h1>
        <form name="frmLogin" id="frmLogin">
            <table>
                <tr>
                    <td>Usuario:</td>
                    <td>
                        <input type="text" name="txtUser" id="txUser" alt="*" title="Campo Requerido">
                    </td>
                </tr>
                <tr>
                    <td>Contrase&ntilde;a:</td>
                    <td><input type="password" name="txtPassword" id="txtPassword" alt="*" title="Campo Requerido"></td>
                </tr>
                <tr>
                    <td>
                        <input type="button" name="btnLogin" id="btnLogin" value="Acceder">                    
                    </td> 
                </tr>
            </table>
        </form>
        <br>
        <hr>
        <br>
        <h1>Si eres nuevo registrate</h1>
        <form name="frmRegistrar" id="frmRegistrar">
            <table>
                <tr>
                    <td>Nombre:</td>
                    <td>
                        <input type="txtNombre" id="txtNombre">
                    </td>
                </tr>
                <tr>
                    <td>Apellido:</td>
                    <td>
                        <input type="txtApellido" id="txtApellido">
                    </td>
                </tr>    
                <tr>
                    <td>Direccion:</td>
                    <td>
                        <textarea name="txtDireccion" id="txtDireccion"></textarea>
                    </td>                        
                </tr>   
                <tr>
                    <td>Telefono:</td>
                    <td>
                        <input id="txtTelefono" name="txtTelefono">
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" id="txtEmail" name="txtEmail">
                    </td>
                </tr>
                <tr>
                    <td>Usuario:</td>
                    <td>
                        <input type="text" name="txtUserNew" id="txtUserNew">
                    </td>
                </tr>    
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="txtPassNew" id="txtPassNew">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" name="btnRegistrar" id="btnRegistrar" value="Registrar">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- Brands -->
    <div class="brands">
        <h3>Marcas</h3>
        <div class="logos" align="center">
            <a href="#"><img src="images/marcas/wd.jpg" alt="" /></a>           
            <a href="#"><img src="images/marcas/asus.jpg" alt="" /></a>                        
            <a href="#"><img src="images/marcas/kingston.jpg" alt="" /></a>
            <a href="#"><img src="images/marcas/markvision.jpg" alt="" /></a>            
            <hr>
            <a href="#"><img src="images/marcas/intel.jpg" alt="" /></a>
            <a href="#"><img src="images/marcas/nvidia.jpg" alt="" /></a>
            <a href="#"><img src="images/marcas/pcchips.jpg" alt="" /></a>
            <a href="#"><img src="images/marcas/toshiba.jpg" alt="" /></a>            
            <a href="#"><img src="images/marcas/ati.jpg" alt="" /></a>
            <a href="#"><img src="images/marcas/biostar.jpg" alt="" /></a>

        </div>
    </div>
    <!-- End Brands -->

    <!-- Footer -->
    <div id="footer">
        <div class="left">
            <a href="#">Inicio</a>
            <span>|</span>
            <!--<a href="#">Support</a>
            <span>|</span>-->
            <a href="#">Mi Cuenta</a>
            <span>|</span>
            <!--<a href="#">The Store</a>
            <span>|</span>-->
            <a href="#">Contactenos</a>
        </div>
        <div class="right">
            &copy; computerinnovation.com
        </div>
    </div>
    <!-- End Footer -->

</div>
<!-- End Container -->
