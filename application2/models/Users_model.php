<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{

	function opsi($where, $table_name, $fields, $order_by){
		$this->db->select("$fields");
		$this->db->where($where);
		$this->db->order_by($order_by);
		return $this->db->get($table_name);
	}

	public function json_all_users($where, $limit, $start, $fields, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get('users');
		return $result->result_array();
    }

	public function json_join($where, $limit, $start, $table_name, $fields, $order_by) {
		$this->db->select("
		$fields
		");
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
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
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
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
		
  function simpan_users($data_input, $table_name)
	{
		$this->db->insert( $table_name, $data_input );
		return $this->db->insert_id();
	}
		
  function update_data_users($data_update, $where, $table_name)
	{
		$this->db->where($where);
		$this->db->update($table_name, $data_update);
	}
	
	function json_semua_users($where) {	
		$this->db->from('users');
		$this->db->where($where);
		return $this->db->count_all_results(); 
	}	
	
	function like_data($where, $table_name, $like_data) {	
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->like($like_data);
		return $this->db->count_all_results(); 
	}	
	
	function count_all_search_users($where, $key_word, $table_name, $field) {	
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->like($field, $key_word);
		return $this->db->count_all_results(); 
	}
		
	public function search_users($fields, $where, $limit, $start, $key_word, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		$this->db->like('nama_users', $key_word);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get('users');
		return $result->result_array();
    }	
		
	public function search_join($table_name, $fields, $where, $limit, $start, $field_like, $key_word, $order_by) {
		$this->db->select("
		$fields
		");
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
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
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
    $this->db->where($where);
		$result = $this->db->get('buku_kategori_buku');
		return $result->result_array();
    }

	public function json_laborat_perbagian($where) {
		$this->db->select("
		pus_pendaftaran.tanggal_pendaftaran,
		pus_pendaftaran.nomor_pendaftaran,
		bagian_puskesmas.nama_bagian_puskesmas,
		pus_pelayanan.id_pus_pelayanan,
		pasien.nama_penduduk,
		(select COUNT(*) FROM pus_pelayanan_pemeriksaan_laborat where pus_pelayanan_pemeriksaan_laborat.id_pus_pelayanan = pus_pelayanan.id_pus_pelayanan ) AS jumlah,
		(select COUNT(*) FROM pus_pelayanan_pemeriksaan_laborat where (pus_pelayanan_pemeriksaan_laborat.id_pus_pelayanan = pus_pelayanan.id_pus_pelayanan and pus_pelayanan_pemeriksaan_laborat.status = 1 ) ) AS status_pemeriksaan_lab
		");
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
    $this->db->where($where);
		$this->db->order_by('pus_pendaftaran.nomor_pendaftaran');
		$result = $this->db->get('pus_pendaftaran');
		return $result->result_array();
    }

	public function json_obat_perbagian($where) {
		$this->db->select("
		pus_pendaftaran.tanggal_pendaftaran,
		pus_pendaftaran.nomor_pendaftaran,
		bagian_puskesmas.nama_bagian_puskesmas,
		pus_pelayanan.id_pus_pelayanan,
		pasien.nama_penduduk,
		(select COUNT(*) FROM pus_pelayanan_obat where pus_pelayanan_obat.id_pus_pelayanan = pus_pelayanan.id_pus_pelayanan and pus_pelayanan_obat.status = 1 ) AS jumlah,
		(select COUNT(*) FROM pus_pelayanan_obat where (pus_pelayanan_obat.id_pus_pelayanan = pus_pelayanan.id_pus_pelayanan and pus_pelayanan_obat.status = 1 ) ) AS status_pemberian_obat
		");
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
    $this->db->where($where);
		$this->db->order_by('pus_pendaftaran.nomor_pendaftaran');
		$result = $this->db->get('pus_pendaftaran');
		return $result->result_array();
    }

	public function json_detail_obat_per_layanan($where) {
		$this->db->select("
		pus_pelayanan_obat.id_pus_pelayanan_obat,
		pus_pelayanan_obat.price,
		pus_pelayanan_obat.dosis_obat,
		pus_pelayanan_obat.jumlah_obat,
		pus_pelayanan_obat.status,
		obat.nama_obat
		");
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
    $this->db->where($where);
		$this->db->order_by('pus_pelayanan_obat.id_pus_pelayanan_obat');
		$result = $this->db->get('pus_pelayanan_obat');
		return $result->result_array();
    }

	public function show_json_absensi_hari_ini($where, $table_name) {
		$this->db->select("
		absensi.id_absensi,
		absensi.id_users,
		absensi.hari_kerja,
		absensi.jam_absen,
		absensi.login_dari,
		absensi.jam_pulang,
		absensi.logout_dari,
		pegawai.nama_pegawai,
		puskesmas.nama_puskesmas
		");
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
    $this->db->where($where);
		$this->db->order_by('absensi.jam_absen');
		$result = $this->db->get('absensi');
		return $result->result_array();
    }

	public function show_json_absensi_hari_ini_dinas($where, $table_name) {
		$this->db->select("
		absensi.id_absensi,
		absensi.id_users,
		absensi.hari_kerja,
		absensi.jam_absen,
		absensi.login_dari,
		absensi.jam_pulang,
		absensi.logout_dari,
		pegawai.nama_pegawai
		");
		$this->db->join('pekerjaan', 'pekerjaan.id_pekerjaan=anggota_perpus.id_pekerjaan');
    $this->db->where($where);
		$this->db->order_by('absensi.jam_absen');
		$result = $this->db->get('absensi');
		return $result->result_array();
    }
	function auto_suggest($q, $where, $fields) {
		$this->db->select("$fields");
		$this->db->where($where);
		$this->db->like('users.nama_users', $q);
		$this->db->or_like('users.user_name', $q);
		$this->db->limit('20');
		$result = $this->db->get('users');
		return $result->result_array();
	}
	
}