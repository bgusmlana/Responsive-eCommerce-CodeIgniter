<?php
class Model_auth extends CI_model
{
    function register()
    {
        $ident = $this->db->query("SELECT * FROM tb_web_identitas where id_identitas='1'")->row_array();
        $email_tujuan = strip_tags($this->input->post('d'));
        $tglaktif = date("d-m-Y H:i:s");
        $subject      = 'Pendaftaran Sukses...';
        $message      = "<html><body>Halooo! <b>" . strip_tags($this->input->post('a')) . "</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda telah sukses mendaftar di $ident[nama_website],..
            <table style='width:100%; margin-left:25px'>
                <tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi Anda : </b></td></tr>
                <tr><td width='130px'><b>Nama Lengkap</b></td>        <td> : " . strip_tags($this->input->post('c')) . "</td></tr>
                <tr><td><b>Alamat Email</b></td>        <td> : " . strip_tags($this->input->post('d')) . "</td></tr>
                <tr><td><b>No Handphone</b></td>        <td> : " . strip_tags($this->input->post('l')) . "</td></tr>
                <tr><td><b>Alamat</b></td>                <td> : " . strip_tags($this->input->post('h')) . " </td></tr>
                
                <tr><td colspan='2'>Silahkan Login di $ident[url], salam sukses..</td></tr>
            </table><br>

            Admin, $ident[nama_website]
            </body></html> \n";

        $this->email->from($ident['email'], $ident['nama_website']);
        $this->email->to($email_tujuan);
        $this->email->cc('');
        $this->email->bcc('');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->email->send();

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
    }
}
