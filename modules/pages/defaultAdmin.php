<!-- Tabs -->
<div class="tabs">
    <ul>
        <li><a href="#" class="active"><span>Categor&iacute;a</span></a></li>
        <li><a href="#"><span>Marca</span></a></li>
        <li><a href="#" class="red"><span>Articulo</span></a></li>
    </ul>
</div>
<!-- Tabs -->
<div id="container">                     
    <div class="tabbed">

        <!-- Primer Tab Content -->
        <div class="tab-content" style="display:block;">
            <form name="frmCategoria" id="frmCategoria">
                <table>
                    <tr>
                        <td>Nueva Categoria:</td>
                        <td>
                            <input type="text" name="txtCategoria" id="txtCategoria" alt="*" title="Campo requerido">
                            <input type="hidden" id="txtIdCategoria">
                        </td>
                        <td>
                            <input type="button" name="btnCategoria" id="btnCategoria" value="Agregar">
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            <hr>
            <br>
            <form name="frmSearchCategoria" id="frmSearchCategoria">
                <table>
                    <tr>
                        <td>Buscar:</td>
                        <td><input type="text" name="txtSearchCategoria" id="txtSearchCategoria" alt="*" title="Campo Requerido"></td>
                        <td><input type="button" id="btnSearchCategoria" value="Buscar"></td>
                    </tr>
                </table>
            </form>
            <div id="searchCategoria"></div>
        </div>
        <!-- End Primer Tab Content -->
        <!-- Segundo Tab Content -->
        <div class="tab-content" style="display:block;">
            <form name="frmMarca" id="frmMarca">
                <table>
                    <tr>
                        <td>Nueva Marca:</td>
                        <td>
                            <input type="text" name="txtMarca" id="txtMarca" alt="*" title="Campo requerido">
                            <input type="hidden" id="txtIdMarca">
                        </td>
                        <td>
                            <input type="button" name="btnMarca" id="btnMarca" value="Agregar">
                        </td>
                    </tr>

                </table>
            </form>
            <br>
            <hr>
            <br>
            <form name="frmSearchMarca" id="frmSearchMarca">
                <table>
                    <tr>
                        <td>Buscar:</td>
                        <td><input type="text" name="txtSearchMarca" id="txtSearchMarca" alt="*" title="Campo Requerido"></td>
                        <td><input type="button" id="btnSearchMarca" value="Buscar"></td>
                    </tr>
                </table>
            </form>
            <div id="searchMarca"></div>
        </div>
        <!-- End Segundo Tab Content -->

        <!-- Tercer Tab Content -->
        <div class="tab-content" style="display:block;">
            <form name="frmProducto" id="frmProducto">
                <table>
                    <tr>
                        <td>Titulo:</td>
                        <td>
                            <input type="text" name="txtProducto" id="txtProducto" alt="*" title="Campo requerido">
                            <input type="hidden" id="txtIdProducto" name="txtIdProducto">
                        </td>
                    </tr>
                    <tr>
                        <td>Descripcion:</td>
                        <td>
                            <textarea id="txtDescripcionProducto" name="txtDescripcionProducto" alt="*" title="Campo Requerido" rows="5" cols="47"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Existencias:</td>
                        <td>
                            <input type="text" id="txtExistenciaProducto" name="txtExistenciaProducto" alt="*" title="Campo Requerido">
                        </td>
                    </tr>
                    <tr>
                        <td>Costo:</td>
                        <td>
                            <input type="text" id="txtCostoProducto" name="txtCostoProducto" alt="*" title="Campo Requerido">
                        </td>
                    </tr>
                    <tr>
                        <td>Imagen:</td>
                        <td>
                            <input type="file" id="txtImagenProducto" name="txtImagenProducto" alt="*" title="Campo Requerido">
                            <input type="hidden" id="txtUrlImage" name="txtUrlImage">
                        </td>
                    </tr>
                    <tr>
                        <td>Marca:</td>
                        <td>
                            <select id="selMarca" name="selMarca" title="Campo Requerido" alt="*"></select>
                        </td>
                    </tr>
                    <tr>
                        <td>Categor&iacute;a</td>
                        <td>
                            <select id="selCategoria" name="selCategoria" title="Campo Requerido" alt="*"></select>
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <input type="button" name="btnProducto" id="btnProducto" value="Agregar">
                        </td>
                    </tr>

                </table>
            </form>
            <br>
            <hr>
            <br>
            <form name="frmSearchProducto" id="frmSearchProducto">
                <table>
                    <tr>
                        <td>Buscar:
                            <input type="text" name="txtSearchProducto" id="txtSearchProducto" alt="*" title="Campo Requerido"></td>
                        <td>
                            Filtrar por:
                            <select name="txtTipoSearchProducto" id="txtTipoSearchProducto">
                                <option value="t">T&iacute;tulo</option>
                                <option value="d">Descripci&oacute;n</option>
                            </select>
                        </td>
                        <td><input type="button" id="btnSearchProducto" value="Buscar"></td>
                    </tr>
                </table>
            </form>
            <div id="searchProducto"></div>
        </div>
        <!-- End Tercer Tab Content -->
    </div>
    <br><br><br>
    <br><br><br>
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