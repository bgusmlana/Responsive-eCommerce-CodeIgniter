<?php error_reporting(0);

function cek_session()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    if (empty($session)) {
        redirect(base_url());
    }
}

function cek_session_admin()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    if (empty($session)) {
        redirect('error404');
    } else if ($session != 1) {
        redirect('error404');
    }
}

function cek_session_members()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');

    if (empty($session)) {
        redirect('logout');
    } else if ($session != 2) {
        redirect(base_url());
    }
}

function favicon()
{
    $ci = &get_instance();
    $fav = $ci->db->query("SELECT favicon FROM tb_web_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $fav['favicon'];
}

function cek_session_reseller()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    if ($session != 'reseller') {
        redirect(base_url());
    }
}

function title()
{
    $ci = &get_instance();
    $title = $ci->db->query("SELECT nama_website FROM tb_web_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $title['nama_website'];
}

function description()
{
    $ci = &get_instance();
    $title = $ci->db->query("SELECT meta_deskripsi FROM tb_web_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $title['meta_deskripsi'];
}

function keywords()
{
    $ci = &get_instance();
    $title = $ci->db->query("SELECT meta_keyword FROM tb_web_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $title['meta_keyword'];
}

function filter($str)
{
    return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
}

function acakangkahuruf($panjang)
{
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter{
            $pos};
    }
    return $string;
}

function rupiah($total)
{
    return number_format($total, 0, ",", ".");
}

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function tgl_simpan($tgl)
{
    $tanggal = substr($tgl, 0, 2);
    $bulan = substr($tgl, 3, 2);
    $tahun = substr($tgl, 6, 4);
    return $tahun . '-' . $bulan . '-' . $tanggal;
}

function tgl_view($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}

function tgl_grafik($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function generateRandomString($length = 10)
{
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function seo_title($s)
{
    $c = array(' ');
    $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}

function hari_ini($w)
{
    $seminggu = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $hari_ini = $seminggu[$w];
    return $hari_ini;
}

function tgl_indoo($tgl)
{
    $bulan = getBulanbaru(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $bulan . ' ' . $tahun;
}

function tgl_indoos($tgl)
{
    $bulan = substr($tgl, 0, 2);
    $tahun = substr($tgl, 3, 4);
    return $tahun . '-' . $bulan;
}

function tgl_indoose($tgl)
{
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $bulan . '-' . $tahun;
}

function getBulanbaru($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
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

function cek_terakhir($datetime, $full = false)
{
    $today = time();
    $createdday = strtotime($datetime);
    $datediff = abs($today - $createdday);
    $difftext = "";
    $years = floor($datediff / (365 * 60 * 60 * 24));
    $months = floor(($datediff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($datediff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor($datediff / 3600);
    $minutes = floor($datediff / 60);
    $seconds = floor($datediff);
    //year checker  
    if ($difftext == "") {
        if ($years > 1)
            $difftext = $years . " Tahun";
        elseif ($years == 1)
            $difftext = $years . " Tahun";
    }
    //month checker  
    if ($difftext == "") {
        if ($months > 1)
            $difftext = $months . " Bulan";
        elseif ($months == 1)
            $difftext = $months . " Bulan";
    }
    //month checker  
    if ($difftext == "") {
        if ($days > 1)
            $difftext = $days . " Hari";
        elseif ($days == 1)
            $difftext = $days . " Hari";
    }
    //hour checker  
    if ($difftext == "") {
        if ($hours > 1)
            $difftext = $hours . " Jam";
        elseif ($hours == 1)
            $difftext = $hours . " Jam";
    }
    //minutes checker  
    if ($difftext == "") {
        if ($minutes > 1)
            $difftext = $minutes . " Menit";
        elseif ($minutes == 1)
            $difftext = $minutes . " Menit";
    }
    //seconds checker  
    if ($difftext == "") {
        if ($seconds > 1)
            $difftext = $seconds . " Detik";
        elseif ($seconds == 1)
            $difftext = $seconds . " Detik";
    }
    return $difftext;
}

function terbilang($x)
{
    $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    if ($x < 12)
        return " " . $abil[$x];
    elseif ($x < 20)
        return Terbilang($x - 10) . " Belas";
    elseif ($x < 100)
        return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
    elseif ($x < 200)
        return " Seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
        return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
        return " Seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
        return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
