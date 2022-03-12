<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Postings extends CI_Controller
 {
    
  function __construct()
   {
    parent::__construct();
    // $this->load->library('fpdf');
    $this->load->library('Bcrypt');
    $this->load->library('Excel');
    $this->load->model('Crud_model');
    $this->load->model('Posting_model');
    $this->load->model('Komponen_model');
   }
  
  public function get_attachment_by_id_posting($id_posting)
   {
     $where = array(
						'id_tabel' => $id_posting
						);
    $d = $this->Posting_model->get_attachment_by_id_posting($where);
    if(!$d)
          {
						return 'blankgambar.jpg';
          }
        else
          {
						return $d['file_name'];
          }
   }
   
  private function menu_atas($parent=NULL,$hasil, $a){
		$a = $a + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where posisi='menu_atas'
    and parent='".$parent."' 
		and status = 1 order by urut
		");
		$x = $w->num_rows();
    
		if(($w->num_rows())>0)
		{
      if($parent == 0){
			$hasil .= '
<ul id="hornavmenu" class="nav navbar-nav" > <li><a href="'.base_url().'" class="fa-home ">HOME</a></li>'; 
      }
      else{
			$hasil .= '
<ul> ';
      }
		}
		$nomor = 0;
		foreach($w->result() as $h)
		{ 
    
    $r = $this->db->query("
		SELECT * from posting
									
		where parent='".$h->id_posting."' 
		and status = 1 order by urut
		");
		$xx = $r->num_rows();
    
			$nomor = $nomor + 1;
			if( $a > 1 ){
      $hasil .= '
<li> <a href="'.base_url().'postings/detail/'.$h->id_posting.'/'.str_replace(' ', '_', $h->judul_posting ).'.HTML">'.$h->judul_posting.' </a>';
        }
			else{ 
      if ($xx == 0){
      $hasil .= '
<li> <span class="'.$h->icon.' "> <a href="'.base_url().'postings/detail/'.$h->id_posting.'/'.str_replace(' ', '_', $h->judul_posting ).'.HTML">'.$h->judul_posting.'</a> </span>';
      }
      else{
      $hasil .= '
<li class="parent" > <span class="'.$h->icon.' ">'.$h->judul_posting.' </span>';
      } 
        }
      
			$hasil = $this->menu_atas($h->id_posting,$hasil, $a);
      $hasil .= '</li>';
		}
		if(($w->num_rows)>0)
		{
			$hasil .= "
</ul>";
		}
    else{
      
    }
		
		return $hasil;
	}
  
  public function get_komponen($judul_komponen)
   {
     $where = array(
						'judul_komponen' => $judul_komponen,
						'status' => 1
						);
    $d = $this->Komponen_model->get_data($where);
    if(!$d)
          {
						return '';
          }
        else
          {
						return $d['isi_komponen'];
          }
   }
  
  public function index()
   {
    $a = 0;
    $data['menu_atas'] = $this->menu_atas(0,$h="", $a);
    $data['menu_kiri'] = $this->posting(0,$h="", $a);
    $data['welcome1'] = $this->get_komponen('welcome1');
    $data['welcome2'] = $this->get_komponen('welcome2');
    $data['disclaimer'] = $this->get_komponen('disclaimer');
    $data['data_link_bawah'] = $this->get_komponen('data_link_bawah');
    $data['kontak_detail'] = $this->get_komponen('kontak_detail');
    $data['slide_show'] = $this->get_komponen('slide_show');
    $data['main_view'] = 'postings/home';
    $this->load->view('postings', $data);
   }
   
  public function categories()
   {
    $a = 0;
    $r = 0;
    $p=$this->uri->segment(3);
    $data['isi_halaman'] = $this->posting_categories($p,$q="", $r);
    $data['menu_atas'] = $this->menu_atas(0,$h="", $a);
    $data['menu_kiri'] = $this->posting(0,$h="", $a);
    $data['welcome1'] = $this->get_komponen('welcome1');
    $data['welcome2'] = $this->get_komponen('welcome2');
    $data['disclaimer'] = $this->get_komponen('disclaimer');
    $data['data_link_bawah'] = $this->get_komponen('data_link_bawah');
    $data['kontak_detail'] = $this->get_komponen('kontak_detail');
    $data['slide_show'] = $this->get_komponen('slide_show');
    $data['main_view'] = 'postings/categories';
    $this->load->view('postings', $data);
   }
   
  public function detail()
   {
    $url_modul = $this->uri->uri_string();
    $wheres = array(
						'alamat_url' => $url_modul,
            'status' => 1
						);
    $c = $this->Posting_model->get_modul($wheres);
    if(!$c)
          {
						$data['nama_modul'] = 'kosong';
          }
        else
          {
						$data['nama_modul'] = $c['nama_modul'];
          }
          
    
    $where = array(
						'id_posting' => $this->uri->segment(3),
            'status' => 1
						);
    $d = $this->Posting_model->get_data($where);
    if(!$d)
          {
						$data['judul_posting'] = '';
						$data['isi_posting'] = '';
						$data['kata_kunci'] = '';
						$data['gambar'] = 'blankgambar.jpg';
          }
        else
          {
						$data['judul_posting'] = $d['judul_posting'];
						$data['isi_posting'] = $d['isi_posting'];
						$data['kata_kunci'] = $d['kata_kunci'];
            $data['gambar'] = $this->get_attachment_by_id_posting($d['id_posting']);
          }
          
    $a = 0;
    $data['menu_atas'] = $this->menu_atas(0,$h="", $a);
    $data['menu_kiri'] = $this->posting(0,$h="", $a);
    $data['welcome1'] = $this->get_komponen('welcome1');
    $data['welcome2'] = $this->get_komponen('welcome2');
    $data['disclaimer'] = $this->get_komponen('disclaimer');
    $data['data_link_bawah'] = $this->get_komponen('data_link_bawah');
    $data['kontak_detail'] = $this->get_komponen('kontak_detail');
    $data['slide_show'] = $this->get_komponen('slide_show');
    $data['main_view'] = 'postings/detail';
    $this->load->view('postings', $data);
   }
  
  private function posting($parent=NULL,$hasil, $a){
    
		$a = $a + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where parent='".$parent."' 
    and posisi='menu_kiri'
		and status = 1 order by urut
		");
		$x = $w->num_rows();
    
		if(($w->num_rows())>0)
		{
      if($parent == 0){
        $hasil .= '<ul class="list-group sidebar-nav" id="sidebar-nav_'.$parent.'_'.$a.'">'; 
        }
      else{
        $hasil .= '<ul class="list-group sidebar-nav" id="sidebar-nav_'.$parent.'_'.$a.'">';
        }
		}
		$nomor = 0;
		foreach($w->result() as $h)
		{ 
    
    $r = $this->db->query("
		SELECT * from posting
									
		where parent='".$h->id_posting."' 
    and posisi='menu_kiri'
		and status = 1 order by urut
		");
		$xx = $r->num_rows();
    
			$nomor = $nomor + 1;
			if( $a > 1 ){
          if ($xx == 0){
            $hasil .= '<li class="list-group-item" style="padding-left:20px; "><a style="color:#97299b;" href="'.base_url().'postings/detail/'.$h->id_posting.'/'.$h->judul_posting.'">'.$h->judul_posting.' </a>';
            }
          else{
            $hasil .= '<li class="list-group-item"><a href="'.base_url().'postings/categories/'.$h->id_posting.'/'.$h->judul_posting.'"><i class="fa '.$h->icon.'"></i>  '.$h->judul_posting.' </a>';
            } 
        }
			else{ 
          if ($xx == 0){
            $hasil .= '<li class="list-group-item list-toggle"><a href="'.base_url().'postings/categories/'.$h->id_posting.'/'.$h->judul_posting.'">  '.$h->judul_posting.' </a>';
            }
          else{
            $hasil .= '<li class="list-group-item"><a href="'.base_url().'postings/categories/'.$h->id_posting.'/'.$h->judul_posting.'"><i class="fa '.$h->icon.'"></i>  '.$h->judul_posting.' </a>';
            } 
        }
			$hasil = $this->posting($h->id_posting,$hasil, $a);
      $hasil .= '</li>';
		}
		if(($w->num_rows)>0)
		{
			$hasil .= '</ul>';
		}
    else{
      
    }
		
		return $hasil;
	}
  
  private function posting_categories($parent,$hasils, $r){
    
		$r = $r + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where parent='".$parent."' 
    and posisi='menu_kiri'
		and status = 1 order by urut
		");
		$x = $w->num_rows();
		$nomor = 0;
		foreach($w->result() as $h)
		{ 
    
    $rs = $this->db->query("
		SELECT * from posting
									
		where parent='".$h->id_posting."' 
    and posisi='menu_kiri'
		and status = 1 order by urut
		");
		$xx = $rs->num_rows();
    $hasils = $this->posting_categories($h->id_posting,$hasils, $r);
			if ($xx == 0){
            $hasils .= 
            '
            <div class="blog-post padding-bottom-20">
              <div class="blog-item-header">
                  <h2><a href="#">'.$h->judul_posting.'</a></h2>
                  <div class="clearfix"></div>
                  <div class="blog-post-date"><a href="#">'.$h->created_time.'</a></div>
              </div>
              <div class="blog">
                  <div class="clearfix"></div>
                  <div class="blog-post-body row margin-top-15">
                      <div class="col-md-5">
                          <img class="margin-bottom-20" src="'.base_url().'media/upload/s_'.$this->get_attachment_by_id_posting($h->id_posting).'" alt="'.$h->judul_posting.'">
                      </div>
                      <div class="col-md-7">
                          <p>
                          '.substr(strip_tags($h->isi_posting), 0, 100).'
                          </p>
                          <a href="'.base_url().'postings/detail/'.$h->id_posting.'/'.$h->judul_posting.'" class="btn btn-primary"><i class="icon-chevron-right readmore-icon"></i> Baca Detail</a>
                      </div>
                  </div>
              </div>
            </div>
            ';
            }
			
      
		}
		return $hasils;
	}
  
  public function informasi_lainnya()
   {
    $r = 0;
    $informasi_terkait = $this->list_informasi_lainnya(0, $h="", $r);
    echo $informasi_terkait;
   }
  
  private function list_informasi_lainnya($parent,$hasils, $r){
    
		$r = $r + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where parent='".$parent."' 

		and status = 1 order by urut
		");
		$x = $w->num_rows();
		$nomor = 0;
		foreach($w->result() as $h)
		{ 
    
    $rs = $this->db->query("
		SELECT * from posting
									
		where parent='".$h->id_posting."' 
		and status = 1 order by urut
		");
		$xx = $rs->num_rows();
    $hasils = $this->list_informasi_lainnya($h->id_posting,$hasils, $r);
    if( $h->highlight == 1 ){
			if ($xx == 0){
            $hasils .= 
            '
            <li>
                <div class="recent-post">
                    <a href="">
                        <img class="pull-left" src="'.base_url().'media/upload/s_'.$this->get_attachment_by_id_posting($h->id_posting).'" alt="'.$h->judul_posting.'" style="width:54px; height:54px;" >
                    </a>
                    <a href="'.base_url().'postings/detail/'.$h->id_posting.'/'.$h->judul_posting.'" class="posts-list-title">'.$h->judul_posting.'</a>
                    <br>
                    <span class="recent-post-date">
                        '.$h->created_time.'
                    </span>
                </div>
                <div class="clearfix"></div>
            </li>
            ';
            }
      }
		}
		return $hasils;
	}
  
  public function informasi_terkait()
   {
    $parent = $this->input->post('parent');
    $r = 0;
    $informasi_terkait = $this->list_informasi_terkait($parent, $h="", $r);
    echo $informasi_terkait;
   }
  
  public function informasi_terkait_by_id()
   {
    $id_posting = $this->input->post('parent');
    $where = array(
						'id_posting' => $this->input->post('parent')
						);
    $d = $this->Posting_model->get_data($where);
    if(!$d)
          {
						$parent = 0;
          }
        else
          {
						$parent = $d['parent'];
          }
    $r = 0;
    $informasi_terkait = $this->list_informasi_terkait($parent, $h="", $r);
    echo $informasi_terkait;
   }
   
  private function list_informasi_terkait($parent,$hasils, $r){
    
		$r = $r + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where parent='".$parent."' 

		and status = 1 order by urut
		");
		$x = $w->num_rows();
		$nomor = 0;
		foreach($w->result() as $h)
		{ 
    
    $rs = $this->db->query("
		SELECT * from posting
									
		where parent='".$h->id_posting."' 

		and status = 1 order by urut
		");
		$xx = $rs->num_rows();
    $hasils = $this->list_informasi_terkait($h->id_posting,$hasils, $r);
			if ($xx == 0){
            $hasils .= 
            '
            <li>
                <div class="recent-post">
                    <a href="">
                        <img class="pull-left" src="'.base_url().'media/upload/s_'.$this->get_attachment_by_id_posting($h->id_posting).'" alt="'.$h->judul_posting.'" style="width:54px; height:54px;">
                    </a>
                    <a href="'.base_url().'postings/detail/'.$h->id_posting.'/'.$h->judul_posting.'" class="posts-list-title">'.$h->judul_posting.'</a>
                    <br>
                    <span class="recent-post-date">
                        '.$h->created_time.'
                    </span>
                </div>
                <div class="clearfix"></div>
            </li>
            ';
            }
		}
		return $hasils;
	}
    
 }