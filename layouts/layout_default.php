<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Computer Innovation</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/basic.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/jquery.gritter.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/jquery-ui-1.8.24.custom.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css" media="all" />
        <!--[if lte IE 6]>
                <style type="text/css" media="screen">
                        .tabbed { height:420px; }
                </style>
        <![endif]-->

        <script src="js/jquery-1.8.2.js" type="text/javascript"></script>
        <script src="js/jquery.jcarousel.pack.js" type="text/javascript"></script>
        <script src="js/jquery.slide.js" type="text/javascript"></script>
        <script src="js/jquery-func.js" type="text/javascript"></script>
        <script src="js/general.js" type="text/javascript"></script>
        <script src="js/jquery.wysiwyg.js" type="text/javascript"></script>
        

    </head>
    <body>
        
        <!-- Top -->
        <div id="top">

            <div class="shell">

                <!-- Header -->
                <div id="header">
                    <div id="logos"><img src="images/logo.png"/></div>
                    <!--<h1 id="logo"><a href="#">Computer Innovation</a></h1>-->
                    <div id="navigation">
                        <ul>
                            <li><a href="#">Inicio</a></li>
                            <!--<li><a href="#">Support</a></li>-->
                            <li><a href="#">Mi Cuenta</a></li>
                            <!--<li><a href="#">The Store</a></li>-->
                            <li class="last"><a href="#">Contactenos</a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Header -->

                <!-- Slider -->
                <div id="slider">
                    <div id="slider-holder">
                        <ul>
                            <li><a href="#"><img src="images/slide1.jpg" alt="" /></a></li>
                            <li><a href="#"><img src="images/slide2.jpg" alt="" /></a></li>
                            <li><a href="#"><img src="images/slide1.jpg" alt="" /></a></li>
                            <li><a href="#"><img src="images/slide2.jpg" alt="" /></a></li>
                            <li><a href="#"><img src="images/slide1.jpg" alt="" /></a></li>
                            <li><a href="#"><img src="images/slide2.jpg" alt="" /></a></li>
                        </ul>
                    </div>
                    <div id="slider-nav">
                        <a href="#" class="prev">Anterior</a>
                        <a href="#" class="next">Siguiente</a>
                    </div>
                </div>
                <!-- End Slider -->

            </div>
        </div>
        <!-- Top -->

        <!-- Main -->
        <div id="main">
            <div class="shell">

                <!-- Search, etc -->
                <div class="options">
                    <div class="search">
                        <form action="" method="post">
                            <span class="field"><input type="text" class="blink" value="Buscar" title="Buscar" /></span>
                            <input type="text" class="search-submit" value="IR" />
                        </form>
                    </div>
                    <!--<span class="left"><a href="#">Advanced Search</a></span>-->

                    <div class="right">
                        <span class="cart">
                            <a href="#" class="cart-ico">&nbsp;</a>
                            <strong>$0.00</strong>
                        </span>
                        <span class="left more-links">
                            <a href="#">Facturar</a>
                            <a href="#">Detalle</a>
                        </span>
                    </div>
                </div>
                <!-- End Search, etc -->

                <!-- Content -->
                <div id="content">
                    <?php
                    include(MODULO_PATH . "/" . $conf[$modulo]['archivo']);
                    ?>

                </div>
                <!-- End Content -->
            </div>
        </div>
        <!-- End Main -->
        <div id="basic-modal-content">
            <h3>Basic Modal Dialog</h3>
            <p>For this demo, SimpleModal is using this "hidden" data for its content. You can also populate the modal dialog with an AJAX response, standard HTML or DOM element(s).</p>
            <p>Examples:</p>
            <p><code>$('#basicModalContent').modal(); // jQuery object - this demo</code></p>
            <p><code>$.modal(document.getElementById('basicModalContent')); // DOM</code></p>
            <p><code>$.modal('&lt;p&gt;&lt;b&gt;HTML&lt;/b&gt; elements&lt;/p&gt;'); // HTML</code></p>
            <p><code>$('&lt;div&gt;&lt;/div&gt;').load('page.html').modal(); // AJAX</code></p>

            <p><a href='http://www.ericmmartin.com/projects/simplemodal/'>More details...</a></p>
        </div>
    </body>
</html>