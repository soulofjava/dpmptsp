<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Modul extends CI_Controller
 {
   
  function __construct()
   {
    parent::__construct();
    //$this->load->library('fpdf');
    $this->load->library('Bcrypt');
    $this->load->library('Excel');
    $this->load->model('Crud_model');
    $this->load->model('Modul_model');
   }
   
  public function index()
   {
    $data['total'] = 10;
    $data['main_view'] = 'modul/home';
    $this->load->view('back_bone', $data);
   }
   
  public function json_all_modul()
   {
    $halaman    = $this->input->post('halaman');
    $limit    = $this->input->post('limit');
    $start      = ($halaman - 1) * $limit;
    $fields     = "*";
    $where      = array(
      'modul.status !=' => 99
    );
    $order_by   = 'modul.alamat_url';
    echo json_encode($this->Modul_model->json_all_modul($where, $limit, $start, $fields, $order_by));
   }
   
  public function json_slide_show()
   {
    $halaman    = $this->input->post('halaman');
    $limit    = $this->input->post('limit');
    $start      = ($halaman - 1) * $limit;
    
    $where      = array(
      'modul.nama_modul' => 'slide_show'
    );
    $order_by   = 'modul.alamat_url';
    
    $this->db->select("
		modul.nama_modul,
		modul.alamat_url,
    attachment.file_name
		");
		$this->db->join('attachment', 'attachment.id_tabel=modul.id_modul');
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get('modul');
		
    echo json_encode($result->result_array());
   }
   
  public function simpan_modul()
   {
		$this->form_validation->set_rules('nama_modul', 'nama_modul', 'required');
		$this->form_validation->set_rules('alamat_url', 'alamat_url', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      $data_input = array(
			
				'nama_modul' => trim($this->input->post('nama_modul')),
        'temp' => trim($this->input->post('temp')),
        'alamat_url' => trim($this->input->post('alamat_url')),
        'created_by' => $this->session->userdata('id_users'),
        'created_time' => date('Y-m-d H:i:s'),
        'status' => 1
								
				);
      $table_name = 'modul';
      $id         = $this->Modul_model->simpan_modul($data_input, $table_name);
      echo $id;
			$table_name  = 'attachment';
      $where       = array(
        'table_name' => 'modul',
        'temp' => trim($this->input->post('temp'))
				);
			$data_update = array(
				'id_tabel' => $id
				);
      $this->Crud_model->update_data($data_update, $where, $table_name);
     }
   }
   
  public function update_modul()
   {
    $this->form_validation->set_rules('nama_modul', 'nama_modul', 'required');
		$this->form_validation->set_rules('alamat_url', 'alamat_url', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      $data_update = array(
			
				'nama_modul' => trim($this->input->post('nama_modul')),
        'alamat_url' => trim($this->input->post('alamat_url')),
				'updated_by' => $this->session->userdata('id_users'),
        'updated_time' => date('Y-m-d H:i:s')
								
				);
      $table_name  = 'modul';
      $where       = array(
        'modul.id_modul' => trim($this->input->post('id_modul'))
			);
      $this->Modul_model->update_data_modul($data_update, $where, $table_name);
      echo 1;
     }
   }
   
   public function get_by_id()
		{
      $where    = array(
        'id_modul' => $this->input->post('id_modul')
				);
      $this->db->select("*");
      $this->db->where($where);
      $this->db->order_by('id_modul');
      $result = $this->db->get('modul');
      echo json_encode($result->result_array());
		}
   
   public function total_modul()
		{
      $limit = trim($this->input->get('limit'));
      $this->db->from('modul');
      $where    = array(
        'status' => 1
				);
      $this->db->where($where);
      $a = $this->db->count_all_results(); 
      echo trim(ceil($a / $limit));
		}
   
  public function hapus()
		{
			$id_modul = $this->input->post('id_modul');
      $where = array(
        'id_modul' => $id_modul,
				'created_by' => $this->session->userdata('id_users')
        );
      $this->db->from('modul');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      if($a == 0){
        echo 0;
        }
      else{
        $data_update = array(
        
          'status' => 99
                  
          );
        $table_name  = 'modul';
        $this->Modul_model->update_data_modul($data_update, $where, $table_name);
        echo 1;
        }
		}
    
 }