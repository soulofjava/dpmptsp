<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller
{
  
  function __construct()
  {
  parent::__construct();
  $this->load->library('upload', 'image_lib');
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->library('Bcrypt');
  $this->load->model('Crud_model');
  $this->load->model('Spare_part_model');
  $this->load->helper('file');
  }
	
	public function index()
  {
		echo 'ok';
  }
	
	public function grab()
  {
    $q = $this->input->get('q');
    $merk = $this->input->get('merk');
    $seri = $this->input->get('seri');
    echo '<h1>'.strtoupper($merk).' '.strtoupper($seri).'</h1>';
		$a = file_get_contents("http://www.icatalog.ikhlasin.com/load.php?q=".$q."");
    echo $a;
    $aHTML = explode("<tr>", $a);
    echo '<table border="1">';
    foreach ($aHTML AS $nPos => $cPanel) {
      if ($nPos > 0) {
        $aPanel = explode("</tr>", $cPanel);
        //echo "<tr>" . $aPanel[0] . "</tr>";
        echo '<tr>';
        $a1HTML = explode("<td>", $aPanel[0]);
        foreach ($a1HTML AS $n1Pos => $c1Panel) {
          
          if ($n1Pos > 0) {
            $a1Panel = explode("</td>", $c1Panel);
            echo "<td>";
            if($n1Pos == 1){
              $kode = $a1Panel[0];
              echo ' || kode : '.$kode.'';
            }
            if($n1Pos == 2){
              $namaresmi = $a1Panel[0];
              echo ' || namaresmi : '.$namaresmi.'';
            }
            if($n1Pos == 3){
              $harga = $a1Panel[0];
              echo ' || harga : '.$harga.'';
            }
            if($n1Pos == 4){
              $aktif = $a1Panel[0];
              echo ' || aktif : '.$aktif.'';
            }
            if($n1Pos == 5){
              $superset = $a1Panel[0];
              echo ' || superset : '.$superset.'';
            }
            if($n1Pos == 6){
              $namapasar = $a1Panel[0];
              echo ' || namapasar : '.$namapasar.'';
            }
            echo "</td>";
          }
          $np = ''.strtoupper($merk).' '.strtoupper($seri).' '.strtoupper($namapasar).'';
          $nr = ''.strtoupper($merk).' '.strtoupper($seri).' '.strtoupper($namaresmi).'';
          $data_input = array(
			
            'kode_spare_part' => trim($kode),
            'nama_spare_part' => trim($np),
            'nama_spare_part_inggris' => trim($nr),
            'harga_jual' => trim($this->input->post('harga_jual')),
            'temp' => trim(date('Ymdhis')),
            'created_by' => 1,
            'created_time' => date('Y-m-d H:i:s'),
            'status' => 1
                    
            );
          $table_name = 'spare_part';
          $where = array(
            'nama_spare_part' => $np
            );
          $this->db->from('spare_part');
          $this->db->where($where);
          $a = $this->db->count_all_results();
          if($a == 0){
            $id         = $this->Spare_part_model->simpan_spare_part($data_input, $table_name);
            echo "<td>".$id."</td>";
            //echo "<td>Baru</td>";
          }
          else{
            echo "<td>Sudah Ada</td>";
          }
        }
        echo '</tr>';
      }
    }
    echo '</table>';
  }
	
  public function do_upload_xlsx()
		{
      $config['upload_path'] = './media/upload/';
			$config['allowed_types'] = '*';
			$config['max_size']	= '50000';
			$this->upload->initialize($config);
			$uploadFiles = array('img_1' => 'myfile', 'img_2' => 'e_myfile', );		
			$this->load->library('image_lib');
			$newName = '-';
			$table_name = 'upload_xlsx';
			$temp = date('Ymdhis');
      $keterangan = $this->input->post('remake');
			$this->form_validation->set_rules('remake', 'remake', 'required');
			if ($this->form_validation->run() == FALSE)
				{
					echo 'Error';
				}
			else
				{
					foreach($uploadFiles as $key => $files)
					{
					if ($this->upload->do_upload($files)) 
						{
							$upload = $this->upload->data();
							$file = explode(".", $upload['file_name']);
							$prefix = date('Ymdhis');
							$newName =$prefix.'_'.$file[0].'.'. $file[1]; 
							$filePath =  $upload['file_path'].$newName;
							rename($upload['full_path'],$filePath);
							echo $newName;
						}
					}
				}
		}
  
	public function read_xls_file_on_dir()
  {
    //20170705100946_harga2.xlsx
  //$nama_file = '20170705100946_harga2.xlsx';
  $nama_file = $this->input->post('nama_file');
  $this->load->library('excel');
	$objPHPExcel = PHPExcel_IOFactory::load("./media/upload/$nama_file");
  echo '<table border="1">';
  echo '<tr>';
  echo '<td>No</td>';
  echo '<td>Merek Motor</td>';
  echo '<td>Seri</td>';
  echo '<td>Part Number</td>';
  echo '<td>Nama Resmi</td>';
  echo '<td>Nama Pasaran</td>';
  echo '</tr>';
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    for ($row = 1; $row <= $highestRow; ++ $row) {
      for ($col = 0; $col < $highestColumnIndex; ++ $col) {
        $cell = $worksheet->getCellByColumnAndRow($col, $row);
        $val = $cell->getValue();
        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
        //echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
        //echo '<td>' . $val . '-'.$col.'</td>';
      }
      for ($row = 1; $row <= $highestRow; ++ $row) {
        $val=array();
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
          $cell = $worksheet->getCellByColumnAndRow($col, $row);
          $val[] = $cell->getValue();
        }
        echo '<tr>';    
        $ColA = trim($val[0]);
        $ColB = trim($val[1]);
        $ColC = trim($val[2]);
        $ColD = trim($val[3]);
        $ColE = trim($val[4]);
        echo '<td>'.$row.'</td>';
        echo '<td>'.$ColA.'</td>';
        echo '<td>'.$ColB.'</td>';
        echo '<td>'.$ColC.'</td>';
        echo '<td>'.$ColD.'</td>';
        echo '<td>'.$ColE.'</td>';
        $DataDesa = array(
          'kode_desa'=>$ColB,
          'nama_desa'=>$ColA,
        );
        $where = array(
          'nama_desa'=>$ColA,
          'status'=>1,
          'id_kecamatan'=>$this->input->post('id_kecamatan')
        );
        //$this->db->where($where);
        //$this->db->from('desa');
        //$JDesa = $this->db->count_all_results();
         /* if($JDesa == 0){
           //$this->db->insert('desa', $DataDesa);
           echo '<td>OK</td>';
         }
         else{
           echo '<td>NOK</td>';
         } */
        echo '</tr>';
      }
    }
	}
  echo '</table>';
  }
  
  public function upload_xlsx()
  {
  $data['main_view'] = 'tools/upload_xlsx';
  $this->load->view('back_bone', $data);
  }
	
} 