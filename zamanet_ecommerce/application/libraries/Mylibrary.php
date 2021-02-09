<?php
date_default_timezone_set('Asia/Jakarta');

class Mylibrary
{
	function Size($path)
	{
		$bytes = sprintf('%u', filesize($path));
		if ($bytes > 0) {
			$unit = intval(log($bytes, 1024));
			$units = array('B', 'KB', 'MB', 'GB');

			if (array_key_exists($unit, $units) === true) {
				return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
			}
		}
		return $bytes;
	}

	function seo_title($s)
	{
		$c = array(' ');
		$d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
		$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
		$s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
		return $s;
	}

	function kdauto($tabel, $inisial)
	{
		$struktur = mysql_query("SELECT * FROM $tabel");
		$field = mysql_field_name($struktur, 0);
		$panjang = mysql_field_len($struktur, 0);

		$qry = mysql_query("SELECT max(" . $field . ") FROM " . $tabel);
		$row = mysql_fetch_array($qry);
		if ($row[0] == "") {
			$angka = 0;
		} else {
			$angka = substr($row[0], strlen($inisial));
		}

		$angka++;
		$angka = strval($angka);
		$tmp = "";
		for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
			$tmp = $tmp . "0";
		}
		return $inisial . $tmp . $angka;
	}

	function autolink($str)
	{
		$str = eregi_replace("([[:space:]])((f|ht)tps?:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $str); //http
		$str = eregi_replace("([[:space:]])(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $str); // www.
		$str = eregi_replace("([[:space:]])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})", "\\1<a href=\"mailto:\\2\">\\2</a>", $str); // mail
		$str = eregi_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str); //http
		$str = eregi_replace("^(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $str); // www.
		$str = eregi_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})", "<a href=\"mailto:\\1\">\\1</a>", $str); // mail
		return $str;
	}

	function anti_injection($data)
	{
		$filter = stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)));
		return $filter;
	}

	function greeting()
	{
		//mengatur zona waktu
		date_default_timezone_set("Asia/Jakarta");
		//variables 
		$welcome_string = "Welcome!";
		$numeric_date = date("G");

		//kondisioal untuk menampilkan ucapan menurut waktu/jam 
		if ($numeric_date >= 0 && $numeric_date <= 11)
			$welcome_string = "Selamat pagi!";
		else if ($numeric_date >= 12 && $numeric_date <= 14)
			$welcome_string = "Selamat siang!";
		else if ($numeric_date >= 15 && $numeric_date <= 17)
			$welcome_string = "Selamat sore!";
		else if ($numeric_date >= 18 && $numeric_date <= 23)
			$welcome_string = "Selamat malam!";

		echo "$welcome_string";
	}

	function format_rupiah($angka)
	{
		$rupiah = number_format($angka, 2, ",", ".");
		return $rupiah;
	}

	function getBulan($bln)
	{
		switch ($bln) {
			case 1:
				return "Jan";
				break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Agu";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Okt";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Des";
				break;
		}
	}

	function tgl_indo($tgl)
	{
		$tanggal = substr($tgl, 8, 2);
		$bulan = $this->getBulan(substr($tgl, 5, 2));
		$tahun = substr($tgl, 0, 4);
		return $tanggal . ' ' . $bulan . ' ' . $tahun;
	}

	function tgl_indoo($tgl)
	{
		$tanggal = substr($tgl, 8, 2);
		$bulan = $this->getBulan(substr($tgl, 5, 2));
		$tahun = substr($tgl, 0, 4);
		return $tanggal . '/' . $bulan;
	}
}



$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
function getOSs()
{
	global $user_agent;
	$os_platform    =   "Unknown";
	$os_array       =   array(
		'/windows nt 10/i'     =>  'Windows 10',
		'/windows nt 6.3/i'     =>  'Windows 8.1',
		'/windows nt 6.2/i'     =>  'Windows 8',
		'/windows nt 6.1/i'     =>  'Windows 7',
		'/windows nt 6.0/i'     =>  'Windows Vista',
		'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'     =>  'Windows XP',
		'/windows xp/i'         =>  'Windows XP',
		'/windows nt 5.0/i'     =>  'Windows 2000',
		'/windows me/i'         =>  'Windows ME',
		'/win98/i'              =>  'Windows 98',
		'/win95/i'              =>  'Windows 95',
		'/win16/i'              =>  'Windows 3.11',
		'/macintosh|mac os x/i' =>  'Mac OS X',
		'/mac_powerpc/i'        =>  'Mac OS 9',
		'/linux/i'              =>  'Linux',
		'/ubuntu/i'             =>  'Ubuntu',
		'/iphone/i'             =>  'iPhone',
		'/ipod/i'               =>  'iPod',
		'/ipad/i'               =>  'iPad',
		'/android/i'            =>  'Android',
		'/blackberry/i'         =>  'BlackBerry',
		'/webos/i'              =>  'Mobile'
	);

	foreach ($os_array as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			$os_platform    =   $value;
		}
	}
	return $os_platform;
}

function getBrowser()
{
	global $user_agent;
	$browser        =   "Unknown";
	$browser_array  =   array(
		'/msie/i'       =>  'Explorer',
		'/firefox/i'    =>  'Firefox',
		'/safari/i'     =>  'Safari',
		'/chrome/i'     =>  'Chrome',
		'/opera/i'      =>  'Opera',
		'/netscape/i'   =>  'Netscape',
		'/maxthon/i'    =>  'Maxthon',
		'/konqueror/i'  =>  'Konqueror',
		'/mobile/i'     =>  'Handheld'
	);

	foreach ($browser_array as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			$browser    =   $value;
		}
	}
	return $browser;
}
