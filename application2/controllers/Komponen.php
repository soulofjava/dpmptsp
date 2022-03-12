<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Komponen extends CI_Controller
 {
   
  function __construct()
   {
    parent::__construct();
    //$this->load->library('fpdf');
    $this->load->library('Bcrypt');
    $this->load->library('Excel');
    $this->load->model('Crud_model');
    $this->load->model('Komponen_model');
   }
   
  public function index()
   {
    $data['total'] = 10;
    $data['main_view'] = 'komponen/home';
    $this->load->view('back_bone', $data);
   }
   
  public function json_all_komponen()
   {
    $halaman    = $this->input->post('halaman');
    $limit    = $this->input->post('limit');
    $start      = ($halaman - 1) * $limit;
    $fields     = "*";
    $where      = array(
      'komponen.status !=' => 99
    );
    $order_by   = 'komponen.isi_komponen';
    echo json_encode($this->Komponen_model->json_all_komponen($where, $limit, $start, $fields, $order_by));
   }
   
  public function json_slide_show()
   {
    $halaman    = $this->input->post('halaman');
    $limit    = $this->input->post('limit');
    $start      = ($halaman - 1) * $limit;
    
    $where      = array(
      'komponen.judul_komponen' => 'slide_show'
    );
    $order_by   = 'komponen.isi_komponen';
    
    $this->db->select("
		komponen.judul_komponen,
		komponen.isi_komponen,
    attachment.file_name
		");
		$this->db->join('attachment', 'attachment.id_tabel=komponen.id_komponen');
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get('komponen');
		
    echo json_encode($result->result_array());
   }
   
  public function simpan_komponen()
   {
		$this->form_validation->set_rules('judul_komponen', 'judul_komponen', 'required');
		$this->form_validation->set_rules('isi_komponen', 'isi_komponen', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      $data_input = array(
			
				'judul_komponen' => trim($this->input->post('judul_komponen')),
        'temp' => trim($this->input->post('temp')),
        'isi_komponen' => trim($this->input->post('isi_komponen')),
        'created_by' => $this->session->userdata('id_users'),
        'created_time' => date('Y-m-d H:i:s'),
        'status' => 1
								
				);
      $table_name = 'komponen';
      $id         = $this->Komponen_model->simpan_komponen($data_input, $table_name);
      echo $id;
			$table_name  = 'attachment';
      $where       = array(
        'table_name' => 'komponen',
        'temp' => trim($this->input->post('temp'))
				);
			$data_update = array(
				'id_tabel' => $id
				);
      $this->Crud_model->update_data($data_update, $where, $table_name);
     }
   }
   
  public function update_komponen()
   {
    $this->form_validation->set_rules('judul_komponen', 'judul_komponen', 'required');
		$this->form_validation->set_rules('isi_komponen', 'isi_komponen', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      $data_update = array(
			
				'judul_komponen' => trim($this->input->post('judul_komponen')),
        'isi_komponen' => trim($this->input->post('isi_komponen')),
				'updated_by' => $this->session->userdata('id_users'),
        'updated_time' => date('Y-m-d H:i:s')
								
				);
      $table_name  = 'komponen';
      $where       = array(
        'komponen.id_komponen' => trim($this->input->post('id_komponen'))
			);
      $this->Komponen_model->update_data_komponen($data_update, $where, $table_name);
      echo 1;
     }
   }
   
   public function get_by_id()
		{
      $where    = array(
        'id_komponen' => $this->input->post('id_komponen')
				);
      $this->db->select("*");
      $this->db->where($where);
      $this->db->order_by('id_komponen');
      $result = $this->db->get('komponen');
      echo json_encode($result->result_array());
		}
   
   public function total_komponen()
		{
      $limit = trim($this->input->get('limit'));
      $this->db->from('komponen');
      $where    = array(
        'status' => 1
				);
      $this->db->where($where);
      $a = $this->db->count_all_results(); 
      echo trim(ceil($a / $limit));
		}
   
  public function hapus()
		{
			$id_komponen = $this->input->post('id_komponen');
      $where = array(
        'id_komponen' => $id_komponen,
				'created_by' => $this->session->userdata('id_users')
        );
      $this->db->from('komponen');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      if($a == 0){
        echo 0;
        }
      else{
        $data_update = array(
        
          'status' => 99
                  
          );
        $table_name  = 'komponen';
        $this->Komponen_model->update_data_komponen($data_update, $where, $table_name);
        echo 1;
        }
		}
    
 }