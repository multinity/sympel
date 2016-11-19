<?php include("{$themes['real_dir']}/{$themes['header']}"); ?>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><?php echo $site['title']; ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <?php if($pageStat['intro'] == "Y"){ ?>
                    <li>
                        <a class="page-scroll" href="#intro"><?php echo $intro['menu']; ?></a>
                    </li>
                    <?php } ?>

                    <?php if($pageStat['portofolio'] == "Y"){ ?>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portofolio</a>
                    </li>
                    <?php } ?>

                    <?php if($pageStat['about'] == "Y"){ ?>
                    <li>
                        <a class="page-scroll" href="#about"><?php echo $tentang['menu']; ?></a>
                    </li>
                    <?php } ?>

                    <?php if($pageStat['partner'] == "Y"){ ?>
                    <li>
                        <a class="page-scroll" href="#team">Partner</a>
                    </li>
                    <?php } ?>

                    <?php if($pageStat['contact'] == "Y"){ ?>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading"><?php echo $site['title']; ?></div>
                <div class="intro-lead-in"><?php echo $site['tagline']; ?></div>
                <a href="#intro" class="page-scroll btn btn-xl" style="margin-top:30px;">Tell Me More</a>
            </div>
        </div>
    </header>

    <?php
        if($pageStat['intro'] == "Y"){
    ?>
    <!-- Intro Section -->
    <section id="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $intro['header']; ?></h2>
                    <p><?php echo $intro['isi']; ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

<?php
if($pageStat['portofolio'] == "Y"){
?>
    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Portofolio</h2>
                    <h3 class="section-subheading text-muted">Portofolio <?php echo $site['title']; ?></h3>
                </div>
            </div>
            <div class="row" id="showPort" style="height:300px; overflow:hidden">
            <?php
            $sql_portofolio = pilih("* from {$tb['portofolio']} where status = 'Y'");
            if(itung_row($sql_portofolio) < 1){
            echo "<center><i>Tidak ada portofolio</i></center>";
            }
            while($portofolioRow = tampilinO($sql_portofolio)){
            ?>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal<?php echo $portofolioRow->id; ?>" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="<?php echo "{$site['root']}{$dir['upload-img']}/{$portofolioRow->thumb}"; ?>" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4><?php echo $portofolioRow->judul; ?></h4>
                    </div>
                </div>
            <?php } ?>
            </div>
            <?php
            if(itung_row($sql_portofolio) > 3){
            ?>
            <div class="row" style="margin-top:50px">
                <div class="col-md-12 text-center">
                    <a href="#" class="btn btn-primary btn-lg" id="loadPort">Show More</a>
                </div>
            </div>
            <script type="text/javascript">
            $(function(){
                $("#loadPort").click(function(){
                    $("#showPort").attr("style","");
                    return false;
                });
            });
            </script>
            <?php } ?>
        </div>
    </section>
<?php } ?>

<?php
if($pageStat['about'] == "Y"){
?>
    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $tentang['header']; ?></h2>
                    <h3 class="section-subheading text-muted">Tentang <?php echo $site['title']; ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <?php echo $tentang['isi']; ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php
if($pageStat['partner'] == "Y"){
?>
    <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Partner</h2>
                    <h3 class="section-subheading text-muted">Partner <?php echo $site['title']; ?></h3>
                </div>
            </div>
            <div class="row">
                <?php
                $sql_partner = pilih("* from {$tb['partner']} where status = 'Y' order by id asc");
                if(itung_row($sql_partner) < 1){
                    echo "<i>Tidak ada partner</i>";
                }
                while($partnerRow = tampilinO($sql_partner)){
                ?>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="<?php echo "{$site['root']}{$dir['upload-tim']}/{$partnerRow->foto}"; ?>" class="img-responsive img-circle" alt="">
                        <h4><?php echo $partnerRow->nama; ?></h4>
                        <p class="text-muted"><?php echo $partnerRow->jabatan; ?></p>
                        <ul class="list-inline social-buttons">
                            <?php
                            if($partnerRow->facebook){
                            ?>
                            <li><a href="<?php echo $partnerRow->facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php }else{ ?>
                            <li><a href="javascript:nothing;"><i class="fa fa-facebook"></i></a></li>
                            <?php } ?>

                            <?php
                            if($partnerRow->twitter){
                            ?>
                            <li><a href="<?php echo $partnerRow->twitter; ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php }else{ ?>
                            <li><a href="javascript:nothing;"><i class="fa fa-twitter"></i></a></li>
                            <?php } ?>

                            <?php
                            if($partnerRow->website){
                            ?>
                            <li><a href="<?php echo $partnerRow->website; ?>"><i class="fa fa-globe"></i></a></li>
                            <?php }else{ ?>
                            <li><a href="javascript:nothing;"><i class="fa fa-globe"></i></a></li>
                            <?php } ?>

                            <?php
                            if($partnerRow->link){
                            ?>
                            <li><a href="<?php echo $partnerRow->link; ?>"><i class="fa fa-external-link"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

    <!-- Clients Aside -->
<!--     <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/envato.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/designmodo.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/themeforest.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/creative-market.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>
 -->
 <?php
 if($pageStat['contact'] == "Y"){
 ?>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $kontak['header']; ?></h2>
                    <h3 class="section-subheading text-muted" style="color:#fff;"><?php echo $kontak['isi']; ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <?php
                include("{$dir['inc']}/fungsi-guestbook.php");
                ?>
                    <form method="post" action="#contact">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama Anda *" name="nama" value="<?php echo @$_POST['nama']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Surel anda *" name="email" value="<?php echo @$_POST['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Situs Web" name="web" value="<?php echo @$_POST['web']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Subjek" name="subject" value="<?php echo @$_POST['subject']; ?>">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Pesan anda *" style="height:150px;" name="pesan"><?php echo @$_POST['pesan']; ?></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                            <input type="submit" class="btn btn-xl" value="Kirim Pesan">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php include("{$themes['real_dir']}/{$themes['footer']}"); ?>
