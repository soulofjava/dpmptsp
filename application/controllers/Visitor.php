<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Visitor extends CI_Controller
 {
   
  function __construct()
   {
    parent::__construct();
    $this->load->library('user_agent');
    $this->load->model('Crud_model');
   }
   
  public function index()
   {
   }
   
  public function json_all_visitor()
   {
    $halaman    = $this->input->post('halaman');
    $limit    = $this->input->post('limit');
    $start      = ($halaman - 1) * $limit;
    $fields     = "*";
    $where      = array(
      'visitor.status !=' => 99
    );
    $order_by   = 'visitor.user_agent';
    echo json_encode($this->Crud_model->json_all_visitor($where, $limit, $start, $fields, $order_by));
   }
   
  public function total_visitor()
		{
      $limit = trim($this->input->get('limit'));
      $this->db->from('visitor');
      $where    = array(
        'status' => 1
				);
      $this->db->where($where);
      $a = $this->db->count_all_results(); 
      return $a;
		}
   
  public function total_hit_counter($current_url)
		{
      $current_url = trim($current_url);
      $this->db->from('hit_counter');
      $where    = array(
        'status' => 1,
        'current_url' => $current_url
				);
      $this->db->where($where);
      $a = $this->db->count_all_results(); 
      return $a;
		}
    
  public function simpan_visitor()
   {
    $agent = $this->agent->browser().' '.$this->agent->version();
    $ip = $this->input->ip_address();
		$sesi_pengunjung = $this->session->userdata('sesi_pengunjung');
    if ( $sesi_pengunjung == '')
     {
      $this->session->set_userdata( array(
        'sesi_pengunjung' => 'ada'
        ));
        $data_input = array(
          'from_ip' => $ip,
          'user_agent' => $agent,
          'created_by' => 999,
          'created_time' => date('Y-m-d H:i:s'),
          'update_by' => 0,
          'update_time' => date('Y-m-d H:i:s'),
          'status' => 1
                  
          );
        $table_name = 'visitor';
        $this->Crud_model->save_data($data_input, $table_name);
     }
    else
     {
      
     }
      $b = $this->total_visitor();
      echo $b;
   }
    
  public function hit_counter()
   {
    $agent = $this->agent->browser().' '.$this->agent->version();
    $ip = $this->input->ip_address();
    $current_url = trim($this->input->post('current_url'));
    $data_input = array(
      'from_ip' => $ip,
      'user_agent' => $agent,
      'current_url' => trim($current_url),
      'created_by' => 999,
      'created_time' => date('Y-m-d H:i:s'),
          'updated_by' => 999,
          'updated_time' => date('Y-m-d H:i:s'),
      'status' => 1
              
      );
    $table_name = 'hit_counter';
    $this->Crud_model->save_data($data_input, $table_name);
      $b = $this->total_hit_counter($current_url);
      echo $b;
   }
    
 }