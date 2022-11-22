<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'M_Data_Barang' => 'Data_Barang',
            'M_Cashier' => 'Cashier',
        ]);
    }

    public function index()
    {
        $data['title'] = 'Cashier';
        $data['listBarang'] = $this->Data_Barang->listBarang();
        backView('cashier/index', $data);
    }
    public function getBarang()
    {
        $id = $this->input->post('nama_barang');
        $data = $this->Data_Barang->row_barang($id);
        echo json_encode($data);
    }
    function add_to_cart()
    {
        if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'admin') {
            $kobar = $this->input->post('nama_barang');
            $produk = $this->Data_Barang->get_barang($kobar);
            $i = $produk->row_array();
            $data = array(
                'id'       => $i['id_barang'],
                'name'     => $i['nama_barang'],
                'satuan'   => $i['satuan_barang'],
                'harpok'   => $i['harga_jual_grosir_barang'],
                'qty'      => $this->input->post('jumlah'),
                'price'      => str_replace(",", "", $this->input->post('harga'))
            );

            if (!empty($this->cart->total_items())) {
                foreach ($this->cart->contents() as $items) {
                    $id = $items['id'];
                    $qtylama = $items['qty'];
                    $rowid = $items['rowid'];
                    $kobar = $this->input->post('nama_barang');
                    $qty = $this->input->post('jumlah');
                    if ($id == $kobar) {
                        $up = array(
                            'rowid' => $rowid,
                            'qty' => $qtylama + $qty
                        );
                        $this->cart->update($up);
                    } else {
                        $this->cart->insert($data);
                    }
                }
            } else {
                $this->cart->insert($data);
            }
            redirect('Cashier');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
    function simpan_penjualan()
    {
        if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'kasir') {
            $total = $this->input->post('total');
            $customer = $this->input->post('customer_name');
            $jml_uang = str_replace(",", "", $this->input->post('jual_jumlah_uang'));
            $kembalian = $jml_uang - $total;
            if (!empty($total) && !empty($jml_uang)) {
                if ($jml_uang < $total) {
                    echo $this->session->set_flashdata('msg', '<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
                    redirect('Cashier');
                } else {
                    $nofak = $this->Cashier->get_nofak();
                    $this->session->set_userdata('nofak', $nofak);
                    $order_proses = $this->Cashier->simpan_penjualan($nofak, $total, $jml_uang, $kembalian, $customer);
                    if ($order_proses) {
                        $this->cart->destroy();

                        $this->session->unset_userdata('tglfak');
                        $this->session->unset_userdata('suplier');
                        redirect('alert/sukses');
                    } else {
                        redirect('Cashier');
                    }
                }
            } else {
                echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
                redirect('Cashier');
            }
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
    function remove()
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

    public function cetak_faktur()
    {
        $data['jual'] = $this->Cashier->cetak_faktur();
        $data['jual_detail'] = $this->Cashier->cetak_faktur_detail();
        $this->load->view('cetak/cetak_faktur', $data);
    }
    public function cetak_invoice()
    {
        $data['jual'] = $this->Cashier->cetak_faktur();
        $data['jual_detail'] = $this->Cashier->cetak_faktur_detail();
        $this->load->view('cetak/cetak_invoice', $data);
    }
}
