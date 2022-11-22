<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Satuan');
  }

  public function index()
  {
    $data['title'] = 'Master Data - Satuan';
    backView("satuan/index", $data);
  }
  public function list_satuan()
  {
    $list = $this->M_Satuan->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $value) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $value->satuan;
      $row[] = "
            <div class='row ml-1'>
                <button type='button' class='btn btn-success btn-sm mr-1' onclick='get(" . "\"" . $value->id . "\")'>
                <i class='fas fa-eye fa-xs'></i>
                </button>
                <button type='button' class='btn btn-danger btn-sm' onclick='remove(" . "\"" . $value->id . "\")' >
                    <i class='fas fa-trash fa-xs'></i>
                </button>
            </div>";
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "data" => $data,
      "recordsTotal" => $this->M_Satuan->count_all(),
      "recordsFiltered" => $this->M_Satuan->count_filtered(),
    );
    echo json_encode($output);
  }

  public function get()
  {
    $id = $this->input->post('id');
    $data = $this->M_Satuan->get($id);
    echo json_encode($data);
  }
  public function getNew()
  {
    $id = $this->input->post('id');
    $data = $this->M_Satuan->getNew($id);
    echo json_encode($data);
  }

  public function create()
  {
    $data = [
      'id' => $this->input->post('id'),
      'satuan' => $this->input->post('satuan'),
      'created_at' => date('Y-m-d H:i:s')
    ];
    $res = $this->M_Satuan->create($data);
    echo json_encode($res);
  }
  public function remove()
  {
    $id = $this->input->post('id');
    $res = $this->M_Satuan->delete($id);
    echo json_encode($res);
  }
  public function update()
  {
    $id = $this->input->post('id');
    $data = [
      'satuan' => $this->input->post('satuan'),
      'updated_at' => date('Y-m-d H:i:s')
    ];
    $res = $this->M_Satuan->update($id, $data);
    echo json_encode($res);
  }
}
