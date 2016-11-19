    <footer>
        <div class="container">
             <?php
             if(@$pageStat['contact'] == "Y"){
             ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading">Kontak Informasi</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading"><?php echo $kontak['informasi']; ?></h3>
                </div>
                <div class="col-md-12">
                    <ul class="list-inline social-buttons">
                    <?php if($kontak['facebook']){ ?>
                        <li><a href="<?php echo $kontak['facebook']; ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php }else{ ?>
                        <li><a href="#page-top"><i class="fa fa-facebook"></i></a></li>
                    <?php } ?>

                    <?php if($kontak['twitter']){ ?>
                        <li><a href="<?php echo $kontak['twitter']; ?>"><i class="fa fa-twitter"></i></a></li>
                    <?php }else{ ?>
                        <li><a href="#page-top"><i class="fa fa-twitter"></i></a></li>
                    <?php } ?>

                    <?php if($kontak['gplus']){ ?>
                        <li><a href="<?php echo $kontak['gplus']; ?>"><i class="fa fa-google-plus"></i></a></li>
                    <?php }else{ ?>
                        <li><a href="#page-top"><i class="fa fa-google-plus"></i></a></li>
                    <?php } ?>

                    <?php if($kontak['url']){ ?>
                        <li><a href="<?php echo $kontak['url']; ?>"><i class="fa fa-external-link"></i></a></li>
                    <?php }else{ ?>
                        <li><a href="#page-top"><i class="fa fa-external-link"></i></a></li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
            <hr class="small">
            <div class="row">
                <div class="col-md-12">
                    <span class="copyright">Copyright &copy; <?php echo $site['title']." ".date('Y'); ?></span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <?php
    $sql_portofolio = pilih("* from {$tb['portofolio']}");
    if(itung_row($sql_portofolio) < 1){
        echo "<i>Tidak ada partner</i>";
    }
    while($portofolioRow = tampilinO($sql_portofolio)){
    ?>
    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $portofolioRow->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2><?php echo $portofolioRow->judul; ?></h2>
                            <p class="item-intro text-muted">Detail Portofolio <?php echo $portofolioRow->judul; ?></p>
                            <img class="img-responsive col-lg-12" src="<?php echo "{$site['root']}{$dir['upload-img']}/{$portofolioRow->thumb}"; ?>" alt="<?php echo $portofolioRow->judul; ?>">
                            <p><?php echo $portofolioRow->des; ?></p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $themes['real_dir']; ?>/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php echo $themes['real_dir']; ?>/js/classie.js"></script>
    <script src="<?php echo $themes['real_dir']; ?>/js/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $themes['real_dir']; ?>/js/agency.js"></script>

</body>

</html>
