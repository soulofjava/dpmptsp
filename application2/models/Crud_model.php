<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
	
  function kegiatan_skpd_verifikasi_dokumen($table_name, $where)
	{
		$this->db->select('*');
    $this->db->where($where);
		$result = $this->db->get($table_name);
		return $result->result_array();
	}
  
	function dateBahasaIndo($date){
	$bulan=array(
			'01'=>'Januari',
			'02'=>'Februari',
			'03'=>'Maret',
			'04'=>'April',
			'05'=>'Mei',
			'06'=>'Juni',
			'07'=>'Juli',
			'08'=>'Agustus',
			'09'=>'September',
			'10'=>'Oktober',
			'11'=>'November',
			'12'=>'Desember',
		);
		$pecah=explode('-',$date);
		$tgl=$pecah[2];
		$bln=$pecah[1];
		$thn=$pecah[0];
		return $tgl.' '.$bulan[$bln].' '.$thn;
	}

	function opsi($where, $table_name, $fields, $order_by){
		$this->db->select("$fields");
		$this->db->where($where);
		$this->db->order_by($order_by);
		return $this->db->get($table_name);
	}

	public function json($where, $limit, $start, $table_name, $fields, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }

	public function json_join($where, $limit, $start, $table_name, $fields, $order_by) {
		$this->db->select("
		$fields
		");
		$this->db->join('users', 'users.id_users=operator.id_users');
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function get_by_id($table_name, $where, $fields, $order_by) {
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function seperti($table_name, $where, $fields, $order_by, $like_data) {
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->like($like_data);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function get_by_id_join($table_name, $where, $fields, $order_by) {
		$this->db->select("$fields");
		$this->db->join('users', 'users.id_users=operator.id_users');
    $this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
  function check_before_save($table_name, $where)
	{
		$this->db->select('*');
    	$this->db->where($where);
		$result = $this->db->get($table_name);
		return $result->result_array();
	}
		
  function save_data($data_input, $table_name)
	{
		$this->db->insert( $table_name, $data_input );
		return $this->db->insert_id();
	}
		
  function update_data($data_update, $where, $table_name)
	{
		$this->db->where($where);
		$this->db->update($table_name, $data_update);
	}
	
	function semua_data($where, $table_name) {	
		$this->db->from($table_name);
		$this->db->where($where);
		return $this->db->count_all_results(); 
	}	
	
	function like_data($where, $table_name, $like_data) {	
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->like($like_data);
		return $this->db->count_all_results(); 
	}	
	
	function count_search($where, $key_word, $table_name, $field) {	
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->like($field, $key_word);
		return $this->db->count_all_results(); 
	}
		
	public function search($table_name, $fields, $where, $limit, $start, $field_like, $key_word, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		$this->db->like($field_like, $key_word);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }	
		
	public function search_join($table_name, $fields, $where, $limit, $start, $field_like, $key_word, $order_by) {
		$this->db->select("
		$fields
		");
		$this->db->join('users', 'users.id_users=operator.id_users');
    $this->db->where($where);
		$this->db->like($field_like, $key_word);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }

	public function json_buku_kategori_buku($where) {
		$this->db->select("
		kategori_buku.kategori_buku_nama,
		buku_kategori_buku.id_buku_kategori_buku
		");
		$this->db->join('users', 'users.id_users=operator.id_users');
    $this->db->where($where);
		$this->db->order_by('kategori_buku.kategori_buku_nama');
		$result = $this->db->get('buku_kategori_buku');
		return $result->result_array();
    }
	
}