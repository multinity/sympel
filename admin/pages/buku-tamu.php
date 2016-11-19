<?php
$titleNow = "Buku Tamu";
include("header.php");
$type_get = strtolower(mysql_real_escape_string(@$_GET['type']));
$hidden = strtolower(mysql_real_escape_string(@$_GET['hidden']));
$trash = strtolower(mysql_real_escape_string(@$_GET['trash']));
$restore = strtolower(mysql_real_escape_string(@$_GET['restore']));
$permanent = strtolower(mysql_real_escape_string(@$_GET['permanent']));
if($hidden) {
	if(!$hidden) {
		header("Location: {$admPage['gbook']}");		
	}else{
		if(update("{$tb['gbook']} set status = 'N' where id = '$hidden'")){
			header("Location: {$admPage['gbook']}");
		}
	}
}elseif($trash) {
	if(!$trash) {
		header("Location: {$admPage['gbook']}");		
	}else{
		if(update("{$tb['gbook']} set status = 'TRASH' where id = '$trash'")){
			header("Location: {$admPage['gbook']}");
		}
	}
}elseif($restore) {
	if(!$restore) {
		header("Location: {$admPage['gbook']}");		
	}else{
		if(update("{$tb['gbook']} set status = 'Y' where id = '$restore'")){
			header("Location: {$admPage['gbook']}");
		}
	}
}elseif($permanent) {
	if(!$permanent) {
		header("Location: {$admPage['gbook']}");		
	}else{
		if(hapus("{$tb['gbook']} where id = '$permanent'")){
			header("Location: {$admPage['gbook']}");
		}
	}
}

if($type_get == "hidden") {
	$type = "where status = 'N'";
}elseif($type_get == "trash") {
	$type = "where status = 'TRASH'";
}else{
	$type = "where status = 'Y' or status = 'N' ";
}
?>
<h1>Buku Tamu</h1>

<div class="blok">
	<div class="bodi">
		<div class="mailbox">
			<div class="side">
				<h2>Folder</h2>
				<div class="folder">
					<li><a href="<?php echo $admPage['gbook']; ?>" class="<?php if($type_get == ""){echo "selected";} ?>"><i class="fa fa-inbox"></i> Kotak Masuk</a></li>
					<li><a href="<?php echo "{$admPage['gbook']}&type=hidden"; ?>" class="<?php if($type_get == "hidden"){echo "selected";} ?>"><i class="fa fa-edit"></i> Sembunyikan</a></li>
					<li><a href="<?php echo "{$admPage['gbook']}&type=trash"; ?>" class="<?php if($type_get == "trash"){echo "selected";} ?>"><i class="fa fa-trash"></i> Tempat Sampah</a></li>
				</div>
			</div>
			<div class="isi">
			<?php
			$read = @$_GET['read'];
			if($read){
			$sql_gbookRead = pilih("* from {$tb['gbook']} where id = '$read'");
			$gbookReadRow 	= tampilinO($sql_gbookRead);
			?>
				<div class="read">
					<div class="read-des">
						<div class="header">
							<?php echo $gbookReadRow->subject; ?>
						</div>
						<div class="nama">
							<i class="fa fa-user"></i>
							<?php echo "{$gbookReadRow->nama} ({$gbookReadRow->email})"; ?>
						</div>
						<div class="waktu">
							<?php
							echo tanggalType("D, d M Y (h:i A)",$gbookReadRow->pada);
							?>
						</div>
						<div class="des">
							<?php
							echo "<label>{$gbookReadRow->website}</label>";
							echo "<label>IP : {$gbookReadRow->ip}</label>";
							?>
						</div>
					</div>
					<div class="read-pesan">
						<?php
						$isiPesan = $gbookReadRow->isi;
						$isi = wordwrap($isiPesan,80,"<br>",1);
						$isi = str_replace("\n", "<br>", $isiPesan);
						echo $isi;
						?>
					</div>
				</div>
			<?php }else{ ?>
				<div class="box">
					<?php
					$sql_gbookSemua 	= pilih("* from {$tb['gbook']} $type order by id desc");
					if(itung_row($sql_gbookSemua) < 1){
						echo "<i>Tidak ada kiriman</i>";
					}else{
					while($gbookRow 	= tampilinO($sql_gbookSemua)){
					?>
					<a href="<?php echo "{$admPage['gbook']}&read={$gbookRow->id}"; ?>" class="<?php if($type_get !== "hidden" && $gbookRow->status == "N"){echo "hidden";} ?>">
					<div class="list">
						<div style="overflow:hidden">
							<div class="nama">
							<i class="fa fa-user"></i> 
								<?php
								$nama = $gbookRow->nama;
								if(strlen($nama) > 18) {
									echo substr($nama, 0, 18)." ...";
								}else{
									echo $nama;
								}
								?>
							</div>
							<div class="subject">
								<?php
								$subject = $gbookRow->subject;
								if(strlen($subject) > 30) {
									echo substr($subject, 0, 30)." ...";
								}else{
									echo $subject;
								}
								?>
							</div>
							<div class="pesan">
								<?php
								$isiPesan = $gbookRow->isi;
								if(strlen($isiPesan) > 15) {
									echo substr($isiPesan, 0, 15)." ...";
								}else{
									echo $isiPesan;
								}
								?>
							</div>
							<div class="waktu">
								<?php
								echo tanggalType("h:i A",$gbookRow->pada);
								?>
							</div>
						</div>
						<div class="footer">
						<?php
						if($type_get == "hidden"){
						?>
							<li><a href="<?php echo "{$admPage['gbook']}&restore={$gbookRow->id}"; ?>"><i class="fa fa-eye"></i> Tampilkan</a></li>
						<?php }elseif($type_get == "trash"){ ?>
							<li><a href="<?php echo "{$admPage['gbook']}&restore={$gbookRow->id}"; ?>"><i class="fa fa-reply"></i> Kembalikan</a></li>
						<?php }else{
							if($gbookRow->status == "N"){
						?>
							<li><a href="<?php echo "{$admPage['gbook']}&restore={$gbookRow->id}"; ?>"><i class="fa fa-eye-slash"></i> Tampilkan</a></li>
						<?php }else{ ?>
							<li><a href="<?php echo "{$admPage['gbook']}&hidden={$gbookRow->id}"; ?>"><i class="fa fa-eye-slash"></i> Sembunyikan</a></li>
						<?php }} ?>

						<?php if($type_get == "trash"){ ?>
							<li><a href="<?php echo "{$admPage['gbook']}&permanent={$gbookRow->id}"; ?>" class="red" onclick="return confirm('Yakin akan menghapus permanen data ini ? \n *Data tidak bisa dikembalikan');"><i class="fa fa-trash"></i> Hapus Permanen</a></li>
						<?php }else{ ?>
							<li><a href="<?php echo "{$admPage['gbook']}&trash={$gbookRow->id}"; ?>" class="red"><i class="fa fa-trash"></i> Hapus</a></li>
						<?php } ?>
						</div>
					</div>
					</a>
					<?php
					}}
					?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php
include("footer.php");
?>