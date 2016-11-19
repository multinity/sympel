<!DOCTYPE HTML>
<html>
	<head>
		<title>Halaman Tidak Ditemukan</title>
		<link rel="stylesheet" type="text/css" href="<?php echo "{$site['root']}{$dir['css']}/{$file['css']}"; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo "{$site['root']}{$dir['plugin']}/{$file['fa']}"; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo "{$site['root']}{$dir['plugin']}/{$file['fa.min']}"; ?>">
	</head>

	<body>
		<div class="notfound">
			<div class="logo">
				<i class="fa fa-warning fa-5x"></i>
			</div>
			<h1>Halaman tidak ditemukan</h1>
			<h3><?php echo $site['title']; ?> tidak menemukan halaman yang anda cari.</h3>

			<div class="footer">
				<h4>Hubungi Kami</h4>
				<div class="menu">
					<li><a href="https://www.facebook.com/100005497380536"><i class="fa fa-facebook"></i> Facebook</a></li>
					<li><a href="http://www.nauvalazhar.net"><i class="fa fa-globe"></i> Website</a></li>
					<li><a href="https://plus.google.com/+NauvalAzhar"> +Google</a></li>
					<li><a href="mailto:me@nauvalazhar.net"><i class="fa fa-envelope"></i> Email</a></li>
				</div>
				<div class="copyright">
					Copyright <?php echo $site['title']; ?> &copy; <?php echo date('Y'); ?>
				</div>
			</div>
		</div>
	</body>
</html>