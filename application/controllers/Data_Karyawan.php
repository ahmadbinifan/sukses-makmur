<?php

class Data_Karyawan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'M_Data_Karyawan' => 'data_karyawan',
            'M_Finger' => 'finger',
            'M_Absensi' => 'absensi'
        ]);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
        ];

        backView('karyawan/index', $data);
    }
    public function list_ajax()
    {
        $list = $this->data_karyawan->get_datatables();
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($list as $value) {

            $row = array();
            $row[] = $no++;
            $row[] = '<img src="' . base_url("/assets/avatar/") . $value->avatar . '" style="width:50px;">';
            $row[] = $value->nik;
            $row[] = $value->nama;
            $row[] = $value->id_karyawan;
            $row[] = $value->jenis_kelamin;
            $row[] = $value->alamat;
            $row[] = date('d-m-Y', strtotime($value->tanggal_lahir));
            $row[] = $value->agama;
            $edit = "\"" . $value->id_karyawan . "\",\"edit\"";
            $detail = "\"" . $value->id_karyawan . "\",\"detail\"";
            $delete = "\"" . $value->id_karyawan . "\",\"delete\"";
            $btn_detail =
                "<button type='button' class='btn btn-warning btn-sm mr-1' data-toggle='modal'title='detail' data-target='#modalDetail' data-backdrop='static' onclick='get(" . $detail . ")'>
                <i class='fas fa-eye fa-xs'></i>
            </button>";
            $btn_edit =
                "<button type='button' class='btn btn-warning btn-sm mr-1' data-toggle='modal'title='edit' data-target='#modalEdit' data-backdrop='static' onclick='get(" . $edit . ")'>
                <i class='fas fa-edit fa-xs'></i>
            </button>";
            $btn_delete =
                "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal'title='Delete' data-target='#modalDelete' data-backdrop='static' onclick='remove(" . $delete . ")'>
                <i class='fas fa-trash fa-xs'></i>
            </button>";

            if ($this->session->userdata('level') == "admin") {
                $action = $btn_detail . $btn_edit . $btn_delete;
            } else {
                $action = $btn_detail;
            }
            $row[] = "<div class='row'>" . $action . "</div>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->data_karyawan->count_all(),
            "recordsFiltered" => $this->data_karyawan->count_filtered(),
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
        $this->finger->add_employee($data['id_karyawan'], $data['nama']);
        echo json_encode($confirm);
    }
    public function update()
    {
        $id = $this->input->post('id_karyawan');
        $data = $this->input->post();
        $res = $this->data_karyawan->update($id, $data);
        echo json_encode($res);
    }
    public function tes()
    {
        $res = $this->absensi->get_presensi('2023-02', 2091970);
        var_dump($res);
    }
    public function get_presensi()
    {
        $month = $this->input->post('month');
        $id = $this->input->post('id');
        $absen =  $this->absensi->get_presensi($month, $id);
?>
        <div class="mt-3">
            <div class="row pt-1 scroll">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            if (count($absen) > 0) {
                                $i = 0;
                                foreach ($absen as $value) {
                                    if ($value->status != 0) {
                                        $status = '<div class="badge badge-success">Hadir</div>';
                                    }
                                    $i++;
                            ?>
                                    <td><?= $i ?></td>
                                    <td><?= $value->date_time ?></td>
                                    <td><?= $value->date_time_out ?></td>
                                    <td><?= $status ?></td>
                                <?php } ?>
                            <?php } else { ?>
                                <td colspan="5" class="text-center">Not Found..</td>
                            <?php  } ?>


                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<?php
    }
}
