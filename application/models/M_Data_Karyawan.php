<?php
class M_Data_Karyawan extends CI_Model
{
    private $table = "tb_karyawan";
    private $absen = "data_absen";
    private $absen_user = "data_absen_user";
    private $primary = "id_karyawan";
    var $column_order = array('avatar', 'nik', 'nama', 'id_karyawan', 'jenis_kelamin', 'alamat', 'tanggal_lahir', 'agama',  null); //set column field database for datatable orderable
    var $column_search = array('id_karyawan', 'nama'); //set column field database for datatable searchable 
    var $order = array('id_karyawan' => 'asc'); // default order 
    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        // $this->db->join('data_absen', 'data_absen.pin=tb_karyawan.id_karyawan');
        $this->db->order_by('nama', "ASC");

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
    public function exist($data)
    {
        $condition = ['id_karyawan' => $data['id_karyawan']];
        $res = $this->db->get_where($this->table, $condition)->row();
        if ($res) {
            return false;
        } else {
            return true;
        }
    }
    function create($data)
    {
        $res =  $this->db->insert($this->table, $data);
        return $res;
    }
    function update($id, $data)
    {
        $this->db->where($this->primary, $id);
        $res = $this->db->update($this->table, $data);
        return $res;
    }
    function remove($id)
    {
        $this->db->where($this->primary, $id);
        $res = $this->db->delete($this->table);
        return $res;
    }
    function listBarang()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $data = $this->db->get()->result();
        return $data;
    }
    function row_barang($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->primary, $id);
        $data = $this->db->get()->row_array();
        return $data;
    }
    function get_barang($kobar)
    {
        $hsl = $this->db->query("SELECT * FROM tb_barang where id_barang='$kobar'");
        return $hsl;
    }


    public function getHead($id)
    {
        $this->db->select('*')
            ->from($this->table)
            ->where($this->primary, $id);
        $data = $this->db->get()->row_array();
        return $data;
    }
    function getNew()
    {
        $this->db->select('MAX(CAST(RIGHT(id_barang,5) AS int)) AS num');
        $data = $this->db->get($this->table)->row();
        $max = sprintf("%05d", $data->num + 1);
        $format = "BRG" . $max;

        return $format;
    }
    function count_employee()
    {
        return $this->db->select('*')
            ->from($this->table)
            ->get()->num_rows();
    }
}
