<?php

class Data_Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Data_Barang' => 'Data_Barang', 'M_Kategori' => 'Kategori', 'M_Satuan' => 'Satuan']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Barang',
            'kategori' =>  $this->Kategori->getBySelect(),
            'satuan' =>  $this->Satuan->getBySelect(),
        ];

        backView('data_barang/index', $data);
    }
    public function list_data_barang()
    {
        $list = $this->Data_Barang->get_datatables();
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($list as $value) {

            $row = array();
            $row[] = $no++;
            $row[] = $value->id_barang;
            $row[] = $value->nama_barang;
            $row[] = $value->satuan_barang;
            $row[] = $value->harga_pokok_barang;
            $row[] = $value->harga_jual_grosir_barang;
            $row[] = $value->stok_barang;
            $row[] = $value->minimal_stok_barang;
            $row[] = $value->kategori_nama;
            $edit = "\"" . $value->id_barang . "\",\"edit\"";
            $delete = "\"" . $value->id_barang . "\",\"delete\"";
            $btn_edit =
                "<button type='button' class='btn btn-warning btn-sm mr-1' data-toggle='modal'title='edit' data-target='#modalEdit' data-backdrop='static' onclick='get(" . $edit . ")'>
                <i class='fas fa-edit fa-xs'></i>
            </button>";
            $btn_delete =
                "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal'title='Delete' data-target='#modalDelete' data-backdrop='static' onclick='remove(" . $delete . ")'>
                <i class='fas fa-trash fa-xs'></i>
            </button>";

            if ($this->session->userdata('level') == "admin") {
                $action = $btn_edit . $btn_delete;
            } else {
                $action = $btn_edit;
            }
            $row[] = "<div class='row'>" . $action . "</div>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Data_Barang->count_all(),
            "recordsFiltered" => $this->Data_Barang->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function get()
    {
        $id = $this->input->post('id_barang');
        $data['header'] = $this->Data_Barang->getHead($id);
        // $data['key'] = conv($id, "e");
        echo json_encode($data);
    }
    public function remove()
    {
        $id = $this->input->post('id_barang');
        $data = $this->Data_Barang->remove($id);
        echo json_encode($data);
    }
    public function getNew()
    {
        $id = $this->input->post('id');
        $data = $this->Data_Barang->getNew($id);
        echo json_encode($data);
    }
    public function create()
    {
        $data = $this->input->post();
        // $data['po_qty'] = str_replace(",", "", $this->input->post('po_qty'));
        $res = $this->Data_Barang->create($data);
        echo json_encode($res);
    }
    public function update()
    {
        $id = $this->input->post('id_barang');
        $data = $this->input->post();
        // $data['po_qty'] = str_replace(",", "", $this->input->post('po_qty'));
        $res = $this->Data_Barang->update($id, $data);
        echo json_encode($res);
    }
}
