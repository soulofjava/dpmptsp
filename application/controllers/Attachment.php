<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attachment extends CI_Controller {

	function __construct()
		{
		parent::__construct();
    $this->load->library('upload', 'image_lib');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
    $this->load->library('Bcrypt');
    $this->load->model('Crud_model');
		$this->load->helper('file');
		}
  
	public function index()
		{
    }
		
  public function upload()
		{
      $boleh = $this->session->userdata('id_users');
      if( empty($boleh) ){
      exit;
      }
      $config['upload_path'] = './media/upload/';
			$config['allowed_types'] = '*';
			$config['max_size']	= '50000';
			$this->upload->initialize($config);
			$uploadFiles = array('img_1' => 'myfile', 'img_2' => 'e_myfile', );		
			$this->load->library('image_lib');
			$newName = '-';
			$mode = $this->input->post('mode');
			$this->form_validation->set_rules('remake', 'remake', 'required');
			if ($this->form_validation->run() == FALSE)
				{
					echo
					'
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
						Mohon Keterangan Lampiran Diisi
					</div>
					';
				}
			else
				{
					foreach($uploadFiles as $key => $files)
					{
					if ($this->upload->do_upload($files)) 
						{
							$upload = $this->upload->data();
							$file = explode(".", $upload['file_name']);
							$prefix = date('Ymdhis');
							$newName =$prefix.'_'.$file[0].'.'. $file[1]; 
							$filePath =  $upload['file_path'].$newName;
							rename($upload['full_path'],$filePath);
              if( $mode == 'edit' ){
							$data_input = array(
								'table_name' => $this->input->get('table_name'),
								'file_name' => $newName,
								'keterangan' => $this->input->post('remake'),
								'id_tabel' => $this->input->post('id'),
								'temp' => $this->input->post('temp'),
								'uploaded_time' => date('Y-m-d H:i:s'),
								'uploaded_by' => $this->session->userdata('id_users')
								);
              }
              else{
							$data_input = array(
								'table_name' => $this->input->get('table_name'),
								'file_name' => $newName,
								'keterangan' => $this->input->post('remake'),
								'id_tabel' => 0,
								'temp' => $this->input->post('temp'),
								'uploaded_time' => date('Y-m-d H:i:s'),
								'uploaded_by' => $this->session->userdata('id_users')
								);
              }
							$table_name = 'attachment';
							$id         = $this->Crud_model->save_data($data_input, $table_name);
							$config['image_library'] = 'gd2';
							$config['source_image']  = './media/upload/'.$newName.'';
							$config['new_image']  = './media/upload/s_'.$newName.'';						
							$config['width']	 = 300;
							$config['height']	= 300;
							$this->image_lib->initialize($config); 
							$this->image_lib->resize();
							$file = './media/upload/s_'.$newName.'';
							$j = get_mime_by_extension($file);
							$ex = explode('/', $j);
							$e = $ex[0];
							echo
							'
							<div class="alert alert-success alert-dismissable" id="img_upload">
							<i class="fa fa-check"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							'; 
							if( $e == 'image'){
								echo '<a target="_blank" href="'.base_url().'media/upload/'.$newName.'"><img src="'.base_url().'media/upload/s_'.$newName.'" /></a>';
								}
							else{
								echo '<a target="_blank" href="'.base_url().'media/upload/'.$newName.'"> '.$newName.' </a>';
								}
							echo '</div>';
						}
					}
				}
		}
    
	public function load_lampiran()
		{
      $boleh = $this->session->userdata('id_users');
      if( empty($boleh) ){
      exit;
      }
      $mode = $this->input->post('mode');
      if( $mode == 'edit' ){
      $where    = array(
        'table_name' => $this->input->post('table'),
				'id_tabel' => $this->input->post('value')
				);
      }
      else{
      $where    = array(
        'table_name' => $this->input->post('table'),
				'temp' => $this->input->post('value')
				);
      }
      $this->db->select("*");
      $this->db->where($where);
      $this->db->order_by('id_attachment');
      $result = $this->db->get('attachment');
      echo json_encode($result->result_array());
		}
		
		public function hapus()
		{
      $boleh = $this->session->userdata('id_users');
      if( empty($boleh) ){
      exit;
      }
			$id_attachment = $this->input->post('id_attachment');
      $where = array(
        'id_attachment' => $id_attachment
        );
      $this->db->from('attachment');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      $this->db->where($where);
      $this->db->delete('attachment');
      echo 1;
      /* if($a == 0){
        echo 0;
        }
      else{
        $this->db->where($where);
        $this->db->delete('attachment');
        echo 1;
        } */
		}
    
}