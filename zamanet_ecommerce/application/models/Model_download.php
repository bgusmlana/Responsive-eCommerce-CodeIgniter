<?php 
class Model_download extends CI_model{
    function index(){
        return $this->db->query("SELECT * FROM download ORDER BY id_download DESC");
    }

    function updatehits($id){
        return $this->db->query("UPDATE download SET hits=hits+1 where nama_file='".$this->db->escape_str($id)."'");
    }

    function download_tambah(){
        $config['upload_path'] = 'assets/files/';
        $config['allowed_types'] = 'txt|pdf|doc|docx|ppt|pptx|xls|xlsx';
        $config['max_size'] = '30000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
            		$datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_file'=>$hasil['file_name'],
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
        $this->db->insert('download',$datadb);
    }

    function download_edit($id){
        return $this->db->query("SELECT * FROM download where id_download='$id'");
    }

    function download_update(){
        $config['upload_path'] = 'assets/files/';
        $config['allowed_types'] = 'txt|pdf|doc|docx|ppt|pptx|xls|xlsx';
        $config['max_size'] = '30000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
                if ($hasil['file_name']==''){
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')));
                }else{
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_file'=>$hasil['file_name']);
                }
        $this->db->where('id_download',$this->input->post('id'));
        $this->db->update('download',$datadb);
    }

    function download_delete($id){
        return $this->db->query("DELETE FROM download where id_download='$id'");
    }
}