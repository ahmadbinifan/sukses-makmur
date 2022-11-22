<?php
class M_Cashier extends CI_Model
{
    private $table = "tb_jual";
    private $primary = "jual_nofak";
    var $column_order = array('jual_nofak', 'jual_tanggal', 'jual_total', 'jual_jml_uang', 'jual_kembalian', 'jual_user_id', 'jual_keterangan', null); //set column field database for datatable orderable
    var $column_search = array('jual_nofak', 'jual_tanggal'); //set column field database for datatable searchable 
    var $order = array('jual_nofak' => 'asc'); // default order 
    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        // $this->db->join('tb_kategori', 'tb_kategori.kategori_id=tb_barang.id_kategori_barang');

        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function create($data)
    {
        $res =  $this->db->insert($this->table, $data);
        return $res;
    }
    function simpan_penjualan($nofak, $total, $jml_uang, $kembalian, $customer)
    {
        $this->db->query("INSERT INTO tb_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_customer) VALUES ('$nofak','$total','$jml_uang','$kembalian','$customer')");
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'd_jual_nofak'             =>    $nofak,
                'd_jual_barang_id'        =>    $item['id'],
                'd_jual_barang_nama'    =>    $item['name'],
                'd_jual_barang_satuan'    =>    $item['satuan'],
                'd_jual_barang_harpok'    =>    $item['harpok'],
                'd_jual_qty'            =>    $item['qty'],
                'd_jual_total'            =>    $item['price']
            );
            $this->db->insert('tb_detail_jual', $data);
            $this->db->query("update tb_barang set stok_barang=stok_barang-'$item[qty]' where id_barang='$item[id]'");
        }
        return true;
    }
    function get_nofak()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM tb_jual WHERE DATE(jual_tanggal)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        return date('dmy') . $kd;
    }
    function cetak_faktur()
    {
        $nofak = $this->session->userdata('nofak');
        $this->db->select('*')
            ->from($this->table)
            ->where($this->primary, $nofak)
            ->join('tb_detail_jual', 'tb_detail_jual.d_jual_nofak=tb_jual.jual_nofak');
        $res = $this->db->get()->row_array();
        return $res;
    }
    function cetak_faktur_detail()
    {
        $nofak = $this->session->userdata('nofak');
        $this->db->select('*')
            ->from($this->table)
            ->where($this->primary, $nofak)
            ->join('tb_detail_jual', 'tb_detail_jual.d_jual_nofak=tb_jual.jual_nofak');
        $res = $this->db->get()->result_array();
        return $res;
    }
}
