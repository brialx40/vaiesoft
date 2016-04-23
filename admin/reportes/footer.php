<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
<?php } ?>
</div><!--/fluid-row-->
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

    <hr>

    <footer class="row">
        <p style="text-align: center;"> <a href="http://www.ufps.edu.co/" target="_blank"> 
                Universidad Francisco de Paula Santander</a></p>

        <p style="text-align: center;"> Derechos Reservados. 
            <a href="http://www.ufps.edu.co/ufpsnuevo/modulos/contenido/view_contenido.php?item=22" target="_blank"> 
                Vicerrector&iacute;a Asistente de Investigaci&oacute;n y Extensi&oacute;n</a></p>
        <p style="text-align: center;">Desarrollado por: <a
                href="#">Diana Calder&oacute;n</a></p>
    </footer>
<?php } ?>

</div><!--/.fluid-container-->

<!-- external javascript -->


<?php //Google Analytics code for tracking my demo site, you can remove this.
if ($_SERVER['HTTP_HOST'] == 'usman.it') {
    ?>
    <script>
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-26532312-1']);
        _gaq.push(['_trackPageview']);
        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
        })();
    </script>
<?php } ?>

</body>
</html>
