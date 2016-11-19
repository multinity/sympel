<?php
$titleNow = "Pengaturan";
include("header.php");
?>
<h1>Pengaturan</h1>
<p>Sesuaikan dengan informasi website anda</p>
<div class="blok">
	<div class="bodi">
		<form method="post" class="form" enctype="multipart/form-data">
			<h2 class="mini-title">Pengaturan Umum</h2>
			<label>
				Judul Situs
				<br>
				<input type="text" name="judul" class="input" value="<?php echo $site['title']; ?>">
			</label>
			<br>
			<label>
				Deskripsi Situs
				<br>
				<input type="text" name="tagline" class="input" value="<?php echo $site['tagline']; ?>">
			</label>
			<br>
			<label>
				URL Root
				<br>
				<input type="text" name="root" class="input" value="<?php echo $site['root']; ?>">
			</label>
			<br>
			<h2 class="mini-title">Pengaturan Tampilan</h2>
			<label>
				Favicon
				<br>
				<input type="file" name="favicon" class="browse" accept="image/*">
			</label>
			<br>
			<div class="des">Favicon sekarang :</div> 
			<img src="<?php echo "{$site['root']}{$site['favicon']}"; ?>" class="favicon">

			<h2 class="mini-title">Pengaturan Halaman</h2>
				<div class="group-field">
					<label class="txt">Tampilkan Halaman "Intro"</label>
					<input type="radio" id="radio0" name="page_intro" value="Y" <?php if($pageStat['intro'] == "Y"){echo "checked";} ?>>
					<label for="radio0"><i class="fa fa-eye"></i> Tampilkan</label>
					<input type="radio" id="radio1" name="page_intro" value="N" <?php if($pageStat['intro'] !== "Y"){echo "checked";} ?>>
					<label for="radio1"><i class="fa fa-eye-slash"></i> Tidak Tampilkan</label>
				</div>
				<div class="group-field">
					<label class="txt">Tampilkan Halaman "Portofolio"</label>
					<input type="radio" id="radio2" name="page_portofolio" value="Y" <?php if($pageStat['portofolio'] == "Y"){echo "checked";} ?>>
					<label for="radio2"><i class="fa fa-eye"></i> Tampilkan</label>
					<input type="radio" id="radio3" name="page_portofolio" value="N" <?php if($pageStat['portofolio'] !== "Y"){echo "checked";} ?>>
					<label for="radio3"><i class="fa fa-eye-slash"></i> Tidak Tampilkan</label>
				</div>
				<div class="group-field">
					<label class="txt">Tampilkan Halaman "Tentang"</label>
					<input type="radio" id="radio4" name="page_about" value="Y" <?php if($pageStat['about'] == "Y"){echo "checked";} ?>>
					<label for="radio4"><i class="fa fa-eye"></i> Tampilkan</label>
					<input type="radio" id="radio5" name="page_about" value="N" <?php if($pageStat['about'] !== "Y"){echo "checked";} ?>>
					<label for="radio5"><i class="fa fa-eye-slash"></i> Tidak Tampilkan</label>
				</div>
				<div class="group-field">
					<label class="txt">Tampilkan Halaman "Partner"</label>
					<input type="radio" id="radio6" name="page_partner" value="Y" <?php if($pageStat['partner'] == "Y"){echo "checked";} ?>>
					<label for="radio6"><i class="fa fa-eye"></i> Tampilkan</label>
					<input type="radio" id="radio7" name="page_partner" value="N" <?php if($pageStat['partner'] !== "Y"){echo "checked";} ?>>
					<label for="radio7"><i class="fa fa-eye-slash"></i> Tidak Tampilkan</label>
				</div>
				<div class="group-field">
					<label class="txt">Tampilkan Halaman "Kontak"</label>
					<input type="radio" id="radio8" name="page_contact" value="Y" <?php if($pageStat['contact'] == "Y"){echo "checked";} ?>>
					<label for="radio8"><i class="fa fa-eye"></i> Tampilkan</label>
					<input type="radio" id="radio9" name="page_contact" value="N" <?php if($pageStat['contact'] !== "Y"){echo "checked";} ?>>
					<label for="radio9"><i class="fa fa-eye-slash"></i> Tidak Tampilkan</label>
				</div>
			<br>
			<button type="submit" class="button"><i class="fa fa-save"></i> Simpan Perubahaan</button>
		</form>
	</div>
</div>
<?php
if($_POST){
	$judul = mysql_real_escape_string($_POST['judul']);
	$tagline = mysql_real_escape_string($_POST['tagline']);
	$root = mysql_real_escape_string($_POST['root']);
	$page_intro = mysql_real_escape_string($_POST['page_intro']);
	$page_portofolio = mysql_real_escape_string($_POST['page_portofolio']);
	$page_about = mysql_real_escape_string($_POST['page_about']);
	$page_partner = mysql_real_escape_string($_POST['page_partner']);
	$page_contact = mysql_real_escape_string($_POST['page_contact']);
	$favicon = $_FILES['favicon']['name'];
	if(!$judul) {
		$judul = "One Page CMS";
	}else{
		$judul;
	}
	if(!$tagline) {
		$tagline = "Open source one page CMS";
	}else{
		$tagline;
	}
	if(!$root) {
		$root = $site['root'];
	}else{
		$root;
	}
	if(!$favicon) {
		$favicon = $site['favicon-only'];
	}else{
		$favicon = trim($favicon);
		move_uploaded_file($_FILES['favicon']['tmp_name'], "../{$dir['upload-img']}/$favicon");
	}
	$upSet = update("{$tb['setting']} set value = '$judul' where name = 'site_title'");
	$upSet = update("{$tb['setting']} set value = '$tagline' where name = 'site_tagline'");
	$upSet = update("{$tb['setting']} set value = '$root' where name = 'site_root'");
	$upSet = update("{$tb['setting']} set value = '$favicon' where name = 'site_icon'");

	$upSet = update("{$tb['setting']} set value = '$page_intro' where name = 'page_intro'");
	$upSet = update("{$tb['setting']} set value = '$page_portofolio' where name = 'page_portofolio'");
	$upSet = update("{$tb['setting']} set value = '$page_about' where name = 'page_about'");
	$upSet = update("{$tb['setting']} set value = '$page_partner' where name = 'page_partner'");
	$upSet = update("{$tb['setting']} set value = '$page_contact' where name = 'page_contact'");
	if($upSet){
		header("Location: {$admPage['setting']}");
	}
}
?>
<?php
include("footer.php");
?>