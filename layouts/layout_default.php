<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Computer Innovation</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
        <!--[if lte IE 6]>
                <style type="text/css" media="screen">
                        .tabbed { height:420px; }
                </style>
        <![endif]-->

        <script src="js/jquery-1.8.2.js" type="text/javascript"></script>
        <script src="js/jquery.jcarousel.pack.js" type="text/javascript"></script>
        <script src="js/jquery.slide.js" type="text/javascript"></script>
        <script src="js/jquery-func.js" type="text/javascript"></script>

    </head>
    <body>
        <!-- Top -->
        <div id="top">

            <div class="shell">

                <!-- Header -->
                <div id="header">
                    <h1 id="logo"><a href="#">Urgan Gear</a></h1>
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

    </body>
</html>