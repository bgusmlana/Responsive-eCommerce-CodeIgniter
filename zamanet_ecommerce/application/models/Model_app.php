<?php
class Model_app extends CI_model
{
    public function view($table)
    {
        return $this->db->get($table);
    }

    public function get_by_id($id)
    {
        $this->db->from('tb_toko_produk');
        $this->db->where('id_produk', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function edit($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function view_where($table, $data)
    {
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_ordering_limit($table, $order, $ordering, $baris, $dari)
    {
        $this->db->select('*');
        $this->db->order_by($order, $ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_where_ordering_limit($table, $data, $order, $ordering, $baris, $dari)
    {
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by($order, $ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_ordering($table, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order, $ordering);
        return $this->db->get()->result_array();
    }

    public function view_where_ordering($table, $data, $order, $ordering)
    {
        $this->db->where($data);
        $this->db->order_by($order, $ordering);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function view_join_one($table1, $table2, $field, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->order_by($order, $ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_where($table1, $table2, $field, $where, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->where($where);
        $this->db->order_by($order, $ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_rows($table1, $table2, $field, $where, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->where($where);
        $this->db->order_by($order, $ordering);
        return $this->db->get();
    }

    public function view_join_where_one($table1, $table2, $field, $where)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->where($where);
        return $this->db->get();
    }

    public function view_join_where_two($table1, $table2, $table3, $field1, $field2, $field3, $field4, $where)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field1 . '=' . $table2 . '.' . $field2);
        $this->db->join($table3, $table2 . '.' . $field3 . '=' . $table3 . '.' . $field4);
        $this->db->where($where);
        return $this->db->get();
    }

    function cari_produk($kata)
    {
        $pisah_kata = explode(" ", $kata);
        $jml_katakan = (int) count($pisah_kata);
        $jml_kata = $jml_katakan - 1;
        $cari = "SELECT * FROM tb_toko_produk WHERE ";
        for ($i = 0; $i <= $jml_kata; $i++) {
            $cari .= " nama_produk LIKE '%" . $pisah_kata[$i] . "%'";
            if ($i < $jml_kata) {
                $cari .= " OR ";
            }
        }
        $cari .= " ORDER BY id_produk ASC";
        return $this->db->query($cari);
    }

    public function cek_login($username, $password, $table)
    {
        return $this->db->query("SELECT * FROM $table where username='" . $this->db->escape_str($username) . "' AND password='" . $this->db->escape_str($password) . "'");
    }

    function grafik_kunjungan()
    {
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM tb_statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    function orders_report($id)
    {
        return $this->db->query("SELECT * FROM `tb_toko_penjualan` a where a.id_pembeli='$id' ORDER BY a.id_penjualan DESC");
    }

    function konfirmasi_bayar()
    {
        return $this->db->query("SELECT b.kode_transaksi, a.*, c.* FROM `tb_toko_konfirmasi` a JOIN tb_toko_penjualan b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_rekening c ON a.id_rekening=c.id_rekening ORDER BY a.id_konfirmasi_pembayaran DESC");
    }

    function orders_report_all()
    {
        return $this->db->query("SELECT * FROM `tb_toko_penjualan` a ORDER BY a.id_penjualan DESC");
    }


    function orders_report_packing()
    {
        return $this->db->query("SELECT * FROM `tb_toko_penjualan` a where a.proses='3' ORDER BY a.id_penjualan DESC");
    }

    function orders_report_home($limit)
    {
        return $this->db->query("SELECT * FROM `tb_toko_penjualan` a ORDER BY a.id_penjualan DESC LIMIT $limit");
    }

    function profile_konsumen($id)
    {
        $this->db->join('tb_alamat', 'tb_alamat.id_alamat = tb_pengguna.id_alamat');
        $this->db->join('tb_kota', 'tb_alamat.id_kota = tb_kota.kota_id');
        return $this->db->get_where('tb_pengguna', "tb_pengguna.id_pengguna='$id'");
    }

    function alamat_konsumen($id)
    {
        $this->db->join('tb_kota', 'tb_kota.kota_id = tb_alamat.id_kota');
        return $this->db->get_where('tb_alamat', "id_alamat='$id'");
    }


    public function emailsend()
    {

        $query = $this->db->query("SELECT email from tb_subs WHERE aktif='1'");
        $sendTo = array();
        foreach ($query->result() as $row) {
            $sendTo[] = $row->email;
        }

        return $sendTo;
    }
}
