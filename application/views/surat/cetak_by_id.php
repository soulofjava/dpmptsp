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
      <div class="col-md-12">
        <div class="box">
          <div class="box-body table-responsive">
            <table class="table table-bordered table-hover">
              <tbody>
                <tr>
                  <td colspan="2">
                      <h1>Agenda <?php if(!empty( $nama_kelembagaan )){ echo $nama_kelembagaan; } ?> <?php if(!empty( $nama_desa )){ echo $nama_desa; } ?></h1>
                      <p>Alamat : <?php if(!empty( $alamat )){ echo $alamat; } ?></p>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <center>
                      <h1>LEMBAR DISPOSISI</h1>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    Indeks Berkas : <?php if(!empty( $nomor_surat )){ echo $nomor_surat; } ?> Kode : <?php if(!empty( $kode_klasifikasi )){ echo $kode_klasifikasi; } ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    Tanggal/Nomor : <?php if(!empty( $tanggal_surat )){ echo $tanggal_surat; } ?> / <?php if(!empty( $nomor_surat )){ echo $nomor_surat; } ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    Asal Surat : <?php if(!empty( $asal_surat )){ echo $asal_surat; } ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    Isi Ringkas : <?php if(!empty( $isi_ringkasan )){ echo $isi_ringkasan; } ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    Diterima Tanggal : <?php if(!empty( $tanggal_surat )){ echo $tanggal_surat; } ?> No. Agenda ( <?php if(!empty( $nomor_agenda )){ echo $nomor_agenda; } ?> )
                  </td>
                </tr>
                  <?php
                    $where = array(
                      'disposisi_surat.status !=' => 99,
                      'disposisi_surat.id_surat' => $id_surat
                      );
                    $this->db->where($where);
                    $this->db->limit(1);
                    $query = $this->db->get('disposisi_surat');
                    foreach ($query->result() as $row)
                      {
                        echo'
                <tr>
                  <td colspan="2">
                        Tanggal Penyelesaian : '.$row->batas_waktu.'
                  </td>
                </tr>
                <tr>
                  <td>
                    Isi Disposisi : '.$row->isi_disposisi.'
                  </td>
                  <td>
                    Diteruskan kepada :<br />
                    ';
                    $where_tujuan = array(
                      'disposisi_surat.status !=' => 99,
                      'disposisi_surat.id_surat' => $id_surat
                      );
                    $this->db->where($where_tujuan);
                    $query_tujuan = $this->db->get('disposisi_surat');
                    $no=0;
                    foreach ($query_tujuan->result() as $row_tujuan)
                      {
                        $no=$no+1;
                        echo''.$no.'. '.$row_tujuan->tujuan_disposisi.'<br />';
                      }
                  echo'
                  </td>
                </tr>
                        ';
                      }
                  ?>
                <tr>
                  <td colspan="2">
                    Sesudah digunakan harap dikembalikan<br />
                    Kepada : ........................................................................................................................................<br />
                    Tanggal : ........................................................................................................................................<br />
                  </td>
                </tr>
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