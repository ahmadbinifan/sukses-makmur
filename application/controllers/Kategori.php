<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Kategori');
    }

    public function index()
    {
        $data['title'] = 'Master Data - Kategori';
        backView("kategori/index", $data);
    }
    public function list_Kategori()
    {
        $list = $this->M_Kategori->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->kategori_nama;
            $row[] = "
            <div class='row ml-1'>
                <button type='button' class='btn btn-success btn-sm mr-1' onclick='get(" . "\"" . $value->kategori_id . "\")'>
                <i class='fas fa-eye fa-xs'></i>
                </button>
                <button type='button' class='btn btn-danger btn-sm' onclick='remove(" . "\"" . $value->kategori_id . "\")' >
                    <i class='fas fa-trash fa-xs'></i>
                </button>
            </div>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data,
            "recordsTotal" => $this->M_Kategori->count_all(),
            "recordsFiltered" => $this->M_Kategori->count_filtered(),
        );
        echo json_encode($output);
    }

    public function get()
    {
        $id = $this->input->post('id');
        $data = $this->M_Kategori->get($id);
        echo json_encode($data);
    }
    public function getNew()
    {
        $id = $this->input->post('id');
        $data = $this->M_Kategori->getNew($id);
        echo json_encode($data);
    }

    public function create()
    {
        $data = [
            'kategori_id' => $this->input->post('kategori_id'),
            'kategori_nama' => $this->input->post('kategori_nama'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $res = $this->M_Kategori->create($data);
        echo json_encode($res);
    }
    public function remove()
    {
        $id = $this->input->post('id');
        $res = $this->M_Kategori->delete($id);
        echo json_encode($res);
    }
    public function update()
    {
        $id = $this->input->post('id');
        $data = [
            'kategori_nama' => $this->input->post('kategori_nama'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $res = $this->M_Kategori->update($id, $data);
        echo json_encode($res);
    }
}
