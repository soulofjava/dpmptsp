<?php
    $web=$this->uut->namadomain(base_url());
    $id_kelembagaan = trim($this->input->get('id_kelembagaan'));
    $jenis_surat = trim($this->input->get('jenis_surat'));
    $where0 = array(
      'surat.status !=' => 99,
      'surat.domain' => $web,
      'surat.jenis_surat' => $jenis_surat,
      'surat.id_kelembagaan' => $id_kelembagaan
      );
    $this->db->where($where0);
    $query0 = $this->db->get('surat');
    $a= $query0->num_rows();
    $nomor_agenda=$a+1;
?>
      <section class="content-header">
        <h1>
          <?php if($jenis_surat=='surat_masuk'){echo'Surat Masuk';}else{echo'Surat Keluar';} ?>
          <small>1.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i>Buku Agenda</a></li>
          <li class="active"><?php if($jenis_surat=='surat_masuk'){echo'Surat Masuk';}else{echo'Surat Keluar';} ?></li>
        </ol>
      </section>
<section class="content" id="awal">
		<!-- Custom Tabs -->
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#tab_form_surat" id="klik_tab_input">Form</a> <span id="demo"></span></li>
				<li><a href="#tab_data_surat" data-toggle="tab" id="klik_tab_data_surat">Rekap Data</a></li>
        <li><a href="<?php echo base_url(); ?>surat/?id_kelembagaan=<?php echo $id_kelembagaan; ?>&jenis_surat=<?php echo $jenis_surat; ?>"><i class="fa fa-refresh"></i></a></li>
				<li class="dropdown" style="display:none;">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						Dropdown <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
						<li role="presentation" class="divider"></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
					</ul>
				</li>
				<li class="pull-right" style="display:none;"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_form_surat">
					<input name="tabel" id="tabel" value="surat" type="hidden" value="">
          <form role="form" id="form_isian" method="post" action="<?php echo base_url(); ?>attachment/upload/?table_name=surat" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                  <input name="page" id="page" value="1" type="hidden" value="">
									<input class="form-control" id="temp" name="temp" value="" placeholder="temp" type="hidden">
									<input class="form-control" id="mode" name="mode" value="input" placeholder="mode" type="hidden">
                  <div class="form-group" style="display:none;">
                    <label for="id_surat">id_surat</label>
                    <input class="form-control" id="id_surat" name="id" value="" placeholder="id_surat" type="text">
                  </div>
                  <div class="form-group" style="display:none;">
                    <label for="id_kelembagaan">id_kelembagaan</label>
                    <input class="form-control" id="id_kelembagaan" name="id_kelembagaan" value="<?php echo $id_kelembagaan; ?>" placeholder="id_kelembagaan" type="text">
                  </div>
                  <div class="form-group" style="display:none;">
                    <label for="jenis_surat">jenis_surat</label>
                    <input class="form-control" id="jenis_surat" name="jenis_surat" value="<?php echo $jenis_surat; ?>" placeholder="jenis_surat" type="text">
                  </div>
                  <div class="form-group">
                    <label for="nomor_agenda">Nomor Agenda</label>
                    <input class="form-control" id="nomor_agenda" name="nomor_agenda" value="<?php echo '00'.$nomor_agenda.''; ?>" placeholder="nomor_agenda" type="text">
                  </div>
                  <div class="form-group">
                    <label for="asal_surat">Asal Surat</label>
                    <input class="form-control" id="asal_surat" name="asal_surat" value="" placeholder="asal_surat" type="text">
                  </div>
                  <div class="form-group">
                    <label for="nomor_surat">Nomor Surat</label>
                    <input class="form-control" id="nomor_surat" name="nomor_surat" value="" placeholder="nomor_surat" type="text">
                  </div>
                  <div class="form-group">
                    <label for="kode_klasifikasi">Kode Klasifikasi</label>
                    <input class="form-control" id="kode_klasifikasi" name="kode_klasifikasi" value="" placeholder="kode_klasifikasi" type="text">
                  </div>
                  <div class="form-group">
                    <label for="tanggal_surat">Tanggal Surat</label>
                    <input class="form-control" id="tanggal_surat" name="tanggal_surat" value="" placeholder="tanggal_surat" type="text">
                  </div>
                  <div class="form-group">
                    <label for="sifat_surat">Sifat Surat</label>
                    <select class="form-control" id="sifat_surat" name="sifat_surat">
                      <option value="">- Pilih Sifat Surat -</option>
                      <option value="Penting">Penting</option>
                      <option value="Segera">Segera</option>
                      <option value="Biasa">Biasa</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="isi_ringkasan">Isi Ringkasan (Perihal Surat)</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="isi_ringkasan" name="isi_ringkasan"></textarea>
                  </div>
                  <div class="form-group" style="display: none;">
                    <label for="keterangan">Keterangan Surat</label>
                    <input class="form-control" id="keterangan" name="keterangan" value="" placeholder="Ketrangan Surat" type="text">
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="unit_pengolah_surat">Unit Pengolah Surat</label>
                    <input class="form-control" id="unit_pengolah_surat" name="unit_pengolah_surat" value="" placeholder="Unit Pengolah Surat" type="text">
                  </div>
                  <div class="form-group">
                    <label for="status_surat">Status Surat</label>
                    <select class="form-control" id="status_surat" name="status_surat">
                      <option value="">- Pilih Status Surat -</option>
                      <option value="Sedian">Sedian</option>
                      <option value="Turun">Turun</option>
                      <option value="Selesai">Biasa</option>
                    </select>
                  </div>
                    <div class="alert alert-info alert-dismissable">
                      <div class="form-group" style="display:none;">
                        <label for="remake">Keterangan Lampiran </label>
                        <input class="form-control" id="remake" name="remake" value="File Surat" placeholder="Keterangan Lampiran " type="text">
                      </div>
                      <div class="form-group">
                        <label for="myfile">File Lampiran </label>
                        <input type="file" size="60" name="myfile" id="file_lampiran" >
                      </div>
                      <div id="ProgresUpload">
                        <div id="BarProgresUpload"></div>
                        <div id="PersenProgresUpload">0%</div >
                      </div>
                      <div id="PesanProgresUpload"></div>
                    </div>
                    <div class="alert alert-info alert-dismissable">
                      <h3 class="box-title">Data Lampiran </h3>
                      <table class="table table-bordered">
                        <tr>
                          <th>No</th><th>Keterangan</th><th>Download</th><th>Hapus</th> 
                        </tr>
                        <tbody id="tbl_attachment_surat">
                        </tbody>
                      </table>
                    </div>
                    <button type="submit" class="btn btn-primary" id="simpan_surat">SIMPAN</button>
                    <button type="submit" class="btn btn-primary" id="update_surat" style="display:none;">UPDATE</button>
                  </div>
            </div>
          </form>
          <div class="overlay" id="overlay_form_input" style="display:none;">
            <i class="fa fa-refresh fa-spin"></i>
          </div>
				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_data_surat">
							<div class="row">
								<div class="col-md-12">
									<div class="box-body">
										<div class="box-tools">
											<div class="input-group">
												<input name="keyword" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" type="text" id="keyword">
												<select name="limit" class="form-control input-sm pull-right" style="width: 150px;" id="limit">
													<option value="999999999">Semua</option>
													<option value="10">10 Per-Halaman</option>
													<option value="50">50 Per-Halaman</option>
													<option value="100">100 </option>
												</select>
												<select name="orderby" class="form-control input-sm pull-right" style="width: 150px;" id="orderby">
													<option value="surat.asal_surat">Asal Surat</option>
												</select>
												<div class="input-group-btn">
													<button class="btn btn-sm btn-default" id="tampilkan_data_surat"><i class="fa fa-search"></i> Tampil</button>
												</div>
											</div>
										</div>
									</div>
									<div class="box-footer table-responsive no-padding">
										<table class="table table-bordered table-hover">
											<thead class="bg-gray">
												<tr>
													<th>NO/Kode</th>
													<th>Isi Ringkasan, File</th>
													<th>Asal Surat</th>
													<th>Nomor, Tgl. Surat</th>
													<th colspan="4">Proses</th>
												</tr>
											</thead>
											<tbody id="tbl_data_surat">
											</tbody>
										</table>
                    <ul class="pagination pagination-sm no-margin pull-right" id="pagination">
                    </ul>
										<div class="overlay" id="spinners_data" style="display:none;">
											<i class="fa fa-refresh fa-spin"></i>
										</div>
									</div>
								</div>
							</div>
				</div>
				<!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
		</div>
		<!-- nav-tabs-custom -->
</section>

<script type="text/javascript">
$(document).ready(function() {
  var tabel = $('#tabel').val();
});
</script>
<script type="text/javascript">
  function paginations(tabel) {
    var limit = $('#limit').val();
    var jenis_surat = $('#jenis_surat').val();
    var id_kelembagaan = $('#id_kelembagaan').val();
    var keyword = $('#keyword').val();
    var orderby = $('#orderby').val();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        limit:limit,
        keyword:keyword,
        orderby:orderby,
        id_kelembagaan:id_kelembagaan,
        jenis_surat:jenis_surat
      },
      dataType: 'text',
      url: '<?php echo base_url(); ?>surat/total_data',
      success: function(text) {
        var jumlah = text;
        $('#pagination').html('');
        var pagination = '';
        for (var a = 0; a < jumlah; a++) {
          pagination += '<li id="' + a + '" page="' + a + '" keyword="' + keyword + '" id_kelembagaan="' + id_kelembagaan + '" jenis_surat="' + jenis_surat + '"><a id="next" href="#">' + (a + 1) + '</a></li>';
        }
        $('#pagination').append(pagination);
      }
    });
  }
</script>
<script type="text/javascript">
  function load_data(tabel) {
    var page = $('#page').val();
    var limit = $('#limit').val();
    var keyword = $('#keyword').val();
    var orderby = $('#orderby').val();
    var id_kelembagaan = $('#id_kelembagaan').val();
    var jenis_surat = $('#jenis_surat').val();
    var tabel = $('#tabel').val();
    $('#page').val(page);
    $('#tbl_data_'+tabel+'').html('');
    $('#spinners_tbl_data_'+tabel+'').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        page:page,
        limit:limit,
        keyword:keyword,
        orderby:orderby,
        id_kelembagaan:id_kelembagaan,
        jenis_surat:jenis_surat
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>'+tabel+'/json_all_'+tabel+'/',
      success: function(html) {
        $('.nav-tabs a[href="#tab_data_'+tabel+'"]').tab('show');
        $('#tbl_data_'+tabel+'').html(html);
        $('#spinners_tbl_data_'+tabel+'').fadeOut('slow');
        paginations(tabel);
      }
    });
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#pagination').on('click', '#next', function(e) {
      e.preventDefault();
      var id = $(this).closest('li').attr('page');
      var page= parseInt(id)+1;
      $('#page').val(page);
      var tabel = $("#tabel").val();
      load_data(tabel);
    });
  });
</script>
<script type="text/javascript" >
  $(document).ready(function () {
    var tabel = $("#tabel").val();
    $("#update_"+tabel+"").on("click", function (e) {
      e.preventDefault();
      update(tabel);
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function() {
    var tabel = $("#tabel").val();
    $('#klik_tab_data_'+tabel+'').on('click', function(e) {
    load_data(tabel);
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var tabel = $("#tabel").val();
    $('#tampilkan_data_'+tabel+'').on('click', function(e) {
    load_data(tabel);
    });
  });
</script>
<script>
  function AfterSavedSurat() {
    $('#id_surat, #nomor_agenda, #asal_surat, #nomor_surat, #isi_ringkasan, #kode_klasifikasi, #tanggal_surat, #jenis_surat, #id_kelembagaan, #keterangan, #sifat_surat, #unit_pengolah_surat, #status_surat').val('');
  }
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#temp').val(Math.random());
});
</script>

<!--lampiran -->

<script>
	function AttachmentByMode(mode, value) {
		$('#tbl_attachment_surat').html('');
		$.ajax({
			type: 'POST',
			async: true,
			data: {
        table:'surat',
				mode:mode,
        value:value
			},
			dataType: 'json',
			url: '<?php echo base_url(); ?>attachment/load_lampiran/',
			success: function(json) {
				var tr = '';
				for (var i = 0; i < json.length; i++) {
					tr += '<tr id_attachment="'+json[i].id_attachment+'" id="'+json[i].id_attachment+'" >';
					tr += '<td valign="top">'+(i + 1)+'</td>';
					tr += '<td valign="top">'+json[i].keterangan+'</td>';
					tr += '<td valign="top"><a href="<?php echo base_url(); ?>media/upload/'+json[i].file_name+'" target="_blank">Download</a> </td>';
					tr += '<td valign="top"><a href="#" id="del_ajax"><i class="fa fa-cut"></i></a> </td>';
					tr += '</tr>';
				}
				$('#tbl_attachment_surat').append(tr);
			}
		});
	}
</script>

<script>
	$(document).ready(function(){
    var options = { 
      beforeSend: function() {
        $('#ProgresUpload').show();
        $('#BarProgresUpload').width('0%');
        $('#PesanProgresUpload').html('');
        $('#PersenProgresUpload').html('0%');
        },
      uploadProgress: function(event, position, total, percentComplete){
        $('#BarProgresUpload').width(percentComplete+'%');
        $('#PersenProgresUpload').html(percentComplete+'%');
        },
      success: function(){
        $('#BarProgresUpload').width('100%');
        $('#PersenProgresUpload').html('100%');
        },
      complete: function(response){
        $('#PesanProgresUpload').html('<font color="green">'+response.responseText+'</font>');
        var mode = $('#mode').val();
        if(mode == 'edit'){
          var value = $('#id_surat').val();
        }
        else{
          var value = $('#temp').val();
        }
        AttachmentByMode(mode, value);
        $('#remake').val('');
        },
      error: function(){
        $('#PesanProgresUpload').html('<font color="red"> ERROR: unable to upload files</font>');
        }     
    };
    document.getElementById('file_lampiran').onchange = function() {
        $('#form_isian').submit();
      };
    $('#form_isian').ajaxForm(options);
  });
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#tbl_attachment_surat').on('click', '#del_ajax', function() {
    var id_attachment = $(this).closest('tr').attr('id_attachment');
    alertify.confirm('Anda yakin data akan dihapus?', function(e) {
      if (e) {
        var parameter = {}
        parameter["id_attachment"] = id_attachment;
        var url = '<?php echo base_url(); ?>attachment/hapus/';
        HapusAttachment(parameter, url);
        var mode = $('#mode').val();
          if(mode == 'edit'){
            var value = $('#id_surat').val();
          }
          else{
            var value = $('#temp').val();
          }
        AttachmentByMode(mode, value);
        $('[id_attachment='+id_attachment+']').remove();
      } else {
        alertify.error('Hapus data dibatalkan');
      }
    });
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#form_baru').on('click', function(e) {
    $('#simpan_surat').show();
    $('#update_surat').hide();
    $('#id_surat, #nomor_agenda, #asal_surat, #nomor_surat, #isi_ringkasan, #kode_klasifikasi, #tanggal_surat, #jenis_surat, #id_kelembagaan, #keterangan, #sifat_surat, #unit_pengolah_surat, #status_surat').val('');
    $('#form_baru').hide();
    $('#mode').val('input');
    $('#judul_formulir').html('FORMULIR INPUT');
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#simpan_surat').on('click', function(e) {
      e.preventDefault();
      var parameter = [ 'nomor_agenda', 'tanggal_surat' ];
			InputValid(parameter);
      
      var parameter = {}
      parameter["nomor_agenda"] = $("#nomor_agenda").val();
      parameter["asal_surat"] = $("#asal_surat").val();
      parameter["nomor_surat"] = $("#nomor_surat").val();
      parameter["isi_ringkasan"] = $("#isi_ringkasan").val();
      parameter["kode_klasifikasi"] = $("#kode_klasifikasi").val();
      parameter["tanggal_surat"] = $("#tanggal_surat").val();
      parameter["jenis_surat"] = $("#jenis_surat").val();
      parameter["id_kelembagaan"] = $("#id_kelembagaan").val();
      parameter["keterangan"] = $("#keterangan").val();
      parameter["sifat_surat"] = $("#sifat_surat").val();
      parameter["unit_pengolah_surat"] = $("#unit_pengolah_surat").val();
      parameter["status_surat"] = $("#status_surat").val();
      parameter["temp"] = $("#temp").val();
      var url = '<?php echo base_url(); ?>surat/simpan_surat';
      
      var parameterRv = [ 'nomor_agenda', 'tanggal_surat' ];
      var Rv = RequiredValid(parameterRv);
      if(Rv == 0){
        alertify.error('Mohon data diisi secara lengkap');
      }
      else{
        SimpanData(parameter, url);
        AfterSavedSurat();
      }
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function() {
  var tabel = $('#tabel').val();
  $('#klik_tab_input').on('click', function(e) {
    e.preventDefault();
    $('#tab_form_'+tabel+' form').trigger('reset');
    $('#judul_form').html('Form Input');
    $('#update_'+tabel+'').hide();
    $('#simpan_'+tabel+'').show();
    $('#temp').val(Math.random());
    $('#mode').val('input');
    $('#PesanProgresUpload').html('');
  });
});
</script>
<script type="text/javascript" >
  $(document).ready(function () {
    var tabel = $("#tabel").val();
    $("#update_"+tabel+"").on("click", function (e) {
      e.preventDefault();
      update(tabel);
    });
  });
</script>
<script type="text/javascript">
  function update(tabel) {
    $('#update_surat').on('click', function(e) {
      e.preventDefault();
      var parameter = [ 'id_surat', 'nomor_agenda' ];
			InputValid(parameter);
      
      var parameter = {}
      parameter["id_surat"] = $("#id_surat").val();
      parameter["nomor_agenda"] = $("#nomor_agenda").val();
      parameter["asal_surat"] = $("#asal_surat").val();
      parameter["nomor_surat"] = $("#nomor_surat").val();
      parameter["isi_ringkasan"] = $("#isi_ringkasan").val();
      parameter["kode_klasifikasi"] = $("#kode_klasifikasi").val();
      parameter["tanggal_surat"] = $("#tanggal_surat").val();
      parameter["jenis_surat"] = $("#jenis_surat").val();
      parameter["id_kelembagaan"] = $("#id_kelembagaan").val();
      parameter["keterangan"] = $("#keterangan").val();
      parameter["sifat_surat"] = $("#sifat_surat").val();
      parameter["unit_pengolah_surat"] = $("#unit_pengolah_surat").val();
      parameter["status_surat"] = $("#status_surat").val();
      var url = '<?php echo base_url(); ?>surat/update_surat';
      
      var parameterRv = [ 'id_surat', 'nomor_agenda' ];
      var Rv = RequiredValid(parameterRv);
      if(Rv == 0){
        alertify.error('Mohon data diisi secara lengkap');
      }
      else{
        SimpanData(parameter, url);
      }
    });
  }
</script>
<script type="text/javascript">
  function load_edit_by_id(id, tabel) {
    $('#judul_form').html('Form Edit');
		$.ajax({
      type: 'POST',
      async: true,
      data: {
        id_surat:id
      },
      dataType: 'json',
      url: '<?php echo base_url(); ?>'+tabel+'/get_by_id/',
      success: function(json) {
        for (var i = 0; i < json.length; i++) {
          $("#id_surat").val(json[i].id_surat);
          $("#nomor_agenda").val(json[i].nomor_agenda);
          $("#asal_surat").val(json[i].asal_surat);
          $("#nomor_surat").val(json[i].nomor_surat);
          $("#isi_ringkasan").val(json[i].isi_ringkasan);
          $("#kode_klasifikasi").val(json[i].kode_klasifikasi);
          $("#tanggal_surat").val(json[i].tanggal_surat);
          $("#keterangan").val(json[i].keterangan);
          $("#sifat_surat").val(json[i].sifat_surat);
          $("#unit_pengolah_surat").val(json[i].unit_pengolah_surat);
          $("#status_surat").val(json[i].status_surat);
          $("#mode").val('edit');
        }
        $('.nav-tabs a[href="#tab_form_surat"]').tab('show');        
        $('#simpan_'+tabel+'').hide();
        $('#update_'+tabel+'').show();
        AttachmentByMode('edit', id, tabel);
        $('#PesanProgresUpload').html('');
      }
    });
  }
</script>
<script type="text/javascript">
$(document).ready(function() {
  var tabel = $("#tabel").val();
  $('#tbl_data_'+tabel+'').on('click', '#update_id', function() {
    var id = $(this).closest('tr').attr('id_'+tabel+'');
    load_edit_by_id(id, tabel);
  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  var tabel = $("#tabel").val();
  $('#tbl_data_'+tabel+'').on('click', '#del_ajax', function() {
    var id_surat = $(this).closest('tr').attr('id_surat');
    alertify.confirm('Anda yakin data akan dihapus?', function(e) {
      if (e) {
        var parameter = {}
        parameter["id_surat"] = id_surat;
        var url = '<?php echo base_url(); ?>'+tabel+'/hapus/';
        HapusData(parameter, url);
        $('[id_surat='+id_surat+']').remove();
      } else {
        alertify.error('Hapus data dibatalkan');
      }
    });
  });
});
</script>

<script type="text/javascript">
  // When the document is ready
  $(document).ready(function() {
    $('#tanggal_surat').datepicker({
      format: 'yyyy-mm-dd',
    }).on('changeDate', function(e) {
      $(this).datepicker('hide');
    });
  });
</script>