<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
		{
		parent::__construct();
		}
		
	public function index()
	{
		$data['judul'] = 'Selamat datang';
		$data['main_view'] = 'welcome_message';
		$this->load->view('back_bone', $data);
	}
  
}
