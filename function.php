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

function kueri($qry) {
	$kueri = mysql_query($qry) or die(mysql_error());
	return $kueri;
}

function update($qry) {
	$upd = mysql_query("update $qry") or die(mysql_error());
	return $upd;
}

function pilih($qry) {
	$plh = mysql_query("select $qry") or die(mysql_error());
	return $plh;
}

function tambah($sql) {
	$tbh = mysql_query("insert into $sql") or die(mysql_error());
	return $tbh;
}

function hapus($sql) {
	$dlt = mysql_query("delete from $sql") or die(mysql_error());
	return $dlt;

}

function tampilinO($sql) {
	$fo = mysql_fetch_object($sql);
	return $fo;
}

function tampilinA($sql) {
	$fa = mysql_fetch_array($sql);
	return $fa;
}

function itung_row($sql) {
	$nr = mysql_num_rows($sql);
	return $nr;
}

function hasil($sql,$row) {
	$mr = mysql_result($sql,$row);
	return $mr;
}

function ambilIP() {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function email($email) {
	$email = explode("@", $email);
	$domain = end($email);
	return $domain;
}

function tanggalType($format, $tanggal="now", $bahasa="id"){
	$en = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb", "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$id = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
	$fr = array("dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi","janvier","février","mars","avril","Mei","mai","juillet","aoùt","septembre","octobre","novembre","décembre");
	return str_replace($en,$$bahasa,date($format,strtotime($tanggal)));
}

function remove_index() {
	$self_ROOT = $_SERVER['PHP_SELF'];
	$self_EXPL = explode("/", $self_ROOT);
	$self = end($self_EXPL);
	if($self == "index.php") {
		header("location: $site[root]");
	}else{
		// do something
	}
}

function base_url() {
	global $site_url;
	return $site_url;
}

function base_url_admin() {
	global $site_url_admin;
	return $site_url_admin;
}

function url_origin($s, $use_forwarded_host = false) {
  $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
  $sp       = strtolower( $s['SERVER_PROTOCOL'] );
  $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
  $port     = $s['SERVER_PORT'];
  $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
  $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
  $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
  return $protocol . '://' . $host;
}

function this_full_url() {
  return url_origin( $_SERVER, false ) . $_SERVER['REQUEST_URI'];
}

function this_page($trim=true, $param=true) {
	global $url_prefix;
	$page = this_full_url();
	$page = explode(base_url(), $page);
	$page = $page[1];
	if(false == $param) {
		$page = explode("?", $page);
		$page = $page[0];
	}
	if($trim == true) {
		$page = rtrim($page, $url_prefix);
	}
	return $page;
}

function this_page_admin($trim=true, $param=true, $and=true) {
	global $url_prefix;
	$page = this_full_url();
	$page = explode(base_url_admin(), $page);
	$page = $page[1];
	if(false == $param) {
		$page = explode("?", $page);
		$page = $page[0];
	}
	if($trim == true) {
		$page = rtrim($page, $url_prefix);
	}
	if($and == false) {
		$page = explode("&", $page);
		$page = $page[0];
	}
	return $page;
}
?>
