<section class="content" id="awal">
  <div class="row">
    <ul class="nav nav-tabs">
      <li><a data-toggle="tab" href="#tab_1" id="klik_tab_input">Form</a> <span id="demo"></span></li>
      <li class="active"><a data-toggle="tab" href="#tab_2" id="klik_tab_tampil" >Tampil</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane" id="tab_1">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <h3 class="box-title" id="judul_formulir">FORMULIR EDIT</h3>
                
              </div>
              <div class="box-body">
                <form role="form" id="form_isian" method="post" action="<?php echo base_url(); ?>attachment/upload/?table_name=komponen" enctype="multipart/form-data">
                  <div class="box-body">
										<div class="form-group" style="display:none;">
											<label for="temp">temp</label>
											<input class="form-control" id="temp" name="temp" value="" placeholder="temp" type="text">
										</div>
										<div class="form-group" style="display:none;">
											<label for="mode">mode</label>
											<input class="form-control" id="mode" name="mode" value="input" placeholder="mode" type="text">
										</div>
										<div class="form-group" style="display:none;">
											<label for="id_komponen">id_komponen</label>
											<input class="form-control" id="id_komponen" name="id" value="" placeholder="id_komponen" type="text">
										</div>
										<div class="form-group">
											<label for="icon">Icon</label>
                      <select class="form-control" id="icon" name="icon" >
                      <option value="">Pilih Icon</option>
                      <option value="fa-home">fa-home</option>
                      <option value="fa-gears">fa-gears</option>
                      <option value="fa-th">fa-th</option>
                      <option value="fa-font">fa-font</option>
                      <option value="fa-comment">fa-comment</option>
                      <option value="fa-cogs">fa-cogs</option>
                      <option value="fa-cloud-download">fa-cloud-download</option>
                      <option value="fa-bar-char">fa-bar-char</option>
                      <option value="fa-phone">fa-phone</option>
                      <option value="fa-envelope">fa-envelope</option>
                      <option value="fa-link">fa-link</option>
                      <option value="fa-tasks">fa-tasks</option>
                      <option value="fa-users">fa-users</option>
                      <option value="fa-signal">fa-signal</option>
                      <option value="fa-coffee">fa-coffee</option>
                      </select>
                      <div id="iconselected"></div>
										</div>
										<div class="form-group">
											<label for="judul_komponen">Judul Komponen</label>
											<input class="form-control" id="judul_komponen" name="judul_komponen" value="" placeholder="Judul Komponen" type="text" readonly>
										</div>
										<div class="form-group" style="display:none;">
											<label for="isi_komponen">Isi Komponen</label>
											<input class="form-control" id="isi_komponen" name="isi_komponen" value="" placeholder="Isi Komponen" type="text">
										</div>
                    <div class="row">
                    <textarea id="editor_isi_komponen"></textarea>
                    </div>
										<div class="form-group">
											<label for="keterangan">Keterangan Komponen</label>
											<input class="form-control" id="keterangan" name="keterangan" value="" placeholder="Keterangan" type="text">
										</div>
										<div class="alert alert-info alert-dismissable">
											<div class="form-group">
												<label for="remake">Keterangan Lampiran </label>
												<input class="form-control" id="remake" name="remake" placeholder="Keterangan Lampiran " type="text">
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
												<tbody id="tbl_attachment_komponen">
												</tbody>
											</table>
										</div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="simpan_komponen">SIMPAN</button>
                    <button type="submit" class="btn btn-primary" id="update_komponen" style="display:none;">UPDATE</button>
                  </div>
                </form>
              </div>
              <div class="overlay" id="overlay_form_input" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane active" id="tab_2">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">
                  Data
                </h3>
              </div>
              <div class="box-body">
                <div>
                  <table class="table table-bordered">
                    <tr>
                      <th>NO</th>
                      <th>Judul Komponen</th>
                      <th>Isi Komponen</th>
                      <th>PROSES</th> 
                    </tr>
                    <tbody id="tbl_utama_komponen">
                    </tbody>
                  </table>
                  <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right" id="pagination">
                    </ul>
                  </div>
                </div>
              </div>
              <div class="overlay" id="spinners_data" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
              <div class="box-footer">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function() {
    $('#icon').on('change', function(e) {
      e.preventDefault();
      var xa = $('#icon').val();
      $("#iconselected").html('<span class="fa '+xa+' ">'+xa+'</span>');
    });
  });
</script>

<script>
  function load_pagination() {
    var tr = '';
    var td = TotalData('<?php echo base_url(); ?>komponen/total_komponen/?limit='+limit_per_page_custome(20000)+'');
    for (var i = 1; i <= td; i++) {
      tr += '<li page="'+i+'" id="'+i+'"><a class="update_id" href="#">'+i+'</a></li>';
    }
    $('#pagination').html(tr);
  }
</script>
 
<script>
  function AfterSavedKomponen() {
    $('#id_komponen, #judul_komponen, #isi_komponen, #icon, #keterangan').val('');
    $('#tbl_attachment_komponen').html('');
    $('#PesanProgresUpload').html('');
    load_option_komponen();
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#temp').val(Math.random());
  load_pagination();
});
</script>
 
<script>
  function load_data_komponen(halaman, limit) {
    $('#tbl_utama_komponen').html('');
    $('#spinners_data').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        halaman: halaman,
        limit: limit
      },
      dataType: 'json',
      url: '<?php echo base_url(); ?>komponen/json_all_komponen/',
      success: function(json) {
        var tr = '';
        var start = ((halaman - 1) * limit);
        for (var i = 0; i < json.length; i++) {
          var start = start + 1;
					tr += '<tr id_komponen="' + json[i].id_komponen + '" id="id_komponen' + json[i].id_komponen + '" >';
					tr += '<td valign="top">' + (start) + '</td>';
					tr += '<td valign="top">' + json[i].judul_komponen + '</td>';
					tr += '<td valign="top">' + json[i].isi_komponen + '</td>';
					tr += '<td valign="top">';
					tr += '<a href="#tab_1" data-toggle="tab" class="update_id" ><i class="fa fa-pencil-square-o"></i></a> ';
					tr += '<a href="#" id="del_ajax" ><i class="fa fa-cut"></i></a>';
					tr += '</td>';
          tr += '</tr>';
        }
        $('#tbl_utama_komponen').html(tr);
				$('#spinners_data').fadeOut('slow');
      }
    });
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
  var halaman = 1;
  var limit = limit_per_page_custome(20000);
  load_data_komponen(halaman, limit);
    
	$('#klik_tab_tampil').on('click', function(e) {
    var halaman = 1;
    var limit = limit_per_page_custome(20000);
    load_data_komponen(halaman, limit);
  });
});
</script>

<script>
	function AttachmentByMode(mode, value) {
		$('#tbl_attachment_komponen').html('');
		$.ajax({
			type: 'POST',
			async: true,
			data: {
        table:'komponen',
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
				$('#tbl_attachment_komponen').append(tr);
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
          var value = $('#id_komponen').val();
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
  $('#tbl_attachment_komponen').on('click', '#del_ajax', function() {
    var id_attachment = $(this).closest('tr').attr('id_attachment');
    alertify.confirm('Anda yakin data akan dihapus?', function(e) {
      if (e) {
        var parameter = {}
        parameter["id_attachment"] = id_attachment;
        var url = '<?php echo base_url(); ?>attachment/hapus/';
        HapusAttachment(parameter, url);
        var mode = $('#mode').val();
          if(mode == 'edit'){
            var value = $('#id_komponen').val();
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
  $('#tbl_utama_komponen').on('click', '#del_ajax', function() {
    var id_komponen = $(this).closest('tr').attr('id_komponen');
    alertify.confirm('Anda yakin data akan dihapus?', function(e) {
      if (e) {
        var parameter = {}
        parameter["id_komponen"] = id_komponen;
        var url = '<?php echo base_url(); ?>komponen/hapus/';
        HapusData(parameter, url);
        $('[id_komponen='+id_komponen+']').remove();
      } else {
        alertify.error('Hapus data dibatalkan');
      }
    });
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#tbl_utama_komponen').on('click', '.update_id', function() {
    $('#mode').val('edit');
    $('#simpan_komponen').hide();
    $('#update_komponen').show();
    var id_komponen = $(this).closest('tr').attr('id_komponen');
    var mode = $('#mode').val();
    var value = $(this).closest('tr').attr('id_komponen');
    $('#form_baru').show();
    $('#judul_formulir').html('FORMULIR EDIT');
    $('#id_komponen').val(id_komponen);
		$.ajax({
        type: 'POST',
        async: true,
        data: {
          id_komponen:id_komponen
        },
        dataType: 'json',
        url: '<?php echo base_url(); ?>komponen/get_by_id/',
        success: function(json) {
          for (var i = 0; i < json.length; i++) {
            $('#judul_komponen').val(json[i].judul_komponen);
            $('#icon').val(json[i].icon);
            $('#keterangan').val(json[i].keterangan);
            CKEDITOR.instances.editor_isi_komponen.setData(json[i].isi_komponen);
          }
        }
      });
    AttachmentByMode(mode, value);
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#form_baru').on('click', function(e) {
    $('#simpan_komponen').show();
    $('#update_komponen').hide();
    $('#tbl_attachment_komponen').html('');
    $('#id_komponen, #judul_komponen, #isi_komponen, #icon, #keterangan').val('');
    $('#form_baru').hide();
    $('#mode').val('input');
    $('#judul_formulir').html('FORMULIR INPUT');
  });
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#simpan_komponen').on('click', function(e) {
      e.preventDefault();
      var editor_isi_komponen = CKEDITOR.instances.editor_isi_komponen.getData();
      $('#isi_komponen').val( editor_isi_komponen );
      var parameter = [ 'judul_komponen', 'isi_komponen', 'icon', 'keterangan' ];
			InputValid(parameter);
      
      var parameter = {}
      parameter["judul_komponen"] = $("#judul_komponen").val();
      parameter["isi_komponen"] = $("#isi_komponen").val();
      parameter["icon"] = $("#icon").val();
      parameter["keterangan"] = $("#keterangan").val();
      parameter["temp"] = $("#temp").val();
      var url = '<?php echo base_url(); ?>komponen/simpan_komponen';
      
      var parameterRv = [ 'judul_komponen', 'isi_komponen', 'icon', 'temp', 'keterangan' ];
      var Rv = RequiredValid(parameterRv);
      if(Rv == 0){
        alertify.error('Mohon data diisi secara lengkap');
      }
      else{
        SimpanData(parameter, url);
        AfterSavedKomponen();
      }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#update_komponen').on('click', function(e) {
      e.preventDefault();
      var editor_isi_komponen = CKEDITOR.instances.editor_isi_komponen.getData();
      $('#isi_komponen').val( editor_isi_komponen );
      var parameter = [ 'judul_komponen', 'isi_komponen', 'icon', 'keterangan' ];
			InputValid(parameter);
      
      var parameter = {}
      parameter["judul_komponen"] = $("#judul_komponen").val();
      parameter["isi_komponen"] = $("#isi_komponen").val();
      parameter["icon"] = $("#icon").val();
      parameter["keterangan"] = $("#keterangan").val();
      parameter["temp"] = $("#temp").val();
      parameter["id_komponen"] = $("#id_komponen").val();
      var url = '<?php echo base_url(); ?>komponen/update_komponen';
      
      var parameterRv = [ 'judul_komponen', 'isi_komponen', 'icon', 'id_komponen', 'keterangan' ];
      var Rv = RequiredValid(parameterRv);
      if(Rv == 0){
        alertify.error('Mohon data diisi secara lengkap');
      }
      else{
        SimpanData(parameter, url);
      }
    });
  });
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#pagination').on('click', '.update_id', function(e) {
		e.preventDefault();
		var id = $(this).closest('li').attr('page');
		var halaman = id;
    var limit = limit_per_page_custome(20000);
    load_data_komponen(halaman, limit);
    
	});
});
</script>
<!----------------------->
<script type="text/javascript">
$(function() {
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('editor_isi_komponen');
	$(".textarea").wysihtml5();
});
</script