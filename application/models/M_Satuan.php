<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Satuan extends CI_Model
{
  private $table = "tb_satuan";
  private $primary = "id";
  var $column_order = array(null, 'id', 'satuan', null); //set column field database for datatable orderable
  var $column_search = array('id', 'satuan'); //set column field database for datatable searchable 
  var $order = array('id' => 'ASC'); // default order 

  private function _get_datatables_query()
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $i = 0;
    foreach ($this->column_search as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {
        if ($i === 0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }
  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->select('*');
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }
  public function list()
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $data = $this->db->get()->result();
    return $data;
  }

  public function get($id)
  {
    $this->db->select('*');
    $this->db->where($this->primary, $id);
    $this->db->from($this->table);
    $data = $this->db->get()->row_array();
    return $data;
  }

  public function getBySelect()
  {
    $this->db->select('id , satuan')->from($this->table);
    $query = $this->db->get();
    $return = $query->result();
    return $return;
  }

  public function create($data)
  {
    $this->db->insert($this->table, $data);
  }
  public function delete($id)
  {
    $this->db->where($this->primary, $id);
    $res = $this->db->delete($this->table);
    return $res;
  }
  public function update($id, $data)
  {
    $this->db->where($this->primary, $id);
    $res = $this->db->update($this->table, $data);
    return $res;
  }
}
