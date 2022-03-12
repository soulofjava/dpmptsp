<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
		{
		parent::__construct();
    $this->load->library('Bcrypt');
    $this->load->model('Login_model');
		$this->load->model('Crud_model');
		}
		
	public function index()
	{
		$cek_active_login = $this->session->userdata('id_users');
		if(!empty($cek_active_login))
			{ 
				return redirect(''.base_url().'posting'); 
			}
		$data['judul'] = 'Login';
		$data['main_view'] = 'welcome_message';
		$this->load->view('login', $data);
	}
	
	public function proses_login()
	{
		$this->form_validation->set_rules('user_name', 'user_name', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');
    $user_name = $this->input->post('user_name');
    $password = $this->input->post('password');
    $where = array(
						'user_name' => $user_name,
            'status' => 1
						);
    $data_user = $this->Login_model->get_login($where);
    $p = $this->bcrypt->hash_password($password);    
		if ($this->form_validation->run() == FALSE)
      {
        echo '[
					{
						"errors":"form_kosong",
						"user_name":"'.$this->input->post('user_name').'",
						"password":"'.$this->input->post('password').'"
					}
					]';
      }
		else
      {
        if(!$data_user)
          {
						echo '[
						{
							"errors":"user_tidak_ada",
							"user_name":"'.$this->input->post('user_name').'",
							"password":"'.$this->input->post('password').'"
						}
						]';
          }
        else
          {
						if ($this->bcrypt->check_password($password, $data_user['password']))
							{
								$this->session->set_userdata( array(
								'id_users' => $data_user['id_users'],
								'hak' => $data_user['hak']
								));
								$data_update = array(
									'last_login' => date('Y-m-d H:i:s')
								);
								$where = array(
								'id_users' => $data_user['id_users']
								);      
								$this->Login_model->update_last_login($data_update, $where);
                $_SESSION['ids'] = $data_user['id_users'];
								echo '[{"errors":"valid"}]';
							}
						else
							{
								echo '[{"errors":"miss_match"}]';
							}  
          }
      }
	}	
    
  public function logout(){
		$this->session->sess_destroy();
		return redirect(''.base_url().'login'); 
	}
	
	function ip()
	{
	echo $this->server('REMOTE_ADDR'); exit;
	}
	
}
