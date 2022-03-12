<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_model extends CI_Model{
	function opsi($table_name, $where, $fields, $order_by){
		$this->db->select($fields);
		$this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
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
	public function html_all($table, $where, $limit, $start, $fields, $orderby, $keyword){
    $this->db->select("$fields");
    if($keyword <> ''){
      $this->db->like($orderby, $keyword);
    }
    $this->db->where($where);
    $this->db->order_by($orderby);
    $this->db->limit($limit, $start);
    return $this->db->get($table);
    }
	public function get_by_id($table_name, $where, $fields, $order_by) {
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
  function save_data($data_input, $table_name){
		$this->db->insert( $table_name, $data_input );
		return $this->db->insert_id();
	}
  function update_data($data_update, $where, $table_name){
		$this->db->where($where);
		$this->db->update($table_name, $data_update);
	}
	function TanggalBahasaIndo($date){
		$bulan=array(
				'00'=>'',
				'01'=>'Jan',
				'02'=>'Feb',
				'03'=>'Mar',
				'04'=>'Apr',
				'05'=>'Mei',
				'06'=>'Jun',
				'07'=>'Jul',
				'08'=>'Agu',
				'09'=>'Sep',
				'10'=>'Okt',
				'11'=>'Nov',
				'12'=>'Des',
			);
			$pecah=explode('-',$date);
			$sisa1=$pecah[2];
			$bln=$pecah[1];
			$thn=$pecah[0];

			$pecah=explode(' ',$sisa1);
			$tanggal=$pecah[0];

			return $tanggal.' '.$bulan[$bln].' '.$thn;
	}
	function TanggalLengkapBahasaIndo($date){
		$bulan=array(
				'00'=>'',
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
			$sisa1=$pecah[2];
			$bln=$pecah[1];
			$thn=$pecah[0];

			$pecah=explode(' ',$sisa1);
			$tanggal=$pecah[0];

			return $tanggal.' '.$bulan[$bln].' '.$thn;
	}
}