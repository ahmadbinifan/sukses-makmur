<?php
class M_History_Penjualan_dedak extends CI_Model
{
	private $table = "tb_jual_dedak";
	private $primary = "kode_slip";
	var $column_order = array('kode_slip', 'tanggal', 'nama_relasi', 'netto2', 'total', 'keterangan', null); //set column field database for datatable orderable
	var $column_search = array('kode_slip', 'tanggal', 'nama_relasi'); //set column field database for datatable searchable 
	var $order = array('kode_slip' => 'asc'); // default order 
	private function _get_datatables_query()
	{
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$nama_relasi = $this->input->post('nama_relasi');
		$this->db->select('*');
		$this->db->from($this->table);
		if ($start && $end) {
			$this->db->where('DATE(tanggal) >=', date('Y-m-d', strtotime($start)));
			$this->db->where('DATE(tanggal) <=', date('Y-m-d', strtotime($end)));
		}
		if ($nama_relasi) {
			$this->db->where('nama_relasi', $nama_relasi);
		}


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
	public function getHead($id)
	{
		$this->db->select('*')
			->from($this->table)
			->where($this->primary, $id);
		$data = $this->db->get()->row_array();
		return $data;
	}
	public function getDetail($id)
	{
		$this->db->select('*')
			->from($this->tableDetail)
			->where('d_jual_nofak', $id);
		$data = $this->db->get()->result();
		return $data;
	}
	public function remove($id)
	{
		$this->db->where('kode_slip', $id);
		$res = $this->db->delete($this->table);
		return $res;
	}
	public function list_relasi($start, $end)
	{
		$this->db->select('nama_relasi')->from($this->table);
		$this->db->where('DATE(tanggal) >=', date('Y-m-d', strtotime($start)));
		$this->db->where('DATE(tanggal) <=', date('Y-m-d', strtotime($end)));
		$this->db->group_by('nama_relasi');
		$res = $this->db->get()->result();
		return $res;
	}
	public function exportPdf($start, $end, $relasi)
	{
		$this->db->select('*')->from($this->table);
		if ($start && $end) {
			$this->db->where('DATE(tanggal) >=', date('Y-m-d', strtotime($start)));
			$this->db->where('DATE(tanggal) <=', date('Y-m-d', strtotime($end)));
		}
		if ($relasi) {
			$this->db->where('nama_relasi', $relasi);
		}
		$result = $this->db->get()->result_array();
		return $result;
	}
	public function total($start, $end, $relasi)
	{
		// $this->db->select('*,SUM(jual_total) AS amount');
		$this->db->select('sum(total) as total');
		$this->db->from($this->table);
		if ($start && $end) {
			$this->db->where('DATE(tanggal) >=', date('Y-m-d', strtotime($start)));
			$this->db->where('DATE(tanggal) <=', date('Y-m-d', strtotime($end)));
		}
		if ($relasi) {
			$this->db->where('nama_relasi', $relasi);
		}
		$result = $this->db->get()->row_object();
		return $result->total;
	}
	public function print($fileName, $data)
	{
		$data['title'] = "Selamat Makmur";
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = $fileName . ".pdf";
		$ci = get_instance();
		$html = $ci->load->view('cetak/history_penjualan_dedak', $data, TRUE);
		$this->pdf->generate($html);
	}
}
