<?php
$titleNow = "Partner";
include("header.php");
?>
<h1>Partner</h1>

<div class="blok">
	<div class="mini-menu">
		<li class="first"><a href="<?php echo "{$admPage['partner']}"; ?>"><i class="fa fa-eye"></i> Semua Partner</a></li>
		<li><a href="<?php echo "{$admPage['partner']}&action=tambah"; ?>"><i class="fa fa-plus"></i> Tambah partner</a></li>
		<li><a href="<?php echo "{$admPage['partner']}&type=hidden"; ?>"><i class="fa fa-eye-slash"></i> Partner Disembunyikan</a></li>
		<li><a href="<?php echo "{$admPage['partner']}&type=trash"; ?>"><i class="fa fa-trash"></i> Partner Terhapus</a></li>
	</div>

<?php
$act = @$_GET['action'];
if($act == "tambah") {
?>
	<h2>Tambah Partner</h2>
	<div class="bodi">
		<?php
		$gambar = @$_FILES['gambar']['name'];
		$nama = mysql_real_escape_string(@$_POST['nama']);
		$jabatan = mysql_real_escape_string(@$_POST['jabatan']);
		$facebook = mysql_real_escape_string(@$_POST['facebook']);
		$twitter = mysql_real_escape_string(@$_POST['twitter']);
		$website = mysql_real_escape_string(@$_POST['website']);
		$other = mysql_real_escape_string(@$_POST['other']);
		$status = mysql_real_escape_string(@$_POST['status']);
		if(@$_POST) {
			$extFile = strtolower(end(explode(".", $gambar)));
			$ext_allow = array("jpg","png");
			if(!$nama) {
				echo "<div class='block error'>Nama lengkap masih kosong !</div>";
			}elseif(!$jabatan) {
				echo "<div class='block error'>Mohon isi jabatan partner anda !</div>";
			}elseif(!$gambar) {
				echo "<div class='block error'>Mohon tambahkan foto partner anda !</div>";
			}elseif(!in_array($extFile, $ext_allow)){
				echo "<div class='block error'>Format gambar tidak didukung !</div>";
			}else{
				$gambar = date('Y')."-".date('m')."-".date('d')."-".substr(md5(time().rand()),0,10).$gambar;
				if(move_uploaded_file(@$_FILES['gambar']['tmp_name'], "../{$dir['upload-tim']}/$gambar")){
					if(tambah("{$tb['partner']} values(NULL, '$gambar', '$nama', '$jabatan', '$facebook','$twitter', '$website', '$other', '$status')")) {
						header("Location: {$admPage['partner']}");
					}else{
						echo "<div class='block error'>Kegagalan terjadi pada saat menyimpan data :(</div>";
					}
				}else{					
					echo "<div class='block error'>Gagal mengunggah foto :(</div>";
				}
			}
		}
		?>
		<form method="post" class="form" enctype="multipart/form-data">
			<label>
				Nama Lengkap
				<br>
				<input type="text" class="input" name="nama" value="<?php echo $nama; ?>">
			</label>
			<br>
			<label>
				Jabatan
				<br>
				<input type="text" class="input" name="jabatan" value="<?php echo $jabatan; ?>">
			</label>
			<br>
			<label>
				Foto
				<br>
				<input type="file" class="browse" name="gambar" accept="image/*">
				<div class="des">
					* disarankan untuk mengunggah file dengan dimensi tinggi & lebar yang sama (Contoh : 200 * 200)
				</div>
			</label>
			<br>
			<label>
				<i class="fa fa-facebook-square"></i> Facebook
				<br>
				<input type="text" class="input" name="facebook" value="<?php echo $facebook; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-twitter-square"></i> Twitter
				<br>
				<input type="text" class="input" name="twitter" value="<?php echo $twitter; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-globe"></i> Website
				<br>
				<input type="text" class="input" name="website" value="<?php echo $website; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-external-link"></i> Tautan Lainnya
				<br>
				<input type="text" class="input" name="other" value="<?php echo $other; ?>">
			</label>
			<br>
			<label>
				Status
				<br>
				<select class="select" name="status">
					<option value="Y">Tampilkan</option>
					<option value="N">Sembunyikan</option>
				</select>
			</label>
			<br>
			<button type="submit" class="button"><i class="fa fa-save"></i> Tambah Partner</button>
		</form>
	</div>
<?php }elseif($act == "ubah"){
		$id_edit = mysql_real_escape_string(@$_GET['id']);
		if(!$id_edit) {
			header("Location: {$admPage['partner']}");
		}
		$sql_partnerEdit 	= pilih("* from {$tb['partner']} where id ='$id_edit'");
		$partnerEditRow 		= tampilinO($sql_partnerEdit);

		if(@$_POST) {
			$gambar = @$_FILES['gambar']['name'];
			$nama = mysql_real_escape_string(@$_POST['nama']);
			$jabatan = mysql_real_escape_string(@$_POST['jabatan']);
			$facebook = mysql_real_escape_string(@$_POST['facebook']);
			$twitter = mysql_real_escape_string(@$_POST['twitter']);
			$website = mysql_real_escape_string(@$_POST['website']);
			$other = mysql_real_escape_string(@$_POST['other']);
			$status = mysql_real_escape_string(@$_POST['status']);
			$extFile = strtolower(end(explode(".", $gambar)));
			$ext_allow = array("jpg","png");
			if(!$nama) {
				echo "<div class='block error'>Nama lengkap masih kosong !</div>";
			}elseif(!$jabatan) {
				echo "<div class='block error'>Mohon isi jabatan partner anda !</div>";
			}elseif($gambar && !in_array($extFile, $ext_allow)){
				echo "<div class='block error'>Format gambar tidak didukung !</div>";
			}else{
				if($gambar){
					$gambar = date(Y)."-".date(m)."-".date(d)."-".substr(md5(time().rand()),0,10).$gambar;
					if(move_uploaded_file(@$_FILES['gambar']['tmp_name'], "../{$dir['upload-tim']}/$gambar")){
						if(update("{$tb['partner']} set nama = '$nama', jabatan = '$jabatan', foto = '$gambar', facebook = '$facebook', twitter = '$twitter', website = '$website', link = '$other', status = '$status' where id = '{$partnerEditRow->id}'")) {
							header("Location: {$admPage['partner']}");
						}else{
							echo "<div class='block error'>Kegagalan terjadi pada saat menyimpan data :(</div>";
						}
					}else{					
						echo "<div class='block error'>Gagal mengunggah gambar :(</div>";
					}
				}else{
					if(update("{$tb['partner']} set nama = '$nama', jabatan = '$jabatan', facebook = '$facebook', twitter = '$twitter', website = '$website', link = '$other', status = '$status' where id = '{$partnerEditRow->id}'")){
							header("Location: {$admPage['partner']}");
					}else{
						echo "<div class='block error'>Kegagalan terjadi pada saat menyimpan data :(</div>";
					}
				}
			}
		}
		?>
	<h2>Ubah Partner</h2>
	<div class="bodi">
		<form method="post" class="form" enctype="multipart/form-data">
			<label>
				Nama Lengkap
				<br>
				<input type="text" class="input" name="nama" value="<?php echo $partnerEditRow->nama; ?>">
			</label>
			<br>
			<label>
				Jabatan
				<br>
				<input type="text" class="input" name="jabatan" value="<?php echo $partnerEditRow->jabatan; ?>">
			</label>
			<br>
			<label>
				Foto
				<br>
				<input type="file" class="browse" name="gambar" accept="image/*">
				<div class="des">
					* Cari file foto lain, jika foto ingin diubah
				</div>
			</label>
			<br>
				<div class="des">Gambar yang digunakan : </div>
				<div class="img">
					<img src="<?php echo "{$site['root']}{$dir['upload-tim']}/{$partnerEditRow->foto}"; ?>">
				</div>
			<br>
			<label>
				<i class="fa fa-facebook-square"></i> Facebook
				<br>
				<input type="text" class="input" name="facebook" value="<?php echo $partnerEditRow->facebook; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-twitter-square"></i> Twitter
				<br>
				<input type="text" class="input" name="twitter" value="<?php echo $partnerEditRow->twitter; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-globe"></i> Website
				<br>
				<input type="text" class="input" name="website" value="<?php echo $partnerEditRow->website; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-external-link"></i> Tautan Lainnya
				<br>
				<input type="text" class="input" name="other" value="<?php echo $partnerEditRow->link; ?>">
			</label>
			<br>
			<label>
				Status
				<br>
				<select class="select" name="status">
					<option value="Y" <?php if($partnerEditRow->status == "Y"){echo "selected";} ?>>Tampilkan</option>
					<option value="N" <?php if($partnerEditRow->status == "N"){echo "selected";} ?>>Sembunyikan</option>
				</select>
			</label>
			<br>
			<button type="submit" class="button"><i class="fa fa-save"></i> Perbarui Partner</button>
		</form>
	</div>
	<?php
	}elseif($act == "hapus"){
		$id_del 	= mysql_real_escape_string(@$_GET['id']);
		if(update("{$tb['partner']} set status = 'TRASH' where id = '$id_del'")){
			header("Location: {$admPage['partner']}");
		}else{
			echo "<div class='block error'>Kesalahan terjadi pada saat menghapus data :(</div>";
		}

	}elseif($act == "hapus-permanent"){
		$id_del 	= mysql_real_escape_string(@$_GET['id']);
		if(hapus("{$tb['partner']} where id = '$id_del'")){
			header("Location: {$admPage['partner']}&type=trash");
		}else{
			echo "<div class='block error'>Kesalahan terjadi pada saat menghapus data :(</div>";
		}

	}elseif($act == "restore-visible"){
		$id_res 	= mysql_real_escape_string(@$_GET['id']);
		if(update("{$tb['partner']} set status = 'Y' where id = '$id_res'")){
			header("Location: {$admPage['partner']}");
		}else{
			echo "<div class='block error'>Kesalahan terjadi pada saat merestore data :(</div>";
		}
	?>
	<?php }else{
		$type = strtolower(@$_GET['type']);
		if($type == "hidden") {
			$kueri_ = "where status = 'N'";
			$h2 = "Partner Yang Disembunyikan";
		}elseif($type == "trash") {
			$kueri_ = "where status = 'TRASH'";
			$h2 = "Partner Yang Dihapus";
		}else{
			$kueri_ = "where status = 'Y' or status = 'N'";
			$h2 = "Semua Partner";
		}
	?>
	<h2><?php echo $h2; ?></h2>

	<div class="bodi">
		<div class="tema">
		<?php

		$sql_partnerAll 	= pilih("* from {$tb['partner']} $kueri_ order by id desc");
		if(itung_row($sql_partnerAll) < 1){
			echo "<div class='not-found'>Tidak ada data</div>";
		}else{
		while($partnerRow = tampilinO($sql_partnerAll)){
		?>
		<div class="thumb <?php if($type !== "hidden" && $partnerRow->status == 'N'){echo "hidden";} ?>">
			<div class="gambar">
				<img src="<?php echo "{$site['root']}{$dir['upload-tim']}/{$partnerRow->foto}"; ?>">
			</div>
			<div class="nama">
				<?php echo $partnerRow->nama; ?>
			</div>
			<div class="des">
				<?php
				echo $partnerRow->jabatan;
				?>
			</div>
			<div class="footer">
				<?php
				if($type == "trash"){
				?>
				<a href="<?php echo "{$admPage['partner']}&action=restore-visible&id={$partnerRow->id}"; ?>" class="btn green"><i class="fa fa-reply"></i></a>
				<a href="<?php echo "{$admPage['partner']}&action=hapus-permanent&id={$partnerRow->id}"; ?>" class="btn red" onclick="return confirm('Yakin akan menghapus permanen partner ini ?');"><i class="fa fa-trash"></i></a>
				<?php }else{
				if($type == "hidden"){
				?>
				<a href="<?php echo "{$admPage['partner']}&action=restore-visible&id={$partnerRow->id}"; ?>" class="btn green"><i class="fa fa-eye"></i></a>
				<?php }else{ ?>
				<a href="<?php echo "{$admPage['partner']}&action=ubah&id={$partnerRow->id}"; ?>" class="btn green"><i class="fa fa-pencil"></i></a>
				<?php } ?>
				<a href="<?php echo "{$admPage['partner']}&action=hapus&id={$partnerRow->id}"; ?>" class="btn red" onclick="return confirm('Yakin akan menghapus ini ?');"><i class="fa fa-trash"></i></a>
				<?php } ?>
			</div>
		</div>
		<?php }} ?>
		</div>
	</div>
	<?php } ?>
</div>

<?php
include("footer.php");
?>