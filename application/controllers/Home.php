<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'M_Finger' => 'finger',
            'M_Data_Karyawan' => 'employee',
            'M_Absensi' => 'absensi',
            'M_Data_Barang' => 'product',
            'M_Cashier' => 'cashier',
        ]);
    }

    public function index()
    {
        $person = $this->session->userdata('username');
        if (!$person) {
            redirect('Auth');
        }
        $data['title'] = 'Dashboard';
        $data['count_employee'] = $this->employee->count_employee();
        $data['count_absensi'] = $this->absensi->count_employee();
        $data['count_product'] = $this->product->count_product();
        $data['count_cashier'] = $this->cashier->count_cashier();
        backView('home/index', $data);
    }
    public function get_absen()
    {
        $res = $this->finger->get_data_absen();

        if ($res) {
            //     echo '<script>alert("Machine Not Connected")</script>';
            //     header("refresh: 0; url=" . base_url('absensi'));
            // } else {
            echo "'.$res.'";
            redirect('absensi');
        }
        // }
        // var_dump($this->finger->check_karyawan(1));
    }

    public function add()
    {
        $res = $this->finger->add_employee();
        // var_dump($res);
        // die;
    }
    public function get_finger()
    {
        $this->finger->get_finger();
    }
    public function get_user()
    {
        $this->finger->get_user();
    }
}
