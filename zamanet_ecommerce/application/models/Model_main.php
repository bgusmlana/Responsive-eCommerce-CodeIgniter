<?php
class Model_main extends CI_model
{

    function logo()
    {
        return $this->db->query("SELECT * FROM tb_web_logo");
    }

    function logo_update()
    {
        $config['upload_path'] = 'assets/images/logo/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '2000'; // kb
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('logo');
        $hasil = $this->upload->data();

        $query = $this->db->get_where('tb_web_logo', array('id_logo' => $this->input->post('id')));
        $row = $query->row();
        $logo = $row->gambar;
        $path = "assets/images/logo/";

        $datadb = array('gambar' => $hasil['file_name']);
        unlink($path . $logo);

        $this->db->where('id_logo', $this->input->post('id'));
        $this->db->update('tb_web_logo', $datadb);
    }

    function template()
    {
        return $this->db->query("SELECT * FROM templates");
    }

    function template_tambah()
    {
        $datadb = array(
            'judul' => $this->db->escape_str($this->input->post('a')),
            'username' => $this->session->username,
            'pembuat' => $this->db->escape_str($this->input->post('b')),
            'folder' => $this->db->escape_str($this->input->post('c')),
            'aktif' => $this->db->escape_str($this->input->post('d'))
        );
        $this->db->insert('templates', $datadb);
    }

    function template_update()
    {
        $datadb = array(
            'judul' => $this->db->escape_str($this->input->post('a')),
            'username' => $this->session->username,
            'pembuat' => $this->db->escape_str($this->input->post('b')),
            'folder' => $this->db->escape_str($this->input->post('c')),
            'aktif' => $this->db->escape_str($this->input->post('d'))
        );
        $this->db->where('id_templates', $this->input->post('id'));
        $this->db->update('templates', $datadb);
    }

    function template_edit($id)
    {
        return $this->db->query("SELECT * FROM templates where id_templates='$id'");
    }

    function template_delete($id)
    {
        return $this->db->query("DELETE FROM templates where id_templates='$id'");
    }



    function slide()
    {
        return $this->db->query("SELECT * FROM tb_web_slide ORDER BY id_slide DESC");
    }

    function slide_tambah()
    {
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        $this->upload->do_upload('file1');
        $file1 = $this->upload->data();

        $this->upload->do_upload('file2');
        $file2 = $this->upload->data();

        $datadb = array(

            'judul' => $this->input->post('judul'),
            'link' => $this->input->post('link'),
            'ket' => $this->db->escape_str($this->input->post('ket')),
            'gambar_besar' => $file1['file_name'],
            'gambar_kecil' => $file2['file_name'],
            'waktu' => date('Y-m-d H:i:s')
        );

        $this->db->insert('tb_web_slide', $datadb);
    }

    function slide_update()
    {


        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if (!empty($_FILES['file1']['name'])) {
            $this->upload->do_upload('file1');
            $file1 = $this->upload->data();
        }


        if (!empty($_FILES['file2']['name'])) {
            $this->upload->do_upload('file2');
            $file2 = $this->upload->data();
        }

        $query = $this->db->get_where('tb_web_slide', array('id_slide' => $this->input->post('id')));
        $row = $query->row();
        $foto1 = $row->gambar_besar;
        $foto2 = $row->gambar_kecil;
        $path = "assets/images/slider/";

        if ($file1['file_name'] == '' && $file2['file_name'] == '') {
            $datadb = array(
                'judul' => $this->input->post('judul'),
                'link' => $this->input->post('link'),
                'ket' => $this->db->escape_str($this->input->post('ket')),
            );
        } elseif ($file1['file_name'] == '') {
            $datadb = array(
                'judul' => $this->input->post('judul'),
                'link' => $this->input->post('link'),
                'ket' => $this->db->escape_str($this->input->post('ket')),
                'gambar_kecil' => $file2['file_name'],
            );
            unlink($path . $foto2);
        } elseif ($file2['file_name'] == '') {
            $datadb = array(
                'judul' => $this->input->post('judul'),
                'link' => $this->input->post('link'),
                'ket' => $this->db->escape_str($this->input->post('ket')),
                'gambar_besar' => $file1['file_name'],
            );
            unlink($path . $foto1);
        } else {
            $datadb = array(
                'judul' => $this->input->post('judul'),
                'link' => $this->input->post('link'),
                'ket' => $this->db->escape_str($this->input->post('ket')),
                'gambar_besar' => $file1['file_name'],
                'gambar_kecil' => $file2['file_name'],
            );
            unlink($path . $foto1);
            unlink($path . $foto2);
        }

        $this->db->where('id_slide', $this->input->post('id'));
        $this->db->update('tb_web_slide', $datadb);
    }

    function slide_edit($id)
    {
        return $this->db->query("SELECT * FROM tb_web_slide where id_slide='$id'");
    }

    function slide_delete($id)
    {
        $query = $this->db->get_where('tb_web_slide', array('id_slide' => $id));
        $row = $query->row();
        $foto1 = $row->gambar_besar;
        $foto2 = $row->gambar_kecil;
        $path = "assets/images/slider/";

        unlink($path . $foto1);
        unlink($path . $foto2);

        $this->db->where('id_slide', $id);
        $this->db->delete('tb_web_slide');
    }


    function identitas()
    {
        return $this->db->query("SELECT * FROM tb_web_identitas ORDER BY id_identitas DESC LIMIT 1");
    }

    function identitas_update()
    {
        $config['upload_path'] = 'assets/images/favicon/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $config['max_size'] = '500'; // kb
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('fav');
        $hasil = $this->upload->data();

        if ($hasil['file_name'] == '') {
            $datadb = array(
                'nama_website' => $this->db->escape_str($this->input->post('nama')),
                'email' => $this->db->escape_str($this->input->post('email')),
                'url' => $this->db->escape_str($this->input->post('url')),
                'rekening' => $this->db->escape_str($this->input->post('rek')),
                'no_telp' => $this->db->escape_str($this->input->post('telp')),
                'kota_id' => $this->db->escape_str($this->input->post('kota')),
                'alamat' => $this->db->escape_str($this->input->post('alamat')),
                'meta_deskripsi' => $this->db->escape_str($this->input->post('des')),
                'meta_keyword' => $this->db->escape_str($this->input->post('key')),
                'facebook' => $this->input->post('fb'),
                'twitter' => $this->input->post('tw'),
                'instagram' => $this->input->post('ig'),
                'youtube' => $this->input->post('yt'),
                'maps' => $this->db->escape_str($this->input->post('maps'))
            );
        } else {
            $datadb = array(
                'nama_website' => $this->db->escape_str($this->input->post('nama')),
                'email' => $this->db->escape_str($this->input->post('email')),
                'url' => $this->db->escape_str($this->input->post('url')),
                'rekening' => $this->db->escape_str($this->input->post('rek')),
                'no_telp' => $this->db->escape_str($this->input->post('telp')),
                'kota_id' => $this->db->escape_str($this->input->post('kota')),
                'alamat' => $this->db->escape_str($this->input->post('alamat')),
                'meta_deskripsi' => $this->db->escape_str($this->input->post('des')),
                'meta_keyword' => $this->db->escape_str($this->input->post('key')),
                'facebook' => $this->input->post('fb'),
                'twitter' => $this->input->post('tw'),
                'instagram' => $this->input->post('ig'),
                'youtube' => $this->input->post('yt'),
                'favicon' => $hasil['file_name'],
                'maps' => $this->db->escape_str($this->input->post('maps'))
            );
        }
        $this->db->where('id_identitas', 1);
        $this->db->update('tb_web_identitas', $datadb);
    }

    function keterangan()
    {
        return $this->db->query("SELECT * FROM t_keterangan ORDER BY id_keterangan DESC LIMIT 1");
    }

    function keterangan_update()
    {
        $datadb = array(
            'keterangan' => $this->input->post('a'),
            'tanggal_posting' => date('Y-m-d')
        );
        $this->db->where('id_keterangan', 1);
        $this->db->update('t_keterangan', $datadb);
    }


    function pesan_masuk()
    {
        return $this->db->query("SELECT * FROM hubungi ORDER BY id_hubungi DESC");
    }

    function pesan_baru($limit)
    {
        return $this->db->query("SELECT * FROM hubungi ORDER BY id_hubungi DESC LIMIT $limit");
    }

    function pesan_masuk_view($id)
    {
        return $this->db->query("SELECT * FROM hubungi where id_hubungi='$id'");
    }

    function pesan_masuk_kirim()
    {
        $nama           = $this->input->post('a');
        $email           = $this->input->post('b');
        $subject         = $this->input->post('c');
        $message         = $this->input->post('isi') . " <br><hr><br> " . $this->input->post('d');

        $this->email->from('robby.prihandaya@gmail.com', 'PHPMU.COM');
        $this->email->to($email);
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

    function grafik_kunjungan()
    {
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM tb_statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    function kunjungan()
    {
        $ip      = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu   = time();
        $cekk = $this->db->query("SELECT * FROM tb_statistik WHERE ip='$ip' AND tanggal='$tanggal'");
        $rowh = $cekk->row_array();
        if ($cekk->num_rows() == 0) {
            $datadb = array('ip' => $ip, 'tanggal' => $tanggal, 'hits' => '1', 'online' => $waktu);
            $this->db->insert('tb_statistik', $datadb);
        } else {
            $hitss = $rowh['hits'] + 1;
            $datadb = array('ip' => $ip, 'tanggal' => $tanggal, 'hits' => $hitss, 'online' => $waktu);
            $array = array('ip' => $ip, 'tanggal' => $tanggal);
            $this->db->where($array);
            $this->db->update('tb_statistik', $datadb);
        }
    }


    function kirim_Pesan()
    {
        $nama           = $this->input->post('a');
        $email           = $this->input->post('b');
        $subjek         = $this->input->post('c');
        $pesan         = $this->input->post('d');
        $datadb = array(
            'nama' => $nama,
            'email' => $email,
            'subjek' => $subjek,
            'pesan' => $pesan,
            'tanggal' => date('Y-m-d'),
            'jam' => date('H:i:s'),
            'dibaca' => 'N'
        );
        $this->db->insert('hubungi', $datadb);
    }
}
