<?php include("{$themes['real_dir']}/{$themes['header']}"); ?>

<body>

    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top"><?php echo $site['title']; ?></a>
            </li>
            <li>
                <a href="#top">Home</a>
            </li>
            <?php if($pageStat['intro'] == "Y"){ ?>
            <li>
                <a href="#intro"><?php echo $intro['menu']; ?></a>
            </li>
            <?php } ?>

            <?php if($pageStat['portofolio'] == "Y"){ ?>
            <li>
                <a href="#portfolio">Portfolio</a>
            </li>
            <?php } ?>

            <?php if($pageStat['about'] == "Y"){ ?>
            <li>
                <a href="#about"><?php echo $tentang['menu']; ?></a>
            </li>
            <?php } ?>

            <?php if($pageStat['partner'] == "Y"){ ?>
            <li>
                <a href="#partner">Partner</a>
            </li>
            <?php } ?>

            <?php if($pageStat['contact'] == "Y"){ ?>
            <li>
                <a href="#contact"><?php echo $kontak['menu']; ?></a>
            </li>
            <?php } ?>
        </ul>
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1><?php echo $site['title']; ?></h1>
            <h3><?php echo $site['tagline']; ?></h3>
            <br>
            <a href="#intro" class="btn btn-dark btn-lg">Find Out More</a>
        </div>
    </header>

    <?php
    if($pageStat['intro'] == "Y"){
    ?>
    <!-- intro -->
    <section id="intro" class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $intro['header']; ?></h2>
                    <hr class="small">
                    <p class="lead"><?php echo $intro['isi']; ?></p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <?php } ?>

    <!-- Callout -->
<!--     <aside class="callout">
        <div class="text-vertical-center">
            <h1>Vertically Centered Text</h1>
        </div>
    </aside>
 -->
    <?php
    if($pageStat['portofolio'] == "Y"){
    ?>
    <!-- Portfolio -->
    <section id="portfolio" class="portfolio bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h2>Portofolio</h2>
                    <hr class="small">
                    <div class="row">
                    <?php
                    $sql_portofolio = pilih("* from {$tb['portofolio']} where status = 'Y'");
                    if(itung_row($sql_portofolio) < 1){
                        echo "<i>Tidak ada portofolio</i>";
                    }
                    while($portofolioRow = tampilinO($sql_portofolio)){
                    ?>
                        <div class="col-md-4">
                            <div class="portfolio-item">
                                <div class="fa-stack gambar">
                                    <img class="img-portfolio img-responsive" src="<?php echo "{$site['root']}{$dir['upload-img']}/{$portofolioRow->thumb}"; ?>">
                                </div>

                                <div class="des">
                                <h4><strong>
                                <?php
                                    echo $portofolioRow->judul;
                                ?>
                                </strong></h4>

                                <?php
                                echo substr($portofolioRow->des,0,100);
                                ?>
                                </div>
                            </div>
                        </div>
                   <?php } ?>
                    </div>
                    <!-- /.row (nested) -->
<!--                     <a href="#" class="btn btn-dark">View More Items</a>
 -->                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <?php } ?>

    <?php
    if($pageStat['about'] == "Y"){
    ?>
        <section id="about" class="services">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2><?php echo $tentang['header']; ?></h2>
                    <hr class="small">
                    <div class="row">
                    <?php echo $tentang['isi']; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php
    if($pageStat['partner'] == "Y"){
    ?>
    <section id="partner" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Partner</h2>
                    <hr class="small">
                    <div class="row">
                    <?php
                    $sql_partner = pilih("* from {$tb['partner']} where status = 'Y' order by id asc");
                    if(itung_row($sql_partner) < 1){
                        echo "<i>Tidak ada partner</i>";
                    }
                    while($partnerRow = tampilinO($sql_partner)){
                    ?>
                        <div class="col-md-4">
                            <div class="service-item">
                            <div class="fa-stack fa-4x foto">
                                <img src="<?php echo "{$dir['upload-tim']}/{$partnerRow->foto}"; ?>">
                            </div>
                                <h4>
                                    <strong><?php echo ucwords($partnerRow->nama); ?></strong>
                                </h4>
                                <p><?php echo $partnerRow->jabatan; ?></p>
                                <?php
                                if($partnerRow->facebook){
                                ?>
                                <a href="<?php echo $partnerRow->facebook; ?>" class="btn btn-light"><i class="fa fa-facebook"></i></a>
                                <?php }else{ ?>
                                <a href="javascript:nothing;" class="btn btn-light"><i class="fa fa-facebook"></i></a>
                                <?php } ?>

                                <?php
                                if($partnerRow->twitter){
                                ?>
                                <a href="<?php echo $partnerRow->twitter; ?>" class="btn btn-light"><i class="fa fa-twitter"></i></a>
                                <?php }else{ ?>
                                <a href="javascript:nothing;" class="btn btn-light"><i class="fa fa-twitter"></i></a>
                                <?php } ?>

                                <?php
                                if($partnerRow->website){
                                ?>
                                <a href="<?php echo $partnerRow->website; ?>" class="btn btn-light"><i class="fa fa-globe"></i></a>
                                <?php }else{ ?>
                                <a href="javascript:nothing;" class="btn btn-light"><i class="fa fa-globe"></i></a>
                                <?php } ?>

                                <?php
                                if($partnerRow->link){
                                ?>
                                <a href="<?php echo $partnerRow->link; ?>" class="btn btn-light"><i class="fa fa-external-link"></i></a>
                                <?php } ?>
                             </div>
                        </div>
                    <!-- /.row (nested) -->
                <?php } ?>
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <?php } ?>
    <!-- Call to Action -->
<!--     <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>The buttons below are impossible to resist.</h3>
                    <a href="#" class="btn btn-lg btn-light">Click Me!</a>
                    <a href="#" class="btn btn-lg btn-dark">Look at Me!</a>
                </div>
            </div>
        </div>
    </aside>
 -->

    <?php
    if($pageStat['contact'] == "Y"){
    ?>
    <section id="contact" class="services">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2><?php echo $kontak['header']; ?></h2>
                    <hr class="small">
                    <?php
                    echo $kontak['isi'];
                    ?>
                </div>
                <div class="col-lg-6">
                <?php
                include("{$dir['inc']}/fungsi-guestbook.php");
                ?>
                </div>
                <div class="col-lg-12">
                    <form name="sentMessage" method="post" action="#contact">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap *" name="nama">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Surat Elektronik *" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Situs Web" name="web">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Subjek" name="subject">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Pesan *" name="pesan"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

<?php include("{$themes['real_dir']}/{$themes['footer']}"); ?>