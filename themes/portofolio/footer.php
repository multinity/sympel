    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
            <?php
            if($pageStat['contact'] == "Y"){
            ?>
                    <h4><strong>Kontak Informasi</strong></h4>
                    <?php
                    echo $kontak['informasi'];
                    ?>
                    <br>
                    <ul class="list-inline">
                                <?php
                                if($kontak['facebook']){
                                ?>
                                <li><a href="<?php echo $kontak['facebook']; ?>"><i class="fa fa-facebook fa-3x"></i></a></li>
                                <?php }else{ ?>
                                <li><a href="#top"><i class="fa fa-facebook fa-3x"></i></a></li>
                                <?php } ?>

                                <?php
                                if($kontak['twitter']){
                                ?>
                                <li><a href="<?php echo $kontak['twitter']; ?>"><i class="fa fa-twitter fa-3x"></i></a></li>
                                <?php }else{ ?>
                                <li><a href="#top"><i class="fa fa-twitter fa-3x"></i></a></li>
                                <?php } ?>

                                <?php
                                if($kontak['gplus']){
                                ?>
                                <li><a href="<?php echo $kontak['url']; ?>"><i class="fa fa-google-plus fa-3x"></i></a></li>
                                <?php }else{ ?>
                                <li><a href="#top"><i class="fa fa-google-plus fa-3x"></i></a></li>
                                <?php } ?>

                                <?php
                                if($kontak['url']){
                                ?>
                                <li><a href="<?php echo $kontak['url']; ?>"><i class="fa fa-external-link fa-3x"></i></a></li>
                                <?php } ?>
                    </ul>
                    <hr class="small">
            <?php } ?>
                    <p class="text-muted">Copyright &copy; <?php echo $site['title']." ".date('Y'); ?></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo $themes['real_dir']; ?>/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $themes['real_dir']; ?>/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>
