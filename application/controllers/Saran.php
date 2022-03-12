<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Saran extends CI_Controller
 {
   
  function __construct()
   {
    parent::__construct();
    // $this->load->library('fpdf');
    $this->load->library('Bcrypt');
    $this->load->library('Excel');
    $this->load->model('Crud_model');
    $this->load->model('Saran_model');
   }
   
  public function index()
   {
    $data['total'] = 10;
    $data['main_view'] = 'saran/home';
    $this->load->view('back_bone', $data);
   }
   
  public function json_all_saran()
   {
    $halaman    = $this->input->post('halaman');
    $limit    = $this->input->post('limit');
    $start      = ($halaman - 1) * $limit;
    $fields     = "*";
    $where      = array(
      'saran.status !=' => 99
    );
    $order_by   = 'saran.telp';
    echo json_encode($this->Saran_model->json_all_saran($where, $limit, $start, $fields, $order_by));
   }
   
  public function simpan_saran()
   {
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('nama_pengirim', 'nama_pengirim', 'required');
		$this->form_validation->set_rules('telp', 'telp', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('isi_saran', 'isi_saran', 'required');
		$this->form_validation->set_rules('nama_pengirim', 'nama_pengirim', 'required');
    $a = $this->session->userdata('id_users');
    if( $a == '' ){
      $id_users = 999;
    }
    else{
      $id_users = $this->session->userdata('id_users');
    }
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      $data_input = array(
			
				'nik' => trim($this->input->post('nik')),
				'nama_pengirim' => trim($this->input->post('nama_pengirim')),
				'isi_saran' => trim($this->input->post('isi_saran')),
				'email' => trim($this->input->post('email')),
        'temp' => trim($this->input->post('temp')),
        'telp' => trim($this->input->post('telp')),
        'created_by' => $id_users,
        'created_time' => date('Y-m-d H:i:s'),
        'status' => 1
								
				);
      $table_name = 'saran';
      $id         = $this->Saran_model->simpan_saran($data_input, $table_name);
      echo $id;
			$table_name  = 'attachment';
      $where       = array(
        'table_name' => 'saran',
        'temp' => trim($this->input->post('temp'))
				);
			$data_update = array(
				'id_tabel' => $id
				);
      $this->Crud_model->update_data($data_update, $where, $table_name);
     }
   }
   
  public function update_saran()
   {
    $this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('telp', 'telp', 'required');
		$this->form_validation->set_rules('isi_saran', 'isi_saran', 'required');
		$this->form_validation->set_rules('nama_pengirim', 'nama_pengirim', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      $data_update = array(
			
				'nik' => trim($this->input->post('nik')),
        'telp' => trim($this->input->post('telp')),
        'isi_saran' => trim($this->input->post('isi_saran')),
        'nama_pengirim' => trim($this->input->post('nama_pengirim')),
				'updated_by' => $this->session->userdata('id_users'),
        'updated_time' => date('Y-m-d H:i:s')
								
				);
      $table_name  = 'saran';
      $where       = array(
        'saran.id_saran' => trim($this->input->post('id_saran'))
			);
      $this->Saran_model->update_data_saran($data_update, $where, $table_name);
      echo 1;
     }
   }
   
   public function get_by_id()
		{
      $where    = array(
        'id_saran' => $this->input->post('id_saran')
				);
      $this->db->select("*");
      $this->db->where($where);
      $this->db->order_by('id_saran');
      $result = $this->db->get('saran');
      echo json_encode($result->result_array());
		}
   
   public function total_saran()
		{
      $limit = trim($this->input->get('limit'));
      $this->db->from('saran');
      $where    = array(
        'status' => 1
				);
      $this->db->where($where);
      $a = $this->db->count_all_results(); 
      echo trim(ceil($a / $limit));
		}
   
  public function hapus()
		{
			$id_saran = $this->input->post('id_saran');
      $where = array(
        'id_saran' => $id_saran,
				'created_by' => $this->session->userdata('id_users')
        );
      $this->db->from('saran');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      if($a == 0){
        echo 0;
        }
      else{
        $data_update = array(
        
          'status' => 99
                  
          );
        $table_name  = 'saran';
        $this->Saran_model->update_data_saran($data_update, $where, $table_name);
        echo 1;
        }
		}
   
  public function inaktifkan()
		{
      $cek = $this->session->userdata('id_users');
			$id_saran = $this->input->post('id_saran');
      $where = array(
        'id_saran' => $id_saran
        );
      $this->db->from('saran');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      if($a == 0){
        echo 0;
        }
      else{
        $data_update = array(
        
          'status' => 1
                  
          );
        $table_name  = 'saran';
        if( $cek <> '' ){
          $this->Saran_model->update_data_saran($data_update, $where, $table_name);
          echo 1;
          }
        else{
          echo 0;
          }
        }
		}
   
  public function aktifkan()
		{
      $cek = $this->session->userdata('id_users');
			$id_saran = $this->input->post('id_saran');
      $where = array(
        'id_saran' => $id_saran
        );
      $this->db->from('saran');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      if($a == 0){
        echo 0;
        }
      else{
        $data_update = array(
        
          'status' => 2
                  
          );
        $table_name  = 'saran';
        if( $cek <> '' ){
          $this->Saran_model->update_data_saran($data_update, $where, $table_name);
          echo 1;
          }
        else{
          echo 0;
          }
        }
		}
    
 }