<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Surat extends CI_Controller
{

  function __construct(){
		parent::__construct();
    $this->load->library('Uut');
		$this->load->model('Crud_model');
		$this->load->model('Surat_model');
  }
  public function index(){
    $data['main_view'] = 'surat/home';
    $this->load->view('back_bone', $data);
  }
  public function json_option_surat(){
    $web=$this->uut->namadomain(base_url());
		$table = 'surat';
    $id_skpd = trim($this->input->post('id_skpd'));
		$hak_akses = $this->session->userdata('hak_akses');
		$where   = array(
			'surat.id_skpd' => $id_skpd
			);
		$fields  = 
			"
			surat.id_surat,
			surat.nomor_agenda
			";
		$order_by  = 'surat.nomor_agenda';
		echo json_encode($this->Surat_model->opsi($table, $where, $fields, $order_by));
  }
  public function total_data(){
    $web=$this->uut->namadomain(base_url());
    $limit = trim($this->input->post('limit'));
    $keyword = trim($this->input->post('keyword'));
    $orderby    = $this->input->post('orderby');
    $fields     = "*";
    if($keyword <> ''){
      $this->db->like($orderby, $keyword);
    }
    $where0 = array(
      'surat.status !=' => 99,
      'surat.domain' => $web,
      'surat.id_kelembagaan' => $this->input->post('id_kelembagaan'),
      'surat.jenis_surat' => $this->input->post('jenis_surat')
      );
    $this->db->where($where0);
    $query0 = $this->db->get('surat');
    $a= $query0->num_rows();
    echo trim(ceil($a / $limit));
  }
	public function json_all_surat(){
    $web=$this->uut->namadomain(base_url());
		$table = 'surat';
    $page    = $this->input->post('page');
    $limit    = $this->input->post('limit');
    $keyword    = $this->input->post('keyword');
    $order_by    = $this->input->post('orderby');
    $id_kelembagaan = $this->input->post('id_kelembagaan');
    $jenis_surat = $this->input->post('jenis_surat');
    $start      = ($page - 1) * $limit;
    $fields     = "
    *
    ";
    $where      = array(
      'surat.status !=' => 99,
      'surat.domain=' => $web,
      'surat.id_kelembagaan' => $id_kelembagaan,
      'surat.jenis_surat' => $jenis_surat
    );
    $orderby   = ''.$order_by.'';
    $query = $this->Surat_model->html_all($table, $where, $limit, $start, $fields, $orderby, $keyword);
    $urut=$start;
    foreach ($query->result() as $row)
      {
          $urut=$urut+1;
          echo '<tr id_surat="'.$row->id_surat.'" id="'.$row->id_surat.'" >';
          echo '<td valign="top">'.$row->nomor_agenda.'/'.$row->kode_klasifikasi.'</td>';
					echo '<td valign="top">'.$row->isi_ringkasan.'<br />';
            $where0 = array(
              'attachment.id_tabel' => $row->id_surat,
              'attachment.table_name' => 'surat'
              );
            $this->db->where($where0);
            $query0 = $this->db->get('attachment');
            foreach ($query0->result() as $row0)
              {
                echo '<a href="'.base_url().'media/upload/'.$row0->file_name.'" target="_blank"><i class="fa fa-paperclip"></i> '.$row0->keterangan.'</a><br />';
              }
          echo '</td>';
					echo '<td valign="top">'.$row->asal_surat.'</td>';
					echo '<td valign="top">'.$row->nomor_surat.'<br />'.$this->Surat_model->TanggalBahasaIndo($row->tanggal_surat).'</td>';
					echo '<td valign="top">
                    <div class="btn-group">
                      <a href="#tab_form_surat" data-toggle="tab" class="update_id btn btn-success btn-sm" id="update_id"><i class="fa fa-pencil-square-o"></i> Edt</a>
                      <a href="#" id="del_ajax" class="btn btn-danger btn-sm"><i class="fa fa-cut"></i> Del</a>';
                      if($jenis_surat=='surat_masuk'){
                        echo'
                        <a href="'.base_url().'disposisi_surat/?id_surat='.$row->id_surat.'" id="disposisi" class="btn btn-info btn-sm"><i class="fa fa-retweet"></i> Disp</a>
                        <a class="btn btn-warning btn-sm" href="'.base_url().'surat/cetak_by_id/?id_surat='.$row->id_surat.'" target="_blank"><i class="fa fa-file-pdf-o"></i> Ctk</a>
                        ';
                      }else{}
                      echo'
                    </div>
                </tr>
                ';
      }
          echo '<tr>';
          echo '<td valign="top" colspan="6" style="text-align:right;"><a class="btn btn-default btn-sm" target="_blank" href="',base_url(),'surat/cetak/?page='.$page.'&limit='.$limit.'&keyword='.$keyword.'&orderby='.$orderby.'&id_kelembagaan='.$id_kelembagaan.'&jenis_surat='.$jenis_surat.'" ><i class="fa fa-print"></i> Cetak ';if($jenis_surat=='surat_masuk'){echo'Surat Masuk';}else{echo'Surat Keluar';} echo' </a></td>';
          echo '</tr>';
          
   }
  public function simpan_surat(){
    $web=$this->uut->namadomain(base_url());
    $this->form_validation->set_rules('nomor_agenda', 'nomor_agenda', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
			{
				$data_input = array(
				'nomor_agenda' => trim($this->input->post('nomor_agenda')),
				'asal_surat' => trim($this->input->post('asal_surat')),
				'nomor_surat' => trim($this->input->post('nomor_surat')),
				'isi_ringkasan' => trim($this->input->post('isi_ringkasan')),
				'kode_klasifikasi' => trim($this->input->post('kode_klasifikasi')),
				'tanggal_surat' => trim($this->input->post('tanggal_surat')),
				'jenis_surat' => trim($this->input->post('jenis_surat')),
				'id_kelembagaan' => trim($this->input->post('id_kelembagaan')),
        'keterangan' => trim($this->input->post('keterangan')),
        'sifat_surat' => trim($this->input->post('sifat_surat')),
        'unit_pengolah_surat' => trim($this->input->post('unit_pengolah_surat')),
        'status_surat' => trim($this->input->post('status_surat')),
				'temp' => trim($this->input->post('temp')),
				'domain' => $web,
        'created_by' => $this->session->userdata('id_users'),
        'created_time' => date('Y-m-d H:i:s'),
        'updated_by' => 0,
        'updated_time' => date('Y-m-d H:i:s'),
        'deleted_by' => 0,
        'deleted_time' => date('Y-m-d H:i:s'),
        'status' => 1

				);
      $table_name = 'surat';
      $id         = $this->Surat_model->save_data($data_input, $table_name);
      echo $id;
			$table_name  = 'attachment';
      $where       = array(
        'table_name' => 'surat',
        'temp' => trim($this->input->post('temp'))
				);
			$data_update = array(
				'id_tabel' => $id
				);
      $this->Crud_model->update_data($data_update, $where, $table_name);
     }
   }
   public function get_by_id(){
    $web=$this->uut->namadomain(base_url());
      $where    = array(
        'id_surat' => $this->input->post('id_surat'),
        'surat.created_by=' => $this->session->userdata('id_users'),
        'surat.domain=' => $web
				);
      $this->db->select("*");
      $this->db->where($where);
      $this->db->order_by('id_surat');
      $result = $this->db->get('surat');
      echo json_encode($result->result_array());
		}
  public function update_surat(){
    $web=$this->uut->namadomain(base_url());
		$this->form_validation->set_rules('nomor_agenda', 'nomor_agenda', 'required');
    if ($this->form_validation->run() == FALSE){
      echo 0;
		}
    else{
      $data_update = array(
			
        'nomor_agenda' => trim($this->input->post('nomor_agenda')),
				'asal_surat' => trim($this->input->post('asal_surat')),
				'nomor_surat' => trim($this->input->post('nomor_surat')),
				'isi_ringkasan' => trim($this->input->post('isi_ringkasan')),
				'kode_klasifikasi' => trim($this->input->post('kode_klasifikasi')),
				'tanggal_surat' => trim($this->input->post('tanggal_surat')),
				'keterangan' => trim($this->input->post('keterangan')),
        'sifat_surat' => trim($this->input->post('sifat_surat')),
        'unit_pengolah_surat' => trim($this->input->post('unit_pengolah_surat')),
        'status_surat' => trim($this->input->post('status_surat')),
				'updated_by' => $this->session->userdata('id_users'),
        'updated_time' => date('Y-m-d H:i:s')
								
			);
      $table_name  = 'surat';
      $where       = array(
        'surat.id_surat' => trim($this->input->post('id_surat'))
			);
      $this->Surat_model->update_data($data_update, $where, $table_name);
      echo 1;
		}
  }
  public function hapus(){
    $web=$this->uut->namadomain(base_url());
			$id_surat = $this->input->post('id_surat');
      $where = array(
        'id_surat' => $id_surat,
				'created_by' => $this->session->userdata('id_users'),
        'domain' => $web
        );
      $this->db->from('surat');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      if($a == 0){
        echo 0;
        }
      else{
        $data_update = array(
        
          'status' => 99
                  
          );
        $table_name  = 'surat';
        $this->Surat_model->update_data($data_update, $where, $table_name);
        echo 1;
        }
		}
  public function cetak(){
    $web=$this->uut->namadomain(base_url());
    $where0 = array(
      'domain' => $web
      );
    $this->db->where($where0);
    $this->db->limit(1);
    $query0 = $this->db->get('dasar_website');
    foreach ($query0->result() as $row0)
      {
        $data['domain'] = $row0->domain;
        $data['alamat'] = $row0->alamat;
        $data['telpon'] = $row0->telpon;
        $data['email'] = $row0->email;
        $data['twitter'] = $row0->twitter;
        $data['facebook'] = $row0->facebook;
        $data['google'] = $row0->google;
        $data['instagram'] = $row0->instagram;
        $data['peta'] = $row0->peta;
        $data['keterangan'] = $row0->keterangan;
      }
    $id_kelembagaan = $this->input->get('id_kelembagaan');
    $jenis_surat = $this->input->get('jenis_surat');
    $where_lembaga = array(
      'id_kelembagaan' => $id_kelembagaan
      );
    $this->db->where($where_lembaga);
    $this->db->limit(1);
    $query_lembaga = $this->db->get('kelembagaan');
    foreach ($query_lembaga->result()as $row_lembaga){
        $data['nama_kelembagaan'] = $row_lembaga->nama_kelembagaan;
      }
    $where_desa = array(
      'id_propinsi' => $this->session->userdata('id_propinsi'),
      'id_kabupaten' => $this->session->userdata('id_kabupaten'),
      'id_kecamatan' => $this->session->userdata('id_kecamatan'),
      'id_desa' => $this->session->userdata('id_desa')
      );
    $this->db->where($where_desa);
    $this->db->limit(1);
    $query_desa = $this->db->get('desa');
    foreach ($query_desa->result()as $row_desa){
        $data['nama_desa'] = $row_desa->nama_desa;
      }
    if($jenis_surat=='surat_masuk'){$jenis_surat = 'Surat Masuk';}else{$jenis_surat = 'Surat Keluar';}
    $data['title'] = ''.$jenis_surat.'';
    // $data['main_view'] = 'surat/cetak';
    $this->load->view('surat/cetak', $data);
   }
  public function cetak_by_id(){
    $web=$this->uut->namadomain(base_url());
    $where0 = array(
      'domain' => $web
      );
    $this->db->where($where0);
    $this->db->limit(1);
    $query0 = $this->db->get('dasar_website');
    foreach ($query0->result() as $row0)
      {
        $data['domain'] = $row0->domain;
        $data['alamat'] = $row0->alamat;
        $data['telpon'] = $row0->telpon;
        $data['email'] = $row0->email;
        $data['twitter'] = $row0->twitter;
        $data['facebook'] = $row0->facebook;
        $data['google'] = $row0->google;
        $data['instagram'] = $row0->instagram;
        $data['peta'] = $row0->peta;
        $data['keterangan'] = $row0->keterangan;
      }
    $id_surat = $this->input->get('id_surat');
    $this->db->select('
        id_surat,
        nomor_agenda,
        asal_surat,
        nomor_surat,
        isi_ringkasan,
        kode_klasifikasi,
        tanggal_surat,
        id_kelembagaan,
        jenis_surat,
        keterangan,
        sifat_surat,
        unit_pengolah_surat,
        status_surat,
        (select kelembagaan.nama_kelembagaan from kelembagaan where kelembagaan.id_kelembagaan=surat.id_kelembagaan) as nama_kelembagaan
    ');
    $where = array(
      'surat.status !=' => 99,
      'surat.domain=' => $web,
      'surat.id_surat' => $id_surat
      );
    $this->db->where($where);
    $query = $this->db->get('surat');
    foreach ($query->result() as $row)
      {
        $jenis_surat = $row->jenis_surat;
        if($jenis_surat=='surat_masuk'){$jenis_surat='Surat Masuk';}else{$jenis_surat='Surat Keluar';}
        $data['id_surat'] = $row->id_surat;
        $data['nomor_agenda'] = $row->nomor_agenda;
        $data['asal_surat'] = $row->asal_surat;
        $data['nomor_surat'] = $row->nomor_surat;
        $data['isi_ringkasan'] = $row->isi_ringkasan;
        $data['kode_klasifikasi'] = $row->kode_klasifikasi;
        $data['tanggal_surat'] = $this->Surat_model->TanggalBahasaIndo($row->tanggal_surat);
        $data['nama_kelembagaan'] = $row->nama_kelembagaan;
        $data['jenis_surat'] = $jenis_surat;
        $data['keterangan'] = $row->keterangan;
        $data['sifat_surat'] = $row->sifat_surat;
        $data['unit_pengolah_surat'] = $row->unit_pengolah_surat;
        $data['status_surat'] = $row->status_surat;
      }
    $data['title'] = 'Lembar Disposisi';
    $this->load->view('surat/cetak_by_id', $data);
   }
}