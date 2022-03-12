<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tes extends CI_Controller
 {
    
  function __construct()
   {
    parent::__construct();
    // $this->load->library('fpdf');
    $this->load->library('Bcrypt');
    $this->load->library('Excel');
    $this->load->model('Crud_model');
    $this->load->model('Posting_model');
   }
   
  public function index()
   {
    $data['total'] = 10;
    $data['main_view'] = 'tes';
    $this->load->view('tes', $data);
   }
  
    
 }