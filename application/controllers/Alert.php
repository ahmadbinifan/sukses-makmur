<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alert extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Kategori');
	}

	public function sukses()
	{
		$data['title'] = 'Alert';
		backView("alert/index", $data);
	}
	public function sukses_dedak()
	{
		$data['title'] = 'Alert';
		backView("alert/dedak", $data);
	}
}
