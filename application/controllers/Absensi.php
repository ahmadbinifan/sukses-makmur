<?php

class Absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Data_Karyawan' => 'data_karyawan', 'M_Absensi' => 'absensi']);
    }

    public function index()
    {
        $data = [
            'title' => 'Absensi',
        ];

        backView('absensi/index', $data);
    }
    public function list_ajax()
    {
        $list = $this->absensi->get_datatables();
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($list as $value) {
            if ($value->date_time) {
                $status = "<span class='badge badge-success'>Hadir</span>";
            } else {
                $status = "<span class='badge badge-danger'>Pulang</span>";
            }
            $row = array();
            $row[] = $no++;
            // $row[] = '<img src="' . base_url('assets/avatar/') . $value->avatar . '" style="width:50px">';
            $row[] = $value->pin;
            $row[] = $value->nama;
            $row[] = date('d-m-Y', strtotime($value->date_time));
            $row[] = date('H:i:s', strtotime($value->date_time));
            $row[] = date('d-m-Y', strtotime($value->date_time_out));
            $row[] = date('H:i:s', strtotime($value->date_time_out));
            // $row[] = $value->ver;
            $row[] = $status;
            // $edit = "\"" . $value->pin . "\",\"edit\"";
            // $detail = "\"" . $value->pin . "\",\"detail\"";
            // $delete = "\"" . $value->pin . "\",\"delete\"";
            // $btn_detail =
            //     "<button type='button' class='btn btn-warning btn-sm mr-1' data-toggle='modal'title='detail' data-target='#modalDetail' data-backdrop='static' onclick='get(" . $detail . ")'>
            //     <i class='fas fa-eye fa-xs'></i>
            // </button>";
            // $btn_delete =
            //     "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal'title='Delete' data-target='#modalDelete' data-backdrop='static' onclick='remove(" . $delete . ")'>
            //     <i class='fas fa-trash fa-xs'></i>
            // </button>";

            // if ($this->session->userdata('level') == "admin") {
            //     $action = $btn_delete;
            // } else {
            //     $action = $btn_delete;
            // }
            // $row[] = "<div class='row'>" . $action . "</div>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->absensi->count_all(),
            "recordsFiltered" => $this->absensi->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function get()
    {
        $id = $this->input->post('id_karyawan');
        $data['header'] = $this->data_karyawan->getHead($id);
        // $data['key'] = conv($id, "e");
        echo json_encode($data);
    }
    public function remove()
    {
        $id = $this->input->post('id_karyawan');
        $data = $this->data_karyawan->remove($id);
        echo json_encode($data);
    }
    public function getNew()
    {
        $id = $this->input->post('id');
        $data = $this->data_karyawan->getNew($id);
        echo json_encode($data);
    }
    public function create()
    {
        $data = $this->input->post();
        $file_name = str_replace('.', '', $data['id_karyawan']);
        $config['upload_path']          = FCPATH . '/assets/avatar/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = $file_name;
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('avatar')) {
            // $data['error'] = $this->upload->display_errors();
            // $confirm = "Upload Error, Please try again with new Picture..";
            // $data['avatar']
        } else {
            $uploaded_data = $this->upload->data();
            $data['avatar'] = $uploaded_data['file_name'];
        }
        $confirm = $this->data_karyawan->exist($data);
        if ($confirm == true) {
            $this->data_karyawan->create($data);
        } else {
            $confirm = "false";
        }
        echo json_encode($confirm);
    }
}
