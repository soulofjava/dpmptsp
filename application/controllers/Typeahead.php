<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Typeahead extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
  
  public function index()
		{
		}
  
  public function search_sungai()
		{
		$q = $_GET['q'];
		if(empty($_GET['q']))
		{
				exit;
		}
		if( strlen($q) > 2)
			{
        $this->db->select("
          sungai.id_sungai,
          sungai.kode_sungai,
          sungai.nama_sungai,,
          sungai.nama_sungai as value
          ");
        $this->db->like('sungai.nama_sungai', $q);
        $this->db->order_by('nama_sungai');
        $result = $this->db->get('sungai');
        echo json_encode( $result->result_array() );
			}
		}
    
  public function search_mata_air()
		{
		$q = $_GET['q'];
		if(empty($_GET['q']))
		{
				exit;
		}
		if( strlen($q) > 2)
			{
        $this->db->select("
          mata_air.id_mata_air,
          mata_air.kode_mata_air,
          mata_air.nama_mata_air,,
          mata_air.nama_mata_air as value
          ");
        $this->db->like('mata_air.nama_mata_air', $q);
        $this->db->order_by('nama_mata_air');
        $result = $this->db->get('mata_air');
        echo json_encode( $result->result_array() );
			}
		}
  
  public function search_suplier()
		{
		$q = $_GET['q'];
		if(empty($_GET['q']))
		{
				exit;
		}
		if( strlen($q) > 2)
			{
        $this->db->select("
          suplier.id_suplier,
          suplier.kode_suplier,
          suplier.nama_suplier,,
          suplier.nama_suplier as value
          ");
        $this->db->like('suplier.nama_suplier', $q);
        $this->db->order_by('nama_suplier');
        $result = $this->db->get('suplier');
        echo json_encode( $result->result_array() );
			}
		}
  
  public function search_spare_part()
		{
		$q = $_GET['q'];
		if(empty($_GET['q']))
		{
				exit;
		}
		if( strlen($q) > 2)
			{
        $this->db->select("
          spare_part.id_spare_part,
          spare_part.kode_spare_part,
          spare_part.nama_spare_part,
          spare_part.harga_jual,
          spare_part.nama_spare_part as value
          ");
        $this->db->like('spare_part.nama_spare_part', $q);
        $this->db->or_like('spare_part.kode_spare_part', $q);
        $this->db->order_by('nama_spare_part');
        $result = $this->db->get('spare_part');
        echo json_encode( $result->result_array() );
			}
		}
  
  public function search_klien()
		{
		$q = $_GET['q'];
		if(empty($_GET['q']))
		{
				exit;
		}
		if( strlen($q) > 2)
			{
        $this->db->select("
          klien.id_klien,
          klien.kode_klien,
          klien.nama_klien,,
          klien.nama_klien as value
          ");
        $this->db->like('klien.nama_klien', $q);
        $this->db->order_by('nama_klien');
        $result = $this->db->get('klien');
        echo json_encode( $result->result_array() );
			}
		}
  
  public function search_debet_kredit()
		{
		$q = $_GET['q'];
		if(empty($_GET['q']))
		{
				exit;
		}
		if( strlen($q) > 2)
			{
        $this->db->select("
          debet_kredit.id_debet_kredit,
          debet_kredit.kode_transaksi,
          debet_kredit.nama_transaksi,
          debet_kredit.nilai_transaksi,
          debet_kredit.nama_transaksi as value
          ");
        $this->db->like('debet_kredit.nama_transaksi', $q);
        $this->db->or_like('debet_kredit.kode_transaksi', $q);
        $this->db->order_by('nama_transaksi');
        $result = $this->db->get('debet_kredit');
        echo json_encode( $result->result_array() );
			}
		}
    
}