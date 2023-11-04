<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier_dedak extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'M_Data_Barang' => 'Data_Barang',
			'M_Cashier_Dedak' => 'Cashier',
			'M_Cart' => 'Cart',
		]);
	}

	public function index()
	{
		$data['title'] = 'Penjualan Dedak';
		$data['listBarang'] = $this->Data_Barang->listBarang();
		$data['generate_kode'] = $this->Cashier->generate_kode_slip();
		backView('cashier_dedak/index', $data);
	}
	public function create()
	{
		$data = $this->input->post();
		$data['harga'] = str_replace(".", "", $data['harga']);
		$data['bruto'] = str_replace(".", "", $data['bruto']);
		$data['tara'] = str_replace(".", "", $data['tara']);
		$data['potongan'] = str_replace(".", "", $data['potongan']);
		$data['netto1'] = str_replace(".", "", $data['netto1']);
		$data['netto2'] = str_replace(".", "", $data['netto2']);
		$data['total'] = str_replace(".", "", $data['total']);
		$res = $this->Cashier->create($data);
		if ($res) {
			$this->session->set_userdata('kode_slip', $data['kode_slip']);
			redirect('alert/sukses_dedak');
		} else {
			redirect('cashier_dedak');
		}
	}
	public function getBarang()
	{
		$id = $this->input->post('nama_barang');
		$data = $this->Data_Barang->row_barang($id);
		echo json_encode($data);
	}
	function add_to_cart2()
	{
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'kasir') {
			$kobar = $this->input->post('nama_barang');
			$produk = $this->Data_Barang->get_barang($kobar);
			$i = $produk->row_array();
			$data = array(
				'id'       => $i['id_barang'],
				'name'     => $i['nama_barang'],
				'satuan'   => $i['satuan_barang'],
				'harpok'   => $i['harga_jual_grosir_barang'],
				'price'      => str_replace(",", "", $this->input->post('harga')),
				'qty'      => $this->input->post('jumlah'),
			);
			// var_dump($this->cart->total_items());
			// die;
			// if ($this->cart->total_items() > 0) {
			//     $count_bar = 0;
			//     foreach ($this->cart->contents() as $items) {
			//         $id = $items['id'];
			//         $qtylama = $items['qty'];
			//         $rowid = $items['rowid'];
			//         $kobar = $this->input->post('nama_barang');
			//         $qty = 1;
			//         if ($id == $kobar) {
			//             $count_bar = 1;
			//             $up = array(
			//                 'rowid' => $rowid,
			//                 'qty' => $qtylama + $qty
			//             );
			//             $this->cart->update($up);
			//         } else if ($count_bar == 0) {
			//             $this->cart->insert($data);
			//         }
			//     }
			// } else {
			// }
			$this->cart->insert($data);
			redirect('Cashier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function add_to_cart()
	{
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'kasir') {
			$kobar = $this->input->post('nama_barang');
			$quantity = $this->input->post('jumlah');
			$produk = $this->Data_Barang->get_barang($kobar);
			$i = $produk->row_array();
			if (count($i) == 0) {
				echo $this->session->set_flashdata('msg', '<label class="label label-danger">Data Tidak Ditemukan</label>');
				redirect('Cashier');
			}
			$data = array(
				'id'       => $i['id_barang'],
				'name'     => str_replace(",", ".", $i['nama_barang']),
				'satuan'   => $i['satuan_barang'],
				'harpok'   => $i['harga_jual_grosir_barang'],
				'price'      => str_replace(",", "", $this->input->post('harga')),
				'qty'      => $quantity,
				'subtotal' => $i['harga_jual_grosir_barang'] * $quantity,
			);

			$count_cart = count($this->Cart->tampil_cart()->result_array());

			if ($count_cart > 0) {

				$count_bar = 0;
				$check_cart_items = count($this->Cart->get_cart_by_id($kobar)->result_array());

				// Jika Ada di Tbl_cart, maka update
				if ($check_cart_items > 0) {
					foreach ($this->Cart->tampil_cart()->result_array() as $items) {
						$id = $items['id'];
						$qtylama = $items['qty'];
						$harga_lama = $items['price'];
						$rowid = $items['rowid'];
						$kobar = $this->input->post('nama_barang');
						$qty = $quantity;

						if ($id == $kobar) {
							$subtotal = $harga_lama;
							$qty_baru = $qtylama + $qty;
							$subtotal_baru = $subtotal * $qty_baru;
							// Count Bar -> Cek apakah barang sudah ada di dalam list cart atau tidak
							$count_bar = 1;
							$up = array(
								'rowid' => $rowid,
								'qty' => $qty_baru,
								'subtotal' => $subtotal_baru
							);
							// $this->cart->update($up);
							$this->Cart->update_qty_cart($qty_baru, $subtotal_baru, $id);
						}
					}
				} else {
					$this->Cart->simpan_cart($data);
				}
			} else {
				// $this->cart->insert($data);
				$this->Cart->simpan_cart($data);
			}
			redirect('Cashier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function simpan_penjualan()
	{
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'kasir') {
			$total = str_replace(",", "", $this->input->post('total'));
			$customer = $this->input->post('customer_name');
			$nohp = $this->input->post('customer_nohp');
			$alamat = $this->input->post('customer_alamat');
			$data = [
				'nama_customer' => $customer,
				'nohp' => $nohp,
				'alamat' => $alamat,
				'created_at' => date('Y-m-d H:i:s')
			];
			// $jual_total_barang = $this->input->post('qty');
			if (!empty($customer) && !empty($nohp) && !empty($alamat)) {
				$nofak = $this->Cashier->get_nofak();
				$this->session->set_userdata('nofak', $nofak);
				$order_proses = $this->Cashier->simpan_penjualan($nofak, $total, $data, $customer, $nohp, $alamat);
				if ($order_proses) {
					$this->Cart->hapus_tb_cart();

					$this->session->unset_userdata('tglfak');
					$this->session->unset_userdata('suplier');
					redirect('alert/sukses');
				} else {
					redirect('Cashier_dedak');
				}
			} else {
				echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
				redirect('Cashier');
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function remove2()
	{
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'kasir') {
			$row_id = $this->uri->segment(3);
			$this->cart->update(array(
				'rowid'      => $row_id,
				'qty'     => 0
			));
			redirect('Cashier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function remove()
	{
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'kasir') {
			$row_id = $this->uri->segment(3);
			// $this->cart->update(array(
			// 	'rowid'      => $row_id,
			// 	'qty'     => 0
			// ));
			$this->Cart->hapus_cart($row_id);
			redirect('Cashier');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	public function getCustomer()
	{
		$customer = $this->input->post('customer_name');
		$res = $this->Cashier->check_customer($customer);
		echo json_encode($res);
	}
	public function autoCustomer()
	{
		if (isset($_GET['term'])) {
			$result = $this->Cashier->autoCustomer($_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row)
					$arr_result[] = $row->nama_customer;
				echo json_encode($arr_result);
			}
		}
	}
	public function cetak_dedak()
	{
		$id = $this->session->userdata('kode_slip');
		$this->db->where('kode_slip', $id);
		$this->db->update('tb_jual_dedak', [
			'tanggal_print' => date('Y-m-d H:i:s')
		]);
		$data['jual'] = $this->Cashier->cetak_dedak($id);
		$this->load->view('cetak/cetak_dedak', $data);
	}
	public function cetak_invoice()
	{
		$data['jual'] = $this->Cashier->cetak_faktur();
		$data['jual_detail'] = $this->Cashier->cetak_faktur_detail();
		$this->load->view('cetak/cetak_invoice', $data);
	}
	public function updateQtyCart()
	{
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$price = $this->input->post('price');
		$subtotal = $qty * $price;
		$data = [
			'qty' => $qty,
			'subtotal' => $subtotal
		];
		$this->db->where('id', $id);
		$this->db->update('tb_cart', $data);
		redirect('Cashier');
	}
}
