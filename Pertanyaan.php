<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->library('fpdf');
		$this->load->library('Bcrypt');
    $this->load->library('Excel');
		$this->load->model('Cetak_model');
  }

	function index()
	{
		$a = 0;
		$data['option_pertanyaan'] = $this->option_pertanyaan(0,$h="", $a);
		$data['main_view']     = 'pertanyaan/home';
		$where = array(
        'status' => 1
      );
		$fields = 'id_skpd, nama_skpd';
    $table_name = 'skpd';
		$order_by = 'nama_skpd';
		$data['skpd']     =$this->Crud_model->opsi($where, $table_name, $fields, $order_by);
    $this->load->view('welcome_message', $data);
	}
	
	function load_the_option()
	{
		$a = 0;
		echo $this->option_pertanyaan(0,$h="", $a);
	} 
	
	function load_pertanyaan()
	{
		$a = 0;
		echo $this->pertanyaan(0,$h="", $a);
	}
	
	public function simpan_pertanyaan()
  {
		// isian yang harus di isi
		$this->form_validation->set_rules('parent', 'parent', 'required');
		$this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'required');
		$this->form_validation->set_rules('urut', 'urut', 'required');
		$this->form_validation->set_rules('satuan', 'satuan', 'required');
		// semua variable yang mau dimasukkan ke tabel
		$parent = trim($this->input->post('parent'));
		$pertanyaan = trim($this->input->post('pertanyaan'));
		$urut = trim($this->input->post('urut'));
		$satuan = trim($this->input->post('satuan'));
		
    if ($this->form_validation->run() == FALSE) {
      echo 0;
    } else {
      $data_input = array(
        'parent' => $parent,
        'pertanyaan' => $pertanyaan,
        'urut' => $urut,
        'satuan' => $satuan,
        'status' => 1
      );
      $table_name = 'pertanyaan';
      $id         = $this->Crud_model->save_data($data_input, $table_name);
    }
  }
	
	public function simpan_pertanyaan_skpd()
  {
		// isian yang harus di isi
		$this->form_validation->set_rules('id_skpd', 'id_skpd', 'required');
		$this->form_validation->set_rules('id_pertanyaan', 'id_pertanyaan', 'required');
		// semua variable yang mau dimasukkan ke tabel
		$id_skpd = trim($this->input->post('id_skpd'));
		$id_pertanyaan = trim($this->input->post('id_pertanyaan'));
		
    if ($this->form_validation->run() == FALSE) {
      echo 0;
    } else {
      $data_input = array(
        'id_skpd' => $id_skpd,
        'id_pertanyaan' => $id_pertanyaan,
        'tahun' => $this->Crud_model->tahun_aktif()
      );
			
			$where = array(
        'id_skpd' => $id_skpd,
        'id_pertanyaan' => $id_pertanyaan,
        'tahun' => $this->Crud_model->tahun_aktif()
      );
			
      $table_name = 'skpd_pertanyaan';
			$this->db->where($where);
			$this->db->from('skpd_pertanyaan');
			$j = $this->db->count_all_results();
			if( $j == 0){
				$id         = $this->Crud_model->save_data($data_input, $table_name);
				}
			else{
				echo 0;
				}
    }
  }
	
	// fungsi untuk menyimpan data edit
  public function e_simpan_pertanyaan()
  {
    // isian yang harus di isi
		$this->form_validation->set_rules('id_pertanyaan', 'id_pertanyaan', 'required');
		$this->form_validation->set_rules('parent', 'parent', 'required');
		$this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'required');
		$this->form_validation->set_rules('urut', 'urut', 'required');
		$this->form_validation->set_rules('satuan', 'satuan', 'required');
		// semua variable yang mau dimasukkan ke tabel
		$id_pertanyaan = trim($this->input->post('id_pertanyaan'));
		$parent = trim($this->input->post('parent'));
		$pertanyaan = trim($this->input->post('pertanyaan'));
		$urut = trim($this->input->post('urut'));
		$satuan = trim($this->input->post('satuan'));
    
    if ($this->form_validation->run() == FALSE) {
      echo '[]';
    } else {
      $data_update = array(
        'pertanyaan' => $pertanyaan,
        'parent' => $parent,
        'satuan' => $satuan,
        'urut' => $urut
				);
      $table_name  = 'pertanyaan';
      $where       = array(
        'pertanyaan.id_pertanyaan' => $id_pertanyaan
				);
      $this->Crud_model->update_data($data_update, $where, $table_name);
			echo'[{"save":"ok"}]';
    }
  }
	
	public function pertanyaan_get_by_id()
	{
		$table_name = 'pertanyaan';
		$id = $_GET['id'];
		$fields = '*';
		$where = array(
			'pertanyaan.id_pertanyaan' => $id
			);
		$order_by = 'pertanyaan.id_pertanyaan';
		echo json_encode( $this->Crud_model->get_by_id($table_name, $where, $fields, $order_by ) );
	}
	
	public function load_pertanyaan_skpd()
	{
		$id = $_GET['id'];
		$query = $this->db->query("
		SELECT skpd.nama_skpd, skpd_pertanyaan.id_skpd_pertanyaan FROM skpd_pertanyaan, skpd
		where skpd_pertanyaan.id_skpd = skpd.id_skpd
		and skpd_pertanyaan.id_pertanyaan = '".$id ."'
		");
		
		foreach ($query->result() as $row)
		{
			echo '<tr id_skpd_pertanyaan="'.$row->id_skpd_pertanyaan.'" id="'.$row->id_skpd_pertanyaan.'" >';
				echo '<td style="padding: 2px 2px 2px 2px ;">'.$row->nama_skpd.'</td>';
				echo '<td style="padding: 2px 2px 2px 2px ;"><a href="#" id="del_ajax"><i class="fa fa-cut"></i></a></td>';
			echo '</tr>';
		}
		
	}
	
	public function hapus_skpd_pertanyaan()
	{
		$id = $_GET['id'];
		$this->db->where('id_skpd_pertanyaan', $id);
		$this->db->delete('skpd_pertanyaan');
		echo ' {"errors":"No"} ';
	}
	
	public function hapus_pertanyaan()
	{
		$table_name = 'pertanyaan';
		$id = $_GET['id'];
		$where = array(
			'pertanyaan.id_pertanyaan' => $id
			);
		$t = $this->Crud_model->semua_data($where, $table_name);
		if( $t == 0 ){
			echo ' {"errors":"Yes"} ';
			}
		else{
			$data_update = array(						
				'pertanyaan.status' => 99
				);
			$where = array(
				'pertanyaan.id_pertanyaan' => $id
				);
			$this->Crud_model->update_data($data_update, $where, $table_name);
			echo ' {"errors":"No"} ';
			}
	}
	
	private function option_pertanyaan($parent=0,$hasil, $a){
		$a = $a + 1;
		$w = $this->db->query("SELECT * from pertanyaan where parent='".$parent."' and status = 1 order by urut");
		
		if(($w->num_rows())>0){
		}
		$nomor = 0;
		
		foreach($w->result() as $h)
		{
			$nomor = $nomor + 1;
			$hasil .= '<option value="'.$h->id_pertanyaan.'">';
			if( $a > 1 ){
			$hasil .= ''.str_repeat("--", $a).' '.$h->pertanyaan.'';
			}
			else{
			$hasil .= ''.$h->pertanyaan.'';
			}
			$hasil .= '</option>';
			$hasil = $this->option_pertanyaan($h->id_pertanyaan,$hasil, $a);
		}
		if(($w->num_rows)>0){
		}
		
		return $hasil;
	}
	
	private function pertanyaan($parent=0,$hasil, $a){
		$a = $a + 1;
		$w = $this->db->query("
		SELECT *, 
		(select COUNT(skpd_pertanyaan.id_skpd_pertanyaan)
			from skpd_pertanyaan
			WHERE skpd_pertanyaan.id_pertanyaan = pertanyaan.id_pertanyaan
				) as jumlah
		from pertanyaan
									
		where parent='".$parent."' 
		and status = 1 order by urut
		");
		
		if(($w->num_rows())>0)
		{
			//$hasil .= "<tr>";
		}
		$nomor = 0;
		foreach($w->result() as $h)
		{
			$nomor = $nomor + 1;
			$hasil .= '<tr id_pertanyaan="'.$h->id_pertanyaan.'" id="'.$h->id_pertanyaan.'" >';
			if( $a > 1 ){
			$hasil .= '<td style="padding: 2px 2px 2px '.($a * 20).'px ;"> '.$h->urut.'. '.$h->pertanyaan.' </td>';
			}
			else{
			$hasil .= '<td style="padding: 2px 2px 2px 2px ;"> '.$h->urut.'. '.$h->pertanyaan.' </td>';
			}
			$hasil .= 
			'
			<td style="padding: 2px 2px 2px 2px ;">'.$h->satuan.'</td>
			<td style="padding: 2px 2px 2px 2px ;"> 
			<a href="#" data-toggle="modal" data-target="#TambahSubModal" class="add_id" ><i class="fa fa-plus-square"></i></a> 
			<a href="#" data-toggle="modal" data-target="#EditSubModal" class="update_id" ><i class="fa fa-pencil-square-o"></i></a> 
			<a href="#" id="del_ajax"><i class="fa fa-cut"></i></a> 
			</td>
			';
			$hasil .= 
			'
			<td style="padding: 2px 2px 2px 2px ;"> 
			<a href="#" data-toggle="modal" data-target="#ListSkpdModal" class="list_skpd_id" ><i class="fa fa-plus-square"></i> '.$h->jumlah.'</a> 
			</td>
			';
			$hasil .= '</tr>';
			$hasil = $this->pertanyaan($h->id_pertanyaan,$hasil, $a);
		}
		if(($w->num_rows)>0)
		{
			//$hasil .= "</tr>";
		}
		
		return $hasil;
	}
	
} 