<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller
 {
   
  function __construct()
   {
    parent::__construct();
    // $this->load->library('fpdf');
    $this->load->library('Bcrypt');
    $this->load->library('Excel');
    $this->load->model('Crud_model');
    $this->load->model('Users_model');
   }
   
  public function index()
   {
    $data['total'] = 10;
    $data['main_view'] = 'users/home';
    $this->load->view('back_bone', $data);
   }
   
  public function json_all_users()
   {
    $halaman    = $this->input->post('halaman');
    $limit    = $this->input->post('limit');
    $start      = ($halaman - 1) * $limit;
    $fields     = "*";
    $where      = array(
      'users.status !=' => 99
    );
    $order_by   = 'users.nama';
    echo json_encode($this->Users_model->json_all_users($where, $limit, $start, $fields, $order_by));
   }
   
  public function simpan_users()
   {
		$this->form_validation->set_rules('user_name', 'user_name', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('hak', 'hak', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
			$new_password = $this->bcrypt->hash_password($this->input->post('password'));
      $data_input = array(
			
				'user_name' => trim($this->input->post('user_name')),
        'password' => trim($new_password),
        'hak' => trim($this->input->post('hak')),
        'temp' => trim($this->input->post('temp')),
        'nama' => trim($this->input->post('nama')),
        'created_by' => $this->session->userdata('id_users'),
        'created_time' => date('Y-m-d H:i:s'),
        'status' => 1
								
				);
      $table_name = 'users';
      $id         = $this->Users_model->simpan_users($data_input, $table_name);
      echo $id;
			$table_name  = 'attachment';
      $where       = array(
        'table_name' => 'users',
        'temp' => trim($this->input->post('temp'))
				);
			$data_update = array(
				'id_tabel' => $id
				);
      $this->Crud_model->update_data($data_update, $where, $table_name);
     }
   }
   
  public function update_users()
   {
    $this->form_validation->set_rules('user_name', 'user_name', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('hak', 'hak', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
			$new_password = $this->bcrypt->hash_password($this->input->post('password'));
      $data_update = array(
			
				'user_name' => trim($this->input->post('user_name')),
        'password' => trim($new_password),
        'hak' => trim($this->input->post('hak')),
        'nama' => trim($this->input->post('nama')),
				'updated_by' => $this->session->userdata('id_users'),
        'updated_time' => date('Y-m-d H:i:s')
								
				);
      $table_name  = 'users';
      $where       = array(
        'users.id_users' => trim($this->input->post('id_users'))
			);
      $this->Users_model->update_data_users($data_update, $where, $table_name);
      echo 1;
     }
   }
   
   public function get_by_id()
		{
      $where    = array(
        'id_users' => $this->input->post('id_users')
				);
      $this->db->select("*");
      $this->db->where($where);
      $this->db->order_by('id_users');
      $result = $this->db->get('users');
      echo json_encode($result->result_array());
		}
   
   public function total_users()
		{
      $limit = trim($this->input->get('limit'));
      $this->db->from('users');
      $where    = array(
        'status' => 1
				);
      $this->db->where($where);
      $a = $this->db->count_all_results(); 
      echo trim(ceil($a / $limit));
		}
   
  public function hapus()
		{
			$id_users = $this->input->post('id_users');
      $where = array(
        'id_users' => $id_users,
				'created_by' => $this->session->userdata('id_users')
        );
      $this->db->from('users');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      if($a == 0){
        echo 0;
        }
      else{
        $data_update = array(
        
          'status' => 99
                  
          );
        $table_name  = 'users';
        $this->Users_model->update_data_users($data_update, $where, $table_name);
        echo 1;
        }
		}
    
 }