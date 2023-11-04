<?php

class History_Penjualan_dedak extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['M_History_Penjualan_dedak' => 'History_Penjualan']);
	}

	public function index()
	{
		$data = [
			'title' => 'History Penjualan Dedak',
		];

		backView('history_penjualan_dedak/index', $data);
	}
	public function list_ajax()
	{
		$list = $this->History_Penjualan->get_datatables();
		$data = array();
		$no = 0;
		foreach ($list as $value) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $value->kode_slip;
			$row[] = $value->nama_relasi;
			$row[] = date('d-M-Y', strtotime($value->tanggal));
			$row[] = number_format($value->netto2);
			$row[] = number_format($value->total);
			$detail = "\"" . $value->kode_slip . "\",\"detail\"";
			$delete = "\"" . $value->kode_slip . "\",\"delete\"";
			$btn_detail =
				"<button type='button' class='btn btn-success btn-sm mr-1' data-toggle='modal'title='detail' data-target='#modalDetail' data-backdrop='static' onclick='get(" . $detail . ")'>
                <i class='fas fa-eye fa-xs'></i>
            </button>";
			$btn_delete =
				"<button type='button' class='btn btn-danger btn-sm mr-1' data-toggle='modal'title='Delete' data-target='#modalDelete' data-backdrop='static' onclick='get(" . $delete . ")'>
                <i class='fas fa-trash fa-xs'></i>
            </button>";

			if ($this->session->userdata('level') == "admin") {
				$action = $btn_detail . $btn_delete;
			} else {
				$action = $btn_detail;
			}
			$row[] = "<div class='row'>" . $action . "</div>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->History_Penjualan->count_all(),
			"recordsFiltered" => $this->History_Penjualan->count_filtered(),
			"data" => $data
		);
		//output to json format
		echo json_encode($output);
	}

	public function get()
	{
		$id = $this->input->post('id');
		$data['header'] = $this->History_Penjualan->getHead($id);
		echo json_encode($data);
	}
	public function getDetail()
	{
		$id = $this->input->post('id');
		$data['detail'] = $this->History_Penjualan->getDetail($id);
		echo json_encode($data);
	}
	public function remove()
	{
		$id = $this->input->post('kode_slip');
		$data = $this->History_Penjualan->remove($id);
		$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Berhasil Dihapus</div>');
		redirect('History_Penjualan_Dedak');
	}
	public function getNew()
	{
		$id = $this->input->post('id');
		$data = $this->History_Penjualan->getNew($id);
		echo json_encode($data);
	}
	public function create()
	{
		$data = $this->input->post();
		// $data['po_qty'] = str_replace(",", "", $this->input->post('po_qty'));
		$res = $this->History_Penjualan->create($data);
		echo json_encode($res);
	}
	public function update()
	{
		$id = $this->input->post('id_barang');
		$data = $this->input->post();
		// $data['po_qty'] = str_replace(",", "", $this->input->post('po_qty'));
		$res = $this->History_Penjualan->update($id, $data);
		echo json_encode($res);
	}
	public function list_relasi()
	{
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$res =   $this->History_Penjualan->list_relasi($start, $end);
		echo json_encode($res);
	}
	public function exportPdf()
	{
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$nama_relasi = $this->input->post('nama_relasi');

		$this->load->library('Pdf');
		$data['tanggal'] = date('d M Y', strtotime($start)) . " - " . date('d M Y', strtotime($end));
		$data['header'] = $this->History_Penjualan->exportPdf($start, $end, $nama_relasi);
		$data['total'] = $this->History_Penjualan->total($start, $end, $nama_relasi);
		$filename = "Print " . date('d-F-Y H:i:s');
		$this->History_Penjualan->print($filename, $data);
		echo json_encode($data);
	}
}
