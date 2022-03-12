<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Uut Keren.
 **/
class Uut{

	function namadomain($base_url)
	{
    $domain1 = str_replace('https', '', base_url() );
    $domain2 = str_replace('http', '', $domain1 );
    $domain3 = str_replace(':', '', $domain2 );
    $domain4 = str_replace('/', '', $domain3 );
		return $domain4;
	}
 
  function menu_atas($parent=NULL,$hasil, $a){
    $web=$this->uut->namadomain(base_url());
		$a = $a + 1;
		$w = $this->db->query("
		SELECT * from posting
									
		where posisi='menu_atas'
    and parent='".$parent."' 
		and status = 1 
		and tampil_menu = 1 
    and domain='".$web."'
    order by urut
		");
		$x = $w->num_rows();
    
		if(($w->num_rows())>0)
		{
      if($parent == 0){
			$hasil .= '
<ul id="hornavmenu" class="nav navbar-nav" > <li><a href="'.base_url().'" class="fa-home active">HOME</a></li>'; 
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
		and status = 1 
		and tampil_menu = 1 
    and domain='".$web."'
    order by urut
		");
		$xx = $r->num_rows();
    
			$nomor = $nomor + 1;
      
			$z = $this->db->query("
			SELECT * from posting
			where id_posting='".$parent."'
			");    
			foreach($z->result() as $z1)
			{ 
			  if(($z1->judul_posting == 'Data Desa' or $z1->judul_posting == 'DATA DESA') && $nomor == 1){    
			  	//mitradesa    
				$ze = $this->db->query("
				SELECT desa.* FROM desa, data_desa
    			WHERE data_desa.id_desa = desa.id_desa
    			AND data_desa.desa_website='".$web."'
				");    
				foreach($ze->result() as $z2)
				{  
					$kode_kecamatan = ''; 	
					if($z2->kode_kecamatan < 10){
						$kode_kecamatan = '0'.$z2->kode_kecamatan;
					}else{
						$kode_kecamatan = $z2->kode_kecamatan;
					}
					$hasil .= '
					<li><a href="http://'.$z2->kode_propinsi.'-0'.$z2->kode_kabupaten.'-'.$kode_kecamatan.'-'.$z2->kode_desa.'.wonosobokab.go.id/" target="_Blank">Aplikasi Mitradesa</a>
					';
				}
				//regulasi desa
				$x1 = $this->db->query("
				SELECT * from posting
				where judul_posting = 'Regulasi Desa'
				and status = 1 
				and tampil_menu = 1 
				and domain='".$web."'
				");    
				$x11 = $x1->num_rows();          
				if ($x11 == 0){
				  $hasil .= '
				  <li>  <a href="#"> Produk Hukum </a>
					<ul>
					  <li><a href="'.base_url().'peraturan/daftar_peraturan/?&id_peraturan=1&tentang=Peraturan_Desa.html">Peraturan Desa</a></li>
					</ul>
				  ';
				}
			  }else if($z1->judul_posting == 'Regulasi Desa' && $nomor == 1){            
				$hasil .= '
				<li><a href="'.base_url().'peraturan/daftar_peraturan/?&id_peraturan=1&tentang=Peraturan_Desa.html">Peraturan Desa</a>
				';
			  }
			}
			if( $a > 1 ){
				if($h->judul_posting == 'Pengaduan Masyarakat'){
				$hasil .= '
				<li><a href="'.base_url().'pengaduan_masyarakat">'.$h->judul_posting.'</a>
				';
				}
				elseif($h->judul_posting == 'Permohonan Informasi'){
				$hasil .= '
				<li><a href="'.base_url().'permohonan_informasi_publik">'.$h->judul_posting.'</a>
				';
				}
				elseif($h->judul_posting == 'Pengajuan Keberatan'){
				$hasil .= '
				<li><a href="'.base_url().'pengajuan_keberatan">'.$h->judul_posting.'</a>
				';
				}
				else{
				$hasil .= '
					<li> <a href="'.base_url().'postings/details/'.$h->id_posting.'/'.str_replace(' ', '_', $h->judul_posting ).'.HTML">'.$h->judul_posting.' </a>
				';
				}
			}
			else{
				if ($xx == 0){
					$hasil .= '
						<li> <span class="'.$h->icon.' "> <a style="color: #e3e3e3;" href="'.base_url().'postings/categoris/'.$h->id_posting.'/'.str_replace(' ', '_', $h->judul_posting ).'.HTML">'.$h->judul_posting.'</a> </span>
					';
				}
				else{
				$hasil .= '
					<li class="parent" > <span class="'.$h->icon.' ">'.$h->judul_posting.' </span>
				';
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