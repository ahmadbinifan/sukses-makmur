<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'M_User' => 'user',
        ]);
    }

    public function index()
    {

        $data['title'] = 'User';
        // $data['section'] = $this->section->getList();
        backView('user/index', $data);
    }
    public function list_user()
    {
        $list = $this->user->get_datatables();
        $data_user = array();
        $no = $_POST['start'];

        foreach ($list as $value) {

            if ($value->level == "admin") {
                $level = "<div class='badge badge-primary'>Admin</div>";
            } else {
                $level = "<div class='badge badge-warning'>Kasir</div>";
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->fullname;
            $row[] = $value->username;
            $row[] = $level;
            $row[] = "
            <div class='row'>
                <button type='button' class='btn btn-success btn-sm' onclick='get(" . "\"" . $value->id_user . "\")' data-toggle='modal' data-target='#modalEdit' data-backdrop='static' data-keyboard='false' >
                <i class='fas fa-eye fa-xs'></i>
                </button>
                <button type='button' class='btn btn-danger btn-sm' onclick='remove(" . "\"" . $value->id_user . "\")' >
                    <i class='fas fa-trash fa-xs'></i>
                </button>
            </div>";
            $data_user[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data_user,
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
        );
        echo json_encode($output);
    }

    public function get()
    {
        $id = $this->input->post('id');
        $data = $this->user->get($id);
        echo json_encode($data);
    }

    public function getList()
    {
        $data = $this->user->getList();
        echo json_encode($data);
    }
    public function create()
    {

        $data = $this->input->post();
        $data['id_user'] = time();
        $confirm = $this->user->exist($data);
        if ($confirm == true) {
            $data['password'] = md5($data['password']);
            $this->user->create($data);
        }
        echo json_encode($confirm);
    }
    public function remove()
    {

        $id = $this->input->post('id');
        $res = $this->user->delete($id);
        echo json_encode($res);
    }
    public function update()
    {

        $id = $this->input->post('id_user');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data = $this->input->post();
        $id = $data['id_user'];
        unset($data['id_user']);
        // $data['password'] = md5($data['password']);
        $res = $this->user->update($id, $data);
        echo json_encode($res);
    }
}
