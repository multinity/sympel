<?php
$titleNow = "Portofolio";
include("header.php");
?>
<h1>Portofolio </h1>

<div class="blok">
	<div class="mini-menu">
		<li class="first"><a href="<?php echo "{$admPage['portofolio']}"; ?>"><i class="fa fa-eye"></i> Semua Portofolio</a></li>
		<li><a href="<?php echo "{$admPage['portofolio']}&action=tambah"; ?>"><i class="fa fa-plus"></i> Tambah Portofolio</a></li>
		<li><a href="<?php echo "{$admPage['portofolio']}&type=hidden"; ?>"><i class="fa fa-eye-slash"></i> Portofolio Disembunyikan</a></li>
		<li><a href="<?php echo "{$admPage['portofolio']}&type=trash"; ?>"><i class="fa fa-trash"></i> Portofolio Terhapus</a></li>
	</div>

<?php
$act = @$_GET['action'];
if($act == "tambah") {
?>
	<h2>Tambah Portofolio</h2>
	<div class="bodi">
		<?php
		if(@$_POST) {
			$judul = mysql_real_escape_string(@$_POST['judul']);
			$gambar = $_FILES['gambar']['name'];
			$des = mysql_real_escape_string(@$_POST['des']);
			$status = mysql_real_escape_string(@$_POST['status']);
			$extFile = strtolower(end(explode(".", $gambar)));
			$ext_allow = array("jpg","png");
			if(!$judul) {
				echo "<div class='block error'>Judul portofolio masih kosong !</div>";
			}elseif(!$gambar) {
				echo "<div class='block error'>Mohon isi gambar portofolio anda !</div>";				
			}elseif(!in_array($extFile, $ext_allow)){
				echo "<div class='block error'>Format gambar tidak didukung !</div>";
			}else{
				if(!$des){
					$des = "Tidak ada deskripsi";
				}
				$gambar = date(Y)."-".date(m)."-".date(d)."-".substr(md5(time().rand()),0,10).$gambar;
				if(move_uploaded_file($_FILES['gambar']['tmp_name'], "../{$dir['upload-img']}/$gambar")){
					if(tambah("{$tb['portofolio']} values(NULL, '$gambar', '$judul', '$des', '$status')")) {
						header("Location: {$admPage['portofolio']}");
					}else{
						echo "<div class='block error'>Kegagalan terjadi pada saat menyimpan data :(</div>";
					}
				}else{					
					echo "<div class='block error'>Gagal mengunggah gambar :(</div>";
				}
			}
		}
		?>
		<form method="post" class="form" enctype="multipart/form-data">
			<label>
				Judul
				<br>
				<input type="text" class="input" name="judul">
			</label>
			<br>
			<label>
				Gambar
				<br>
				<input type="file" class="browse" name="gambar" accept="image/*">
			</label>
			<br>
			<label>
				Deskripsi
				<br>
				<textarea class="ckeditor" name="des"></textarea>
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
			<button type="submit" class="button"><i class="fa fa-save"></i> Tambah Portofolio</button>
		</form>
	</div>
<?php }elseif($act == "ubah"){
		$id_edit = mysql_real_escape_string(@$_GET['id']);
		if(!$id_edit) {
			header("Location: {$admPage['portofolio']}");
		}
		$sql_portofolioEdit 	= pilih("* from {$tb['portofolio']} where id ='$id_edit'");
		$portofolioEditRow 		= tampilinO($sql_portofolioEdit);

		if(@$_POST) {
			$judul = mysql_real_escape_string(@$_POST['judul']);
			$gambar = $_FILES['gambar']['name'];
			$des = mysql_real_escape_string(@$_POST['des']);
			$status = mysql_real_escape_string(@$_POST['status']);
			$extFile = strtolower(end(explode(".", $gambar)));
			$ext_allow = array("jpg","png");
			if(!$judul) {
				echo "<div class='block error'>Judul portofolio masih kosong !</div>";
			}elseif($gambar && !in_array($extFile, $ext_allow)){
				echo "<div class='block error'>Format gambar tidak didukung !</div>";
			}else{
				if(!$des){
					$des = "Tidak ada deskripsi";
				}
				if($gambar){
					$gambar = date('Y')."-".date('m')."-".date('d')."-".substr(md5(time().rand()),0,10).$gambar;
					if(move_uploaded_file($_FILES['gambar']['tmp_name'], "../{$dir['upload-img']}/$gambar")){
						if(update("{$tb['portofolio']} set judul = '$judul', thumb = '$gambar', des = '$des', status = '$status' where id = '{$portofolioEditRow->id}'")) {
							header("Location: {$admPage['portofolio']}");
						}else{
							echo "<div class='block error'>Kegagalan terjadi pada saat menyimpan data :(</div>";
						}
					}else{					
						echo "<div class='block error'>Gagal mengunggah gambar :(</div>";
					}
				}else{
					if(update("{$tb['portofolio']} set judul = '$judul', des = '$des', status = '$status' where id = '$id_edit'")){
							header("Location: {$admPage['portofolio']}");
					}else{
						echo "<div class='block error'>Kegagalan terjadi pada saat menyimpan data :(</div>";
					}
				}
			}
		}
		?>
	<h2>Ubah Portofolio</h2>
	<div class="bodi">
		<form method="post" class="form" enctype="multipart/form-data">
			<label>
				Judul
				<br>
				<input type="text" class="input" name="judul" value="<?php echo $portofolioEditRow->judul; ?>">
			</label>
			<br>
			<label>
				Gambar
				<br>
				<input type="file" class="browse" name="gambar">
				<div class="des">* cari file gambar yang lain, jika gambar ingin anda ubah</div>
			</label>
			<br>
				<div class="des">Gambar yang digunakan : </div>
				<div class="img">
					<img src="<?php echo "{$site['root']}{$dir['upload-img']}/{$portofolioEditRow->thumb}"; ?>">
				</div>
			<br>
			<label>
				Deskripsi
				<br>
				<textarea class="ckeditor" name="des"><?php echo $portofolioEditRow->des; ?></textarea>
			</label>
			<br>
			<label>
				Status
				<br>
				<select class="select" name="status">
					<option value="Y" <?php if($portofolioEditRow->status == "Y"){echo "selected";} ?>>Tampilkan</option>
					<option value="N" <?php if($portofolioEditRow->status == "N"){echo "selected";} ?>>Sembunyikan</option>
				</select>
			</label>
			<br>
			<button type="submit" class="button"><i class="fa fa-save"></i> Simpan Perubahaan</button>
		</form>
	</div>
	<?php
	}elseif($act == "hapus"){
		$id_del 	= mysql_real_escape_string(@$_GET['id']);
		if(update("{$tb['portofolio']} set status = 'TRASH' where id = '$id_del'")){
			header("Location: {$admPage['portofolio']}");
		}else{
			echo "<div class='block error'>Kesalahan terjadi pada saat menghapus data :(</div>";
		}

	}elseif($act == "hapus-permanent"){
		$id_del 	= mysql_real_escape_string(@$_GET['id']);
		if(hapus("{$tb['portofolio']} where id = '$id_del'")){
			header("Location: {$admPage['portofolio']}&type=trash");
		}else{
			echo "<div class='block error'>Kesalahan terjadi pada saat menghapus data :(</div>";
		}

	}elseif($act == "restore-visible"){
		$id_res 	= mysql_real_escape_string(@$_GET['id']);
		if(update("{$tb['portofolio']} set status = 'Y' where id = '$id_res'")){
			header("Location: {$admPage['portofolio']}");
		}else{
			echo "<div class='block error'>Kesalahan terjadi pada saat merestore data :(</div>";
		}
	}elseif($act == "hidden"){
		$id_hid 	= mysql_real_escape_string(@$_GET['id']);
		if(update("{$tb['portofolio']} set status = 'N' where id = '$id_hid'")){
			header("Location: {$admPage['portofolio']}");
		}else{
			echo "<div class='block error'>Kesalahan terjadi pada saat menyembunyikan data :(</div>";
		}
	?>
	<?php }else{
		$type = strtolower(@$_GET['type']);
		if($type == "hidden") {
			$kueri_ = "where status = 'N'";
			$h2 = "Portofolio Yang Disembunyikan";
		}elseif($type == "trash") {
			$kueri_ = "where status = 'TRASH'";
			$h2 = "Portofolio Yang Dihapus";
		}else{
			$kueri_ = "where status = 'Y' or status = 'N'";
			$h2 = "Semua Portofolio";
		}
	?>
	<h2><?php echo $h2; ?></h2>

	<div class="bodi">
		<div class="tema">
		<?php

		$sql_portofolioAll 	= pilih("* from {$tb['portofolio']} $kueri_ order by id desc");
		if(itung_row($sql_portofolioAll) < 1){
			echo "<div class='not-found'>Tidak ada data</div>";
		}else{
		while($portofolioRow = tampilinO($sql_portofolioAll)){
		?>
		<div class="thumb <?php if($type !== "hidden" && $portofolioRow->status == "N"){echo "hidden";} ?>" style="width:300px;">
			<div class="gambar" style="width:290px;">
				<img src="<?php echo "{$site['root']}{$dir['upload-img']}/{$portofolioRow->thumb}"; ?>">
			</div>
			<div class="nama">
				<?php echo $portofolioRow->judul; ?>
			</div>
			<div class="des">
				<?php
				$des = "{$portofolioRow->des}";
				if(strlen($des) > 100) {
					echo substr($des, 0, 250);
				}else{
					echo $des;
				}
				?>
			</div>
			<div class="footer">
				<?php
				if($type == "trash"){
				?>
				<a href="<?php echo "{$admPage['portofolio']}&action=restore-visible&id={$portofolioRow->id}"; ?>" class="btn green" title="Kembalikan/Tampilkan"><i class="fa fa-reply"></i></a>
				<a href="<?php echo "{$admPage['portofolio']}&action=hapus-permanent&id={$portofolioRow->id}"; ?>" class="btn red" title="Hapus Permanen" onclick="return confirm('Yakin akan menghapus permanen portofolio ini ?');"><i class="fa fa-trash"></i></a>
				<?php }else{
				if($type == "hidden" or $portofolioRow->status == "N"){
				?>
				<a href="<?php echo "{$admPage['portofolio']}&action=restore-visible&id={$portofolioRow->id}"; ?>" class="btn green" title="Kembalikan/Tampilkan"><i class="fa fa-eye"></i></a>
				<?php }else{ ?>
				<a href="<?php echo "{$admPage['portofolio']}&action=ubah&id={$portofolioRow->id}"; ?>" class="btn green" title="Ubah"><i class="fa fa-pencil"></i></a>
				<?php } ?>
				<a href="<?php echo "{$admPage['portofolio']}&action=hapus&id={$portofolioRow->id}"; ?>" class="btn red" title="Hapus" onclick="return confirm('Yakin akan menghapus ini ?');"><i class="fa fa-trash"></i></a>
				<?php } ?>
				<?php
				if($portofolioRow->status == "Y"){
				?>
				<a href="<?php echo "{$admPage['portofolio']}&action=hidden&id={$portofolioRow->id}"; ?>" class="btn green" title="Sembunyikan"><i class="fa fa-eye-slash"></i></a>
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