<?php
/**
 * Sympel (CMS)
 *
 * Sympel adalah sebuah Content Management System(CMS) sederhana
 * yang dibuat untuk web dengan satu halaman. Tujuan utama
 * dibuatnya CMS ini untuk dipelajari dan dikembangkan kembali.
 *
 * @package  Sympel
 * @author   Multinity
 * @copyright	Copyright (c) 2014 - 2016, Multinity
 * @license	http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License v3
 * @link	https://multinity.github.io/sympel/
 *
 */

/**
 * ROOTPATH
 *
 * Mengambil alamat akar(root) folder
 */
$root_p = $_SERVER['DOCUMENT_ROOT'];
$root_p2 = $_SERVER['PHP_SELF'];
$root_p2 = explode("/", $root_p2);
define('ROOTPATH', $root_p.'/'.$root_p2[1]);

/**
 * Pengecekan file db.php
 */
if(file_exists(ROOTPATH . "/db.php")) {
	include(ROOTPATH . "/db.php");
}

/**
 * Memanggil file function.php
 */
include("function.php");

/**
 * Mendefinisikan nama folder
 * @var string
 */
$dir 								= "";
$dir['previx'] 			= "";
$dir['install'] 		= "{$dir['previx']}pasang";
$dir['lib'] 				= "{$dir['previx']}lib";
$dir['css'] 				= "{$dir['lib']}/css";
$dir['js'] 					= "{$dir['lib']}/js";
$dir['img'] 				= "{$dir['lib']}/img";
$dir['themes'] 			= "{$dir['previx']}themes";
$dir['upload'] 			= "{$dir['lib']}/upload";
$dir['plugin'] 			= "{$dir['lib']}/plugin";
$dir['inc'] 				= "{$dir['lib']}/inc";
$dir['upload-img'] 	= "{$dir['lib']}/upload/img";
$dir['upload-tim'] 	= "{$dir['lib']}/upload/tim";

/**
 * Mendefinisikan file yang umum digunakan
 * @var string
 */
$fileNow 				= $_SERVER['PHP_SELF'];
$fileNow 				= explode("/",$fileNow);
$file['error'] 	= "error.php";
$file['css'] 		= "style.css";
$file['fa'] 		= "fa/css/font-awesome.css";
$file['fa.min'] = "fa/css/font-awesome.min.css";

/**
 * Mendefinisikan nama tabel
 * @var string
 */
$tb 							= "";
$tb['setting'] 		= $db['previx'] . "setting";
$tb['user'] 			= $db['previx'] . "user";
$tb['themes'] 		= $db['previx'] . "themes";
$tb['gbook']	 		= $db['previx'] . "gbook";
$tb['halaman'] 		= $db['previx'] . "halaman";
$tb['portofolio'] = $db['previx'] . "portofolio";
$tb['partner']		= $db['previx'] . "partner";
$tb['pelayanan']	= $db['previx'] . "service";

/**
 * Informasi CMS
 */
$site['author'] 		= "Muhamd Nauval Azhar";
$site['cms'] 				= "Sympel";
$site['link']				= "https://multinity.github.io/sympel/";
$site['version']		= "1.2";
$site['cms_logo']		= $dir['img']."/logo.png";

/**
 * Mengambil informasi pengaturan dari tabel $tb['setting']
 */
if(file_exists(ROOTPATH . "/db.php")) :
	$sql_sitetitle 	= pilih("* from {$tb['setting']} where name = 'site_title'");
	$site_title_row = mysql_fetch_object($sql_sitetitle);
	$sql_sitelogo 	= pilih("* from {$tb['setting']} where name = 'site_logo'");
	$site_logo_row = mysql_fetch_object($sql_sitelogo);
	$sql_sitetagline 	= pilih("* from {$tb['setting']} where name = 'site_tagline'");
	$site_tagline_row = mysql_fetch_object($sql_sitetagline);
	$sql_siteroot 	= pilih("* from {$tb['setting']} where name = 'site_root'");
	$site_root_row = mysql_fetch_object($sql_siteroot);
	$sql_siteadmin 	= pilih("* from {$tb['setting']} where name = 'site_admin'");
	$site_admin_row = mysql_fetch_object($sql_siteadmin);
	$sql_sitefavicon = pilih("* from {$tb['setting']} where name = 'site_icon'");
	$site_favicon_row = mysql_fetch_object($sql_sitefavicon);

	// Site Info
	$site['root'] 			= @$site_root_row->value;
	$site_url 					= $site['root'];
	$site['admin'] 			= @$site_admin_row->value;
	$site_url_admin 		= $site['admin'];
	$site['title'] 			= @$site_title_row->value;
	$site['logo'] 			= @$site_logo_row->value;
	$site['tagline'] 		= @$site_tagline_row->value;
	$site['tanda'] 			= " &mdash; ";
	$site['login'] 			= "login.php";
	$site['favicon'] 		= "{$dir['upload-img']}/".@$site_favicon_row->value;
	$site['favicon-only'] 	= @$site_favicon_row->value;

	// themes
	$sql_getthemes 	= pilih("* from {$tb['themes']} where status = 'Y'");
	$themes_row 	= mysql_fetch_object($sql_getthemes);
	$themes['id'] 		= @$themes_row->id;
	$themes['dir'] 		= @$themes_row->tema;
	$themes['thumb'] 	= @$themes_row->thumb;
	$themes['nama'] 	= @$themes_row->nama;
	$themes['author'] 	= @$themes_row->author;
	$themes['tahun'] 	= @$themes_row->tahun;
	$themes['real_dir'] = "{$dir['themes']}/{$themes['dir']}";
	$themes['dir_file'] = "{$dir['themes']}/{$themes['dir']}/index.php";
	$themes['root_dir'] = "{$site['root']}{$dir['themes']}/{$themes['dir']}";
	$themes['css'] 		= "css/style.css";
	$themes['css-session'] 	= "css/style-after.css";
	$themes['js'] 		= "js/jquery.min.js";
	$themes['img'] 		= "img";
	$themes['view'] 	= "view";
	$themes['plugin']	= "plugin";
	$themes['notfound'] = "notfound.php";
	$themes['default']  = @$dir['themes'] . "/" . @$dir['themes_def'] . "/" . "index.php";
	$themes['footer'] 	= "footer.php";
	$themes['main'] 	= "main.php";
	$themes['header'] 	= "header.php";

	$session['user_adm'] 	= @$_SESSION['usadm'];

	$admin['title'] 	= "Admin";
	$admin['logo'] 		= $site['root'].$dir['img']."/logo.png";
	$admin['url'] 		= "admin";
	$admin['lib']  		= "lib";
	$admin['css'] 		= "{$admin['lib']}/css/style.css";
	$admin['css-login'] = "{$admin['lib']}/css/login.css";
	$admin['fonts'] = "{$admin['lib']}/css/fonts.css";
	$admin['js'] 		= "{$admin['lib']}/js/jquery.min.js";
	$admin['admin-js'] 		= "{$admin['lib']}/js/admin.js";
	$admin['fa'] 		= "{$admin['lib']}/fa/css/font-awesome.css";
	$admin['fa.min'] 	= "{$admin['lib']}/fa/css/font-awesome.min.css";

	// data intro
	$sql_intro 		= pilih("* from {$tb['halaman']} where status = 'INTRO'");
	$introRow 			= mysql_fetch_object($sql_intro);
	$intro['header'] 	= $introRow->judul;
	$intro['isi'] 		= $introRow->isi;
	$intro['menu'] 		= $introRow->menu;

	// data tentang
	$sql_hTentang 		= pilih("* from {$tb['halaman']} where status = 'TENTANG'");
	$hTentang 			= mysql_fetch_object($sql_hTentang);
	$tentang['header'] 	= $hTentang->judul;
	$tentang['isi'] 	= $hTentang->isi;
	$tentang['menu'] 	= $hTentang->menu;

	// data kontak
	$sql_hKontak 		= pilih("* from {$tb['halaman']} where status = 'KONTAK'");
	$hKontak 			= mysql_fetch_object($sql_hKontak);
	$kontak['header'] 	= $hKontak->judul;
	$kontak['isi'] 		= $hKontak->isi;
	$kontak['informasi']= $hKontak->informasi;
	$kontak['facebook']	= $hKontak->facebook;
	$kontak['twitter']	= $hKontak->twitter;
	$kontak['gplus']	= $hKontak->gplus;
	$kontak['url']		= $hKontak->url;
	$kontak['menu'] 	= $hKontak->menu;

	// User admin
	$sql_userA 	= pilih("* from {$tb['user']} where username = '{$session['user_adm']}'");
	$user_row 	= tampilinO($sql_userA);
	$nama_ex = explode(" ", @$user_row->nama);
	$nama_depan = @$nama_ex[0];
	$user['id'] 		= @$user_row->id;
	$user['nama'] 		= @$user_row->nama;
	$user['nama_depan'] 		= @$nama_depan;
	$user['username'] 	= @$user_row->username;
	$user['password'] 	= @$user_row->password;
	$user['email'] 		= @$user_row->email;
	$user['website'] 	= @$user_row->website;
	$user['tanggal'] 	= @$user_row->tanggal;
	$user['status'] 	= @$user_row->status;
	$user['foto'] 		= @$user_row->foto;

	// Page Admin
	$admPage['rule'] 		= "?p=";
	$admPage['home'] 		= "index.php";
	$admPage['setting'] 	= "{$admPage['home']}{$admPage['rule']}pengaturan";
	$admPage['tema'] 		= "{$admPage['home']}{$admPage['rule']}tema";
	$admPage['tema-act']	= "{$admPage['home']}{$admPage['rule']}tema&act=";
	$admPage['profile']		= "{$admPage['home']}{$admPage['rule']}profile";
	$admPage['keluar']		= "{$admPage['home']}{$admPage['rule']}logout";
	$admPage['editor']		= "{$admPage['home']}{$admPage['rule']}editor";
	$admPage['editor-act']	= "{$admPage['home']}{$admPage['rule']}editor&tema=";
	$admPage['hlm-depan'] 	= "{$admPage['home']}{$admPage['rule']}halaman-depan";
	$admPage['tentang'] 	= "{$admPage['home']}{$admPage['rule']}tentang";
	$admPage['portofolio'] 	= "{$admPage['home']}{$admPage['rule']}portofolio";
	$admPage['gbook'] 		= "{$admPage['home']}{$admPage['rule']}buku-tamu";
	$admPage['kontak'] 		= "{$admPage['home']}{$admPage['rule']}kontak-saya";
	$admPage['partner']		= "{$admPage['home']}{$admPage['rule']}partner";
	$admPage['tentang-cms']		= "{$admPage['home']}{$admPage['rule']}about";
	$admPage['maps']		= "{$admPage['home']}{$admPage['rule']}maps";
	$admPage['service']		= "{$admPage['home']}{$admPage['rule']}service";

	$sql_statIntro 			= pilih("* from {$tb['setting']} where name = 'page_intro'");
	$statIntro 				= tampilinO($sql_statIntro);
	$sql_statPortofolio		= pilih("* from {$tb['setting']} where name = 'page_portofolio'");
	$statPortofolio 		= tampilinO($sql_statPortofolio);
	$sql_statAbout 			= pilih("* from {$tb['setting']} where name = 'page_about'");
	$statAbout 				= tampilinO($sql_statAbout);
	$sql_statPartner 		= pilih("* from {$tb['setting']} where name = 'page_partner'");
	$statPartner 			= tampilinO($sql_statPartner);
	$sql_statContact 		= pilih("* from {$tb['setting']} where name = 'page_contact'");
	$statContact 			= tampilinO($sql_statContact);

	$pageStat['intro'] 		= @$statIntro->value;
	$pageStat['portofolio'] = @$statPortofolio->value;
	$pageStat['about'] 		= @$statAbout->value;
	$pageStat['partner'] 	= @$statPartner->value;
	$pageStat['contact'] 	= @$statContact->value;
endif;

$logoPowered = @$site['root']. "{$dir['img']}/logo.png";

?>
