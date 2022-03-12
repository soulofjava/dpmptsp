<?php

class Login_model extends CI_Model {
    
	function __construct() {
        parent::__construct();
    }
  
  function update_last_login($data_update, $where)
	{
		$this->db->where($where);
		$this->db->update('users', $data_update);
	}
	
  function get_login($where = array())
	{
		$this->db->select('*');
    $this->db->from('users');
    $this->db->where($where);
		return $this->db->get()->row_array();
	}
	
  function get_login_users($where = array())
	{
		$this->db->select('
			users.id_users,
			users.user_name,
			users.email,
			users.nama,
			users.hak_akses,
			users.id_puskesmas,
			users.id_lokasi_pemeriksaan,
			users.id_puskesmas_bagian,
			users.status,
			attachment.nama_file as nama_foto,
			attachment.id_attachment as id_foto,
			');
		$this->db->join('attachment', 'attachment.id_attachment = users.id_attachment', 'left');
    $this->db->from('users');
    $this->db->where($where);
		return $this->db->get()->row_array();
	}
  
} 