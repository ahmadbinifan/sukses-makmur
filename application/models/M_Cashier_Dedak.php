<?php
class M_Cashier_Dedak extends CI_Model
{
	private $table = "tb_jual_dedak";
	private $primary = "kode_slip";
	var $column_order = array('kode_slip', 'jual_tanggal', 'jual_total', 'jual_jml_uang', 'jual_kembalian', 'jual_user_id', 'jual_keterangan', null); //set column field database for datatable orderable
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
	public function cetak_dedak($id)
	{
		return $this->db->select('*')->from($this->table)->where($this->primary, $id)->get()->row();
	}
	function create($data)
	{
		$res =  $this->db->insert($this->table, $data);
		return $res;
	}
	function generate_kode_slip()
	{
		$this->db->select('MAX(CAST(RIGHT(kode_slip,4) AS int)) AS num');
		$data = $this->db->get($this->table)->row();
		$max = sprintf("%04d", $data->num + 1);
		$format = $max;
		return $format;
	}
}
