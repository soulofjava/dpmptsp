<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php if(!empty( $title )){ echo $title; } ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://diskominfo.wonosobokab.go.id/assets/dist/css/adminlte.min.css">

  <link href="https://fonts.googleapis.com/css?family=Arial" rel="stylesheet">
  <!-- 
	-->
<style>
  	body {
		font-family: 'Roboto Mono', serif;
		font-size: 18px;
  	}
	hr {
		border-width: 4px;
		background-color: #000;
	} 
</style>
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
  	<div class="row">
			<?php // $this -> load -> view($main_view);  ?>
      <?php
        $web=$this->uut->namadomain(base_url());
        $page    = $this->input->get('page');
        $limit    = $this->input->get('limit');
        $keyword    = $this->input->get('keyword');
        $order_by    = $this->input->get('orderby');
        $id_kelembagaan = $this->input->get('id_kelembagaan');
        $jenis_surat = $this->input->get('jenis_surat');
        $start      = ($page - 1) * $limit;
        $this->db->select('
            id_surat,
            nomor_agenda,
            asal_surat,
            nomor_surat,
            isi_ringkasan,
            kode_klasifikasi,
            tanggal_surat,
            id_kelembagaan,
            jenis_surat,
            keterangan,
            (select kelembagaan.nama_kelembagaan from kelembagaan where kelembagaan.id_kelembagaan=surat.id_kelembagaan) as nama_kelembagaan
        ');
          $where = array(
            'surat.status !=' => 99,
            'surat.domain=' => $web,
            'surat.id_kelembagaan' => $id_kelembagaan,
            'surat.jenis_surat' => $jenis_surat
            );
          $this->db->where($where);
          $this->db->order_by(''.$order_by.'');
          $this->db->limit($limit, $start);
          $query = $this->db->get('surat');
          echo'
                        <div class="col-md-12">
                          <center>
                            <h1>Agenda ';if($jenis_surat=='surat_masuk'){echo'Surat Masuk';}else{echo'Surat Keluar';}echo'</h1>
                            <h3>';
                            if(!empty( $nama_kelembagaan )){ echo $nama_kelembagaan; } if(!empty( $nama_desa )){ echo ' '.$nama_desa.''; }
                            echo'</h3>
                            <h4><i>Alamat : ';if(!empty( $alamat )){ echo $alamat; }echo'</i></h4>
                          </center>
                          <div class="box">
                            <div class="box-body table-responsive">
                              <table class="table table-bordered table-hover">
                                <tr>
                                  <th>No/Kode</th>
                                  <th>Isi Ringkasan, File</th>
                                  <th>Asal Surat</th>
                                  <th>Nomor, Tgl. Surat</th>
                                </tr>
                                <tbody>
          ';
          $urut=$start;
          foreach ($query->result() as $row)
            {
              $urut=$urut+1;
              echo'
                <tr>
                  <td>'.$row->nomor_agenda.'/'.$row->kode_klasifikasi.'</td>
                  <td>'.$row->isi_ringkasan.'<br />';
                              $where_attachment = array(
                                'id_tabel' => $row->id_surat,
                                'table_name' => 'surat'
                                );
                              $this->db->where($where_attachment);
                              $query_attachment = $this->db->get('attachment');
                              foreach ($query_attachment->result()as $row_attachment){echo'<a href="'.base_url().'media/upload/'.$row_attachment->file_name.'"><i class="fa fa-paperclip"></i> '.$row_attachment->keterangan.'</a>';}
                  echo'</td>
                  <td>'.$row->asal_surat.'</td>
                  <td>'.$row->nomor_surat.'<br />'.$this->Surat_model->TanggalBahasaIndo($row->tanggal_surat).'</td>
                </tr>
                ';
            }
            ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
		</div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>