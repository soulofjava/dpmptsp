<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Posting extends CI_Controller
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
    $data['main_view'] = 'posting/home';
    $this->load->view('back_bone', $data);
   }
  
  function load_the_option()
	{
		$a = 0;
		echo $this->option_posting(0,$h="", $a);
	}
  
  private function option_posting($parent=0,$hasil, $a){
		$a = $a + 1;
		$w = $this->db->query("SELECT * from posting where parent='".$parent."' and status = 1 order by urut");
		if(($w->num_rows())>0){
		} 
		$nomor = 0;
		foreach($w->result() as $h)
		{
			$nomor = $nomor + 1;
			$hasil .= '<option value="'.$h->id_posting.'">';
			if( $a > 1 ){
			$hasil .= ''.str_repeat("--", $a).' '.$h->judul_posting.'';
			}
			else{
			$hasil .= ''.$h->judul_posting.'';
			}
			$hasil .= '</option>';
			$hasil = $this->option_posting($h->id_posting,$hasil, $a);
		}
		if(($w->num_rows)>0){
		}
		return $hasil;
	}
  
  function load_the_option_by_posisi()
	{
    $posisi = trim($this->input->post('posisi'));
		$a = 0;
		echo $this->option_posting_by_posisi(0,$h="", $a, $posisi);
	}
  
  private function option_posting_by_posisi($parent=0,$hasil, $a, $posisi){
		$a = $a + 1;
		$w = $this->db->query("SELECT * from posting 
                          where parent='".$parent."' 
                          and status = 1 
                          and posisi='".$posisi."'
                          order by urut");
		if(($w->num_rows())>0){
		} 
		$nomor = 0;
		foreach($w->result() as $h)
		{
			$nomor = $nomor + 1;
			$hasil .= '<option value="'.$h->id_posting.'">';
			if( $a > 1 ){
			$hasil .= ''.str_repeat("--", $a).' '.$h->judul_posting.'';
			}
			else{
			$hasil .= ''.$h->judul_posting.'';
			}
			$hasil .= '</option>';
			$hasil = $this->option_posting_by_posisi($h->id_posting,$hasil, $a, $posisi);
		}
		if(($w->num_rows)>0){
		}
		return $hasil;
	}
  
  function load_table()
	{
		$a = 0;
		echo $this->posting(0,$h="", $a);
	}
  
  private function posting($parent=0,$hasil, $a){
		$a = $a + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where parent='".$parent."' 
		and status = 1 order by posisi, urut
		");
		
		if(($w->num_rows())>0)
		{
			//$hasil .= "<tr>";
		}
		$nomor = 0;
		foreach($w->result() as $h)
		{
			$nomor = $nomor + 1;
			$hasil .= '<tr id_posting="'.$h->id_posting.'" id="'.$h->id_posting.'" >';
      if( $h->posisi == 'menu_kiri' ){
      $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Menu-Kiri </td>';
      }
      elseif( $h->posisi == 'menu_atas' ){
      $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Menu-Atas </td>';
      }
      elseif( $h->posisi == 'menu_kanan' ){
      $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Menu-Kanan </td>';
      }
      elseif( $h->posisi == ' independen' ){
      $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Independen </td>';
      }
      else{
      $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Unknown </td>';
      }
      if( $a > 1 ){
        $hasil .= '<td style="padding: 2px 2px 2px '.($a * 20).'px ;"> <a target="_blank" href="'.base_url().'postings/detail/'.$h->id_posting.'/'.str_replace(' ', '_', $h->judul_posting ).'.HTML">'.$h->judul_posting.' </a> </td>';
        }
			else{
        $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> '.$h->judul_posting.' </td>';
        }
      $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> '.$h->urut.' </td>';
      if( $h->highlight == 0 ){
        $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Tidak </td>';
      }
      else{
        $hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Ya </td>';
      }
      if( $h->tampil_menu == 0 ){
        //$hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Tidak </td>';
      }
      else{
        //$hasil .= '<td style="padding: 2px 2px 2px 2px ;"> Ya </td>';
      }
      
			$hasil .= 
			'
			<td style="padding: 2px 2px 2px 2px ;"> 
			<a href="#tab_1" data-toggle="tab" class="update_id" ><i class="fa fa-pencil-square-o"></i></a> 
			<a href="#" id="del_ajax"><i class="fa fa-cut"></i></a> 
			</td>
			';
			$hasil .= '</tr>';
			$hasil = $this->posting($h->id_posting,$hasil, $a);
		}
		if(($w->num_rows)>0)
		{
			//$hasil .= "</tr>";
		}
		
		return $hasil;
	}
  
  function load_table1()
	{
		$a = 0;
		$menu_atas = $this->posting1(0,$h="", $a);
    echo $menu_atas;
	}
  
  private function posting1($parent=0,$hasil, $a){
		$a = $a + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where parent='".$parent."'
    and posisi='menu_atas'
		and status = 1 order by urut
		");
		
		if(($w->num_rows())>0)
		{
      if($parent == 0){
			$hasil .= '
<ul> '; 
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
<li> '.$h->judul_posting.' ';
        }
			else{ 
      if ($xx == 0){
      $hasil .= '
<li> '.$h->judul_posting.'';
      }
      else{
      $hasil .= '
<li> '.$h->judul_posting.'';
      } 
        }
			$hasil = $this->posting1($h->id_posting,$hasil, $a);
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
  
  function load_table2()
	{
		$a = 0;
		$menu_atas = $this->posting2(0,$h="", $a);
    echo $menu_atas;
	}
  
  private function posting2($parent=0,$hasil, $a){
		$a = $a + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where parent='".$parent."'
    and posisi='menu_kanan'
		and status = 1 order by urut
		");
		
		if(($w->num_rows())>0)
		{
      if($parent == 0){
			$hasil .= '
<ul> '; 
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
<li> '.$h->judul_posting.' ';
        }
			else{ 
      if ($xx == 0){
      $hasil .= '
<li> '.$h->judul_posting.'';
      }
      else{
      $hasil .= '
<li> '.$h->judul_posting.'';
      } 
        }
			$hasil = $this->posting2($h->id_posting,$hasil, $a);
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
  
function load_table3()
	{
		$a = 0;
		$menu_kiri = $this->posting3(0,$h="", $a);
    echo $menu_kiri;
	}
  
  private function posting3($parent=0,$hasil, $a){
		$a = $a + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where parent='".$parent."'
    and posisi='menu_kiri'
		and status = 1 order by urut
		");
		
		if(($w->num_rows())>0)
		{
      if($parent == 0){
			$hasil .= '
<ul> '; 
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
<li> '.$h->judul_posting.' ';
        }
			else{ 
      if ($xx == 0){
      $hasil .= '
<li> '.$h->judul_posting.'';
      }
      else{
      $hasil .= '
<li> '.$h->judul_posting.'';
      } 
        }
			$hasil = $this->posting3($h->id_posting,$hasil, $a);
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
  
  public function json_all_posting()
   {
    $halaman    = $this->input->post('halaman');
    $limit    = $this->input->post('limit');
    $start      = ($halaman - 1) * $limit;
    $fields     = "*";
    $where      = array(
      'posting.status !=' => 99
    );
    $order_by   = 'posting.parent';
    echo json_encode($this->Posting_model->json_all_posting($where, $limit, $start, $fields, $order_by));
   }
   
  public function simpan_posting()
   {
		$this->form_validation->set_rules('judul_posting', 'judul_posting', 'required');
		$this->form_validation->set_rules('highlight', 'highlight', 'required');
		$this->form_validation->set_rules('tampil_menu', 'tampil_menu', 'required');
		$this->form_validation->set_rules('parent', 'parent', 'required');
		$this->form_validation->set_rules('urut', 'urut', 'required');
		$this->form_validation->set_rules('posisi', 'posisi', 'required');
		$this->form_validation->set_rules('icon', 'icon', 'required');
		$this->form_validation->set_rules('kata_kunci', 'kata_kunci', 'required');
		$this->form_validation->set_rules('temp', 'temp', 'required');
		$this->form_validation->set_rules('isi_posting', 'isi_posting', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      $data_input = array(
			
				'judul_posting' => trim($this->input->post('judul_posting')),
				'highlight' => trim($this->input->post('highlight')),
				'tampil_menu' => trim($this->input->post('tampil_menu')),
				'parent' => trim($this->input->post('parent')),
				'kata_kunci' => trim(str_replace('.', '', str_replace(',', '', $this->input->post('kata_kunci')))),
        'temp' => trim($this->input->post('temp')),
        'urut' => trim($this->input->post('urut')),
        'posisi' => trim($this->input->post('posisi')),
        'icon' => trim($this->input->post('icon')),
        'isi_posting' => trim($this->input->post('isi_posting')),
        'keterangan' => trim($this->input->post('keterangan')),
        'created_by' => $this->session->userdata('id_users'),
        'created_time' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('id_users'),
        'updated_time' => date('Y-m-d H:i:s'),
				'deleted_by' => 0,
        'deleted_time' => date('Y-m-d H:i:s'),
        'status' => 1

				);
      $table_name = 'posting';
      $id         = $this->Posting_model->simpan_posting($data_input, $table_name);
      echo $id;
			$table_name  = 'attachment';
      $where       = array(
        'table_name' => 'posting',
        'temp' => trim($this->input->post('temp'))
				);
			$data_update = array(
				'id_tabel' => $id
				);
      $this->Crud_model->update_data($data_update, $where, $table_name);
     }
   }
   
  public function update_posting()
   {
    $this->form_validation->set_rules('judul_posting', 'judul_posting', 'required');
    $this->form_validation->set_rules('highlight', 'highlight', 'required');
    $this->form_validation->set_rules('tampil_menu', 'tampil_menu', 'required');
		$this->form_validation->set_rules('urut', 'urut', 'required');
		$this->form_validation->set_rules('posisi', 'posisi', 'required');
		$this->form_validation->set_rules('icon', 'icon', 'required');
		$this->form_validation->set_rules('kata_kunci', 'kata_kunci', 'required');
    if ($this->form_validation->run() == FALSE)
     {
      echo 0;
     }
    else
     {
      $data_update = array(
			
				'judul_posting' => trim($this->input->post('judul_posting')),
				'highlight' => trim($this->input->post('highlight')),
				'tampil_menu' => trim($this->input->post('tampil_menu')),
				'parent' => trim($this->input->post('parent')),
				'kata_kunci' => trim(str_replace('.', '', str_replace(',', '', $this->input->post('kata_kunci')))),
        'temp' => trim($this->input->post('temp')),
        'urut' => trim($this->input->post('urut')),
        'posisi' => trim($this->input->post('posisi')),
        'icon' => trim($this->input->post('icon')),
        'isi_posting' => trim($this->input->post('isi_posting')),
        'keterangan' => trim($this->input->post('keterangan')),
				'updated_by' => $this->session->userdata('id_users'),
        'updated_time' => date('Y-m-d H:i:s')
								
				);
      $table_name  = 'posting';
      $where       = array(
        'posting.id_posting' => trim($this->input->post('id_posting'))
			);
      $this->Posting_model->update_data_posting($data_update, $where, $table_name);
      echo 1;
     }
   }
   
   public function get_by_id()
		{
      $where    = array(
        'id_posting' => $this->input->post('id_posting')
				);
      $this->db->select("*");
      $this->db->where($where);
      $this->db->order_by('id_posting');
      $result = $this->db->get('posting');
      echo json_encode($result->result_array());
		}
   
   public function total_posting()
		{
      $limit = trim($this->input->get('limit'));
      $this->db->from('posting');
      $where    = array(
        'status' => 1
				);
      $this->db->where($where);
      $a = $this->db->count_all_results(); 
      echo trim(ceil($a / $limit));
		}
   
  public function hapus()
		{
			$id_posting = $this->input->post('id_posting');
      $where = array(
        'id_posting' => $id_posting,
				'created_by' => $this->session->userdata('id_users')
        );
      $this->db->from('posting');
      $this->db->where($where);
      $a = $this->db->count_all_results();
      if($a == 0){
        echo 0;
        }
      else{
        $data_update = array(
        
          'status' => 99
                  
          );
        $table_name  = 'posting';
        $this->Posting_model->update_data_posting($data_update, $where, $table_name);
        echo 1;
        }
	}
	
   
	public function galeri()
	{
	 $a = 0;
	 $r = $this->uri->segment(6);
	 $p=$this->uri->segment(3);
		 $pencarian = $this->input->post('cari');
	 $data['isi_halaman'] = $this->pencarian_galeri($p, $q="", $r, $pencarian);
	 $data['menu_atas'] = $this->menu_atas(0,$h="", $a);
	 $data['menu_kiri'] = '';
 
 
	 //PAGINATION
	 $page =  $r;
	 $noPage =  $page;
	 $showPage = 0;
	 $s = $this->db->query("SELECT COUNT(*) as jumlah_data from posting where parent='".$this->uri->segment(3)."' and status=1 and judul_posting like '%".$pencarian."%'");
	 $jumlah_pencarian = $s->row("jumlah_data");
	 $jumPage = $s->row("jumlah_data")/10;
 
	 $url = 'https://dpmptsp.wonosobokab.go.id/pencarian/galeri/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'';
 
	 $pagination_top = '
	 <div class="text-right">
	   <ul class="pagination">
	 ';
	 $pagination_bottom = '
	 <div class="text-center">
	   <ul class="pagination">
	 ';
 
	 //menampilkan link halaman awal
	 if ($page != 1 || empty($page)) { $pagination_bottom .= '<li><a href="'.$url.'">&laquo;&laquo;</a></li>';$pagination_top .= '<li><a href="'.$url.'">&laquo;&laquo;</a></li>'; }
  
	 // menampilkan link previous
  
	 if ($page > 1) { $pagination_bottom .= '<li><a href="'.$url.'/'.($page-1).'">&laquo;</a></li>';$pagination_top .= '<li><a href="'.$url.'/'.($page-1).'">&laquo;</a></li>'; }
  
	 // memunculkan nomor halaman dan linknya
	 for($page = 1; $page <= $jumPage; $page++)
	 {
		  if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
		  {   
			 if (($showPage == 1) && ($page != 2))  { $pagination_bottom .= '<li><a href="#">...</a></li>';$pagination_top.= '<li><a href="#">...</a></li>'; }
			 if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  { $pagination_bottom .= '<li><a href="#">...</a></li>';$pagination_top .= '<li><a href="#">...</a></li>'; }
			 if ($page == $r) { $pagination_bottom .= '<li class="active"><a href="#">'.$page.'</a></li>';$pagination_top.= '<li class="active"><a href="#">'.$page.'</a></li>'; }
			 else { $pagination_bottom .= '<li><a href="'.$url.'/'.$page.'">'.$page.'</a></li>';$pagination_top.= '<li><a href="'.$url.'/'.$page.'">'.$page.'</a></li>'; }
			 $showPage = $page;          
		  }
	 }
  
	 // menampilkan link next
  
	 if ($noPage < $jumPage) { $pagination_bottom .= '<li><a href="'.$url.'/'.($noPage+1).'">&gt;</a></li>';$pagination_top .= '<li><a href="'.$url.'/'.($noPage+1).'">&gt;</a></li>'; }
  
	 //menampilkan link halaman akhir
	 if ($noPage != $jumPage) { $pagination_bottom .= '<li><a href="'.$url.'/'.$jumPage.'">&gt;&gt;</a></li>';$pagination_top .= '<li><a href="'.$url.'/'.$jumPage.'">&gt;&gt;</a></li>'; }
  
	 $pagination_top .= '
	   </ul>
	 </div>
	 ';
	 $pagination_bottom .= '
	   </ul>
	 </div>
	 ';
	 $data['pagination_top'] = $pagination_top;
	 $data['pagination_bottom'] = $pagination_bottom;
	 $data['pencarian'] = $pencarian;
	 $data['jumlah_pencarian'] = $jumlah_pencarian;
	 $data['main_view'] = 'postings/categories';
	 $this->load->view('postings', $data);
	}
	
   private function pencarian_galeri($parent, $hasils, $r, $pencarian){
	 if($r > 1){
	   $offset = ($r*10);
	 }else{
			 $offset = 0;
		 }
 
		 $w = $this->db->query("
		 SELECT * from posting
		 where parent='".$parent."' 
	 and posisi='menu_atas'
		 and status = 1 
		 and judul_posting
		 like '%".$pencarian."%'
	 order by created_time desc
	 limit ".$offset.",10
		 ");
		 $x = $w->num_rows();
		 $nomor = 0;
 
		 foreach($w->result() as $h)
		 { 
	 
	 $rs = $this->db->query("
		 SELECT * from posting
		 where parent='".$h->id_posting."' 
		 ");
		 $xx = $rs->num_rows();
 
	 $hasils = $this->pencarian_galeri($h->id_posting, $hasils, $r, $pencarian);
			 $healthy = array(" ", ",", ".", "-", ":", "=", "!", "?", "(", ")", "@", "%", "&", "/");
			 $yummy   = array("_","","","","","","","","","","","","","");
			 $newphrase = str_replace($healthy, $yummy, $h->judul_posting);
			 $created_time = $h->created_time;
			 $hasils .= 
			 '
						 <div class="row">
							 <div class="col-md-4 col-sm-4">
								 <!-- BEGIN CAROUSEL -->            
								 <div class="front-carousel">
									 <div class="carousel slide" id="myCarousel">
										 <!-- Carousel items -->
										 <div class="carousel-inner">
											 <div class="item active">
												 <img alt="" src="'.base_url().'media/upload/s_'.$this->get_attachment_by_id_posting($h->id_posting).'">
											 </div>
										 </div>
										 <!-- Carousel nav -->
										 <a data-slide="prev" href="#myCarousel" class="carousel-control left">
											 <i class="fa fa-angle-left"></i>
										 </a>
										 <a data-slide="next" href="#myCarousel" class="carousel-control right">
											 <i class="fa fa-angle-right"></i>
										 </a>
									 </div>                
								 </div>
								 <!-- END CAROUSEL -->             
							 </div>
							 <div class="col-md-8 col-sm-8">
								 <h2><a href="'.base_url().'postings/detail/'.$h->id_posting.'/'.$newphrase.'.HTML">'.$h->judul_posting.'</a></h2>
								 <p>'.substr(strip_tags($h->isi_posting), 0, 200).'</p>
								 <i class="fa fa-calendar"></i> '.$created_time.'
								 <a class="btn btn-info" href="'.base_url().'postings/detail/'.$h->id_posting.'/'.$newphrase.'.HTML" class="more"><i class="fa fa-eye"></i> Baca Selengkapnya <i class="icon-angle-right"></i></a>
								 
							 </div>
						 </div>
						 <hr class="blog-post-sep">
			 ';
		 }
 
		 return $hasils;
	 }
  
	 public function get_attachment_by_id_posting($id_posting)
	  {
	   $where = array(
		 'id_tabel' => $id_posting
		 );
	   $d = $this->Posting_model->get_attachment_by_id_posting($where);
	   if(!$d)
		 {
		   return 'logo_wonosobokab.png';
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
		and tampil_menu = 1 
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
					if($h->judul_posting == 'BERITA'){
					  $hasil .= '<li><a href="'.base_url().'posting/galeri/'.$h->id_posting.'/'.$h->judul_posting.'.HTML"> <span class=""> '.$h->judul_posting.' </span> </a>';
					}else{
			  $hasil .= '<li class="parent" > <span class="'.$h->icon.' ">'.$h->judul_posting.' </span>';
			}
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
    
 }