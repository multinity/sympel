<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $admin['title'].$site['tanda'].$titleNow; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
		include("head.php");
		?>
	</head>
	<body>
		<div id="container">
			<div class="navbar">
				<a href="<?=$site['link'];?>" class="logo">
						<img src="<?=$admin['logo'];?>">
				</a>
				<div class="nav left">
					<li><a href="#" id="toggle-sidebar"><i class="fa fa-bars"></i></a></li>
				</div>
				<div class="nav right">
					<li class="dropdown">
						<a href="<?php echo $admPage['profile']; ?>" class="thin">Hello, <?php echo $user['nama_depan']; ?>!</a>
						<ul class="child">
							<li><a href="<?=$admPage['profile'];?>"><i class="fa fa-user w-space"></i> <?=$user['nama'];?></a></li>
							<li><a href="<?=$site['root'];?>" target="_blank"><i class="fa fa-tv w-space"></i> Halaman Depan</a></li>
							<li class="divider"></li>
							<li><a href="<?=$admPage['keluar'];?>"><i class="fa fa-sign-out w-space"></i> Keluar</a></li>
						</ul>
					</li>
				</div>
			</div>
			<div class="sidebar">
				<div class="menu">
					<li class="<?=(this_page_admin(true,true,false) == $admPage['home']) ? 'active':'';?>"><a href="<?php echo $admPage['home']; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
					<li class="grup">Bagian</li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['hlm-depan']) ? 'active':'';?>"><a href="<?php echo $admPage['hlm-depan']; ?>"><i class="fa fa-files-o"></i> Intro</a></li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['tentang']) ? 'active':'';?>"><a href="<?php echo $admPage['tentang']; ?>"><i class="fa fa-info-circle"></i> Tentang Saya</a></li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['portofolio']) ? 'active':'';?>"><a href="<?php echo $admPage['portofolio']; ?>"><i class="fa fa-th"></i> Portofolio</a></li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['kontak']) ? 'active':'';?>"><a href="<?php echo $admPage['kontak']; ?>"><i class="fa fa-phone"></i> Kontak Saya</a></li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['partner']) ? 'active':'';?>"><a href="<?php echo $admPage['partner']; ?>"><i class="fa fa-users"></i> Partner</a></li>

					<li class="grup">Buku Tamu</li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['gbook']) ? 'active':'';?>"><a href="<?php echo $admPage['gbook']; ?>"><i class="fa fa-comments"></i> Buku Tamu</a></li>

					<li class="grup">Web</li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['editor']) ? 'active':'';?>"><a href="<?php echo $admPage['editor']; ?>"><i class="fa fa-code"></i> Tema Editor</a></li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['tema']) ? 'active':'';?>"><a href="<?php echo $admPage['tema']; ?>"><i class="fa fa-desktop"></i> Tema</a></li>
					<li class="<?=(this_page_admin(true,true,false) == $admPage['setting']) ? 'active':'';?>"><a href="<?php echo $admPage['setting']; ?>"><i class="fa fa-wrench"></i> Pengaturan</a></li>
				</div>
			</div>

			<div class="main">

