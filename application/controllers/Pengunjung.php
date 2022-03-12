<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pengunjung extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    // $this->load->library('fpdf');
    $this->load->library('Bcrypt');
    $this->load->library('Excel');
    $this->load->model('Crud_model');
    $this->load->model('Pengunjung_model');
    $this->load->model('Komponen_model');
    $this->load->model('Posting_model');
  }

  private function menu_atas($parent = NULL, $hasil, $a)
  {
    $a = $a + 1;
    $w = $this->db->query("
		SELECT * from posting
									
		where posisi='menu_atas'
    and parent='" . $parent . "' 
    and tampil_menu = 1 
		and status = 1 order by urut
		");
    $x = $w->num_rows();

    if (($w->num_rows()) > 0) {
      if ($parent == 0) {
        $hasil .= '
<ul id="hornavmenu" class="nav navbar-nav" > <li><a href="' . base_url() . '" class="fa-home ">HOME</a></li>';
      } else {
        $hasil .= '
<ul> ';
      }
    }
    $nomor = 0;
    foreach ($w->result() as $h) {

      $r = $this->db->query("
		SELECT * from posting
									
		where parent='" . $h->id_posting . "' 
		and status = 1 order by urut
		");
      $xx = $r->num_rows();

      $nomor = $nomor + 1;
      if ($a > 1) {
        $hasil .= '
<li> <a href="' . base_url() . 'postings/detail/' . $h->id_posting . '/' . str_replace(' ', '_', $h->judul_posting) . '.HTML">' . $h->judul_posting . ' </a>';
      } else {
        if ($xx == 0) {
          $hasil .= '
<li> <span class="' . $h->icon . ' "> <a href="' . base_url() . 'postings/detail/' . $h->id_posting . '/' . str_replace(' ', '_', $h->judul_posting) . '.HTML">' . $h->judul_posting . '</a> </span>';
        } else {
          if ($h->judul_posting == 'BERITA') {
            $hasil .= '<li><a href="' . base_url() . 'posting/galeri/' . $h->id_posting . '/' . $h->judul_posting . '.HTML"> <span class=""> ' . $h->judul_posting . ' </span> </a>';
          } else {
            $hasil .= '<li class="parent" > <span class="' . $h->icon . ' ">' . $h->judul_posting . ' </span>';
          }
        }
      }

      $hasil = $this->menu_atas($h->id_posting, $hasil, $a);
      $hasil .= '</li>';
    }
    if (($w->num_rows) > 0) {
      $hasil .= "
</ul>";
    } else {
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
    if (!$d) {
      return '';
    } else {
      return $d['isi_komponen'];
    }
  }

  public function get_attachment_by_id_posting($id_posting)
  {
    $where = array(
      'id_tabel' => $id_posting
    );
    $d = $this->Posting_model->get_attachment_by_id_posting($where);
    if (!$d) {
      return 'blankgambar.jpg';
    } else {
      return $d['file_name'];
    }
  }

  private function posting_highlight($parent, $hasils, $r)
  {

    $r = $r + 1;
    $w = $this->db->query("
    
    SELECT * from posting
		where parent='" . $parent . "' 
		and posting.status = 1 
    
    order by urut desc
    
    
		");
    $x = $w->num_rows();
    $nomor = 0;
    foreach ($w->result() as $h) {
      $nomor = $nomor + 1;
      $rs = $this->db->query("
		SELECT * from posting
									
		where parent='" . $h->id_posting . "'
    
    
		");
      $xx = $rs->num_rows();
      if ($h->highlight == 1) {

        $hasils .=
          '
            <li class="portfolio-item col-sm-4 col-xs-6 margin-bottom-40">
                <a href="' . base_url() . 'postings/detail/' . $h->id_posting . '/' . $h->judul_posting . '">
                    <figure class="animate fadeIn">
                        <img alt="' . $h->id_posting . '" src="' . base_url() . 'media/upload/' . $this->get_attachment_by_id_posting($h->id_posting) . '">
                        <figcaption>
                            <h3>' . $h->judul_posting . '</h3>
                            <span>' . substr(strip_tags($h->isi_posting), 0, 100) . '</span>
                        </figcaption>
                    </figure>
                </a>
            </li>
            ';
      }

      $hasils = $this->posting_highlight($h->id_posting, $hasils, $r);
    }
    return $hasils;
  }

  public function index()
  {
    $data['welcome1'] = $this->get_komponen('welcome1');
    $data['welcome2'] = $this->get_komponen('welcome2');
    $data['disclaimer'] = $this->get_komponen('disclaimer');
    $data['data_link_bawah'] = $this->get_komponen('data_link_bawah');
    $data['kontak_detail'] = $this->get_komponen('kontak_detail');
    $data['slide_show'] = $this->get_komponen('slide_show');

    $r = 0;
    $p = 0;
    $data['galery_berita'] = $this->posting_highlight($p, $q = "", $r);
    $a = 0;
    $data['total'] = 10;
    $data['menu_atas'] = $this->menu_atas(0, $h = "", $a);
    $data['main_view'] = 'pengunjung/home';
    $this->load->view('pengunjung_depan', $data);
  }
}
