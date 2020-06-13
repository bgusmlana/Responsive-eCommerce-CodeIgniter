<?php 
class Model_gallery extends CI_model{
    function album(){
        return $this->db->query("SELECT * FROM album ORDER BY id_album DESC");
    }

    function album_tambah(){
        $config['upload_path'] = 'assets/img_album/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        //$config['encrypt_name'] = TRUE;

        $new_name = 'phpmu_'.$_FILES["c"]['name'];
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('jdl_album'=>$this->input->post('a'),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'aktif'=>'Y',
                            'hits_album'=>'0',
                            'tgl_posting'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'),
                            'hari'=>hari_ini(date('w')),
                            'username'=>$this->session->username);
        }else{
            $datadb = array('jdl_album'=>$this->input->post('a'),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'gbr_album'=>$hasil['file_name'],
                            'aktif'=>'Y',
                            'hits_album'=>'0',
                            'tgl_posting'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'),
                            'hari'=>hari_ini(date('w')),
                            'username'=>$this->session->username);
        }
        $this->db->insert('album',$datadb);
    }

    function album_update(){
        $config['upload_path'] = 'assets/img_album/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('jdl_album'=>$this->input->post('a'),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'aktif'=>$this->input->post('f'),
                            'username'=>$this->session->username);
        }else{
            $datadb = array('jdl_album'=>$this->input->post('a'),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'gbr_album'=>$hasil['file_name'],
                            'aktif'=>$this->input->post('f'),
                            'username'=>$this->session->username);
        }
        $this->db->where('id_album',$this->input->post('id'));
        $this->db->update('album',$datadb);
    }

    function album_edit($id){
        return $this->db->query("SELECT * FROM album where id_album='$id'");
    }

    function album_delete($id){
        return $this->db->query("DELETE FROM album where id_album='$id'");
    }



    function gallery(){
        return $this->db->query("SELECT * FROM gallery a JOIN album b ON a.id_album=b.id_album ORDER BY a.id_gallery DESC");
    }

    function gallery_tambah(){
        $config['upload_path'] = 'assets/img_galeri/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('id_album'=>$this->input->post('aa'),
                            'username'=>$this->session->username,
                            'jdl_gallery'=>$this->input->post('a'),
                            'gallery_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'));
        }else{
            $datadb = array('id_album'=>$this->input->post('aa'),
                            'username'=>$this->session->username,
                            'jdl_gallery'=>$this->input->post('a'),
                            'gallery_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'gbr_gallery'=>$hasil['file_name']);
        }
        $this->db->insert('gallery',$datadb);
    }

    function gallery_update(){
        $config['upload_path'] = 'assets/img_galeri/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('id_album'=>$this->input->post('aa'),
                            'username'=>$this->session->username,
                            'jdl_gallery'=>$this->input->post('a'),
                            'gallery_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'));
        }else{
            $datadb = array('id_album'=>$this->input->post('aa'),
                            'username'=>$this->session->username,
                            'jdl_gallery'=>$this->input->post('a'),
                            'gallery_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'gbr_gallery'=>$hasil['file_name']);
        }
        $this->db->where('id_gallery',$this->input->post('id'));
        $this->db->update('gallery',$datadb);
    }

    function gallery_edit($id){
        return $this->db->query("SELECT * FROM gallery where id_gallery='$id'");
    }

    function gallery_delete($id){
        return $this->db->query("DELETE FROM gallery where id_gallery='$id'");
    }

    function public_album($sampai, $dari){
        return $this->db->query("SELECT * FROM album where aktif='Y' ORDER BY id_album DESC LIMIT $dari, $sampai");
    }

    function hitung_album(){
        return $this->db->query("SELECT * FROM album where aktif='Y'");
    }

    function album_dilihat($id, $total){
        $totalupdate = $total+1;
        $datadb = array('hits_album'=>$totalupdate);
        $this->db->where('id_album',$id);
        $this->db->update('album',$datadb);
    }

    function public_gallery($id){
        return $this->db->query("SELECT * FROM gallery where id_album='$id' ORDER BY id_gallery DESC");
    }

    function hitung_foto($id){
        return $this->db->query("SELECT * FROM gallery where id_album='$id'");
    }
}