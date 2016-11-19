<?php
$titleNow = "Dashboard";
include("header.php");
?>
<h1>Dashboard</h1>
<p>Selamat datang dihalaman administrator <?php echo $site['title']; ?>, dihalaman ini anda dapat mengelola isi konten dari website anda.</p>

<div class="blok">
	<div class="menu">
		<li>
			<a href="<?php echo $admPage['hlm-depan']; ?>">
				<i class="fa fa-copy fa-4x"></i>
				<div class="txt">Intro</div>
			</a>
		</li>
		<li>
			<a href="<?php echo $admPage['tentang']; ?>">
				<i class="fa fa-info-circle  fa-4x"></i>
				<div class="txt">Tentang Saya</div>
			</a>
		</li>
		<li>
			<a href="<?php echo $admPage['portofolio']; ?>">
				<i class="fa fa-th  fa-4x"></i>
				<div class="txt">Portofolio</div>
			</a>
		</li>
		<li>
			<a href="<?php echo $admPage['kontak']; ?>">
				<i class="fa fa-phone  fa-4x"></i>
				<div class="txt">Kontak Saya</div>
			</a>
		</li>
		<li>
			<a href="<?php echo $admPage['partner']; ?>">
				<i class="fa fa-users  fa-4x"></i>
				<div class="txt">Partner</div>
			</a>
		</li>
		<li>
			<a href="<?php echo $admPage['gbook']; ?>">
				<i class="fa fa-comments  fa-4x"></i>
				<div class="txt">Buku Tamu</div>
			</a>
		</li>
	</div>
</div>

<h1>Tema yang tersedia</h1>
<p>Sesuaikan tema website anda!</p>
<div class="blok">
	<div class="tema">
		<?php include("tema-list.php"); ?>
	</div>
</div>

<?php
include("footer.php");
?>