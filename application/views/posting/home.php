<section class="content" id="awal">

  <div>
  Untuk menambahkan video dari youtube, harus pada source editor <br />
  silahkan kopikan kode dibawah ini &lt;iframe width="420" height="345" src="https://www.youtube.com/embed/<span style="color:red;">XGSy3_Czz8k</span>?autoplay=1"&gt;&lt;/iframe&gt;
  </div>
  <div class="row">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#tab_1" id="klik_tab_input">Form</a> <span id="demo"></span></li>
      <li><a data-toggle="tab" href="#tab_2" id="klik_tab_tampil" >Tampil</a></li>
      <li><a data-toggle="tab" href="#tab_3" id="klik_tab_tampil_menu_atas" >Menu Atas</a></li>
      <!--<li><a data-toggle="tab" href="#tab_4" id="klik_tab_tampil_menu_kanan" >Menu Kanan</a></li>-->
      <li><a data-toggle="tab" href="#tab_5" id="klik_tab_tampil_menu_kiri" >Menu Kiri</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <h3 class="box-title" id="judul_formulir">FORMULIR INPUT</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" id="form_baru"><i class="fa fa-plus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <form role="form" id="form_isian" method="post" action="<?php echo base_url(); ?>attachment/upload/?table_name=posting" enctype="multipart/form-data">
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
											<label for="id_posting">id_posting</label>
											<input class="form-control" id="id_posting" name="id" value="" placeholder="id_posting" type="text">
										</div>
										<div class="form-group">
											<label for="posisi">Posisi</label>
											<select class="form-control" id="posisi" name="posisi" >
                      <option value="menu_atas">Menu Atas</option>
                      <!--<option value="menu_kanan">Menu Kanan</option>-->
                      <option value="menu_kiri">Menu Kiri</option>
                      <option value="independen">Independen</option>
                      </select>
										</div>
										<div class="form-group">
											<label for="parent">Parent</label>
											<select class="form-control" id="parent" name="parent" >
                      </select>
										</div>
										<div class="form-group">
											<label for="urut">Urut</label>
											<input class="form-control" id="urut" name="urut" value="" placeholder="urut" type="text">
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
											<label for="highlight">High Light</label>
											<select class="form-control" id="highlight" name="highlight" >
                      <option value="0">Tidak</option>
                      <option value="1">Ya</option>
                      </select>
										</div>
										<div class="form-group">
											<label for="tampil_menu">Tampil Menu</label>
											<select class="form-control" id="tampil_menu" name="tampil_menu" >
                      <option value="1">Ya</option>
                      <option value="0">Tidak</option>
                      </select>
										</div>
										<div class="form-group">
											<label for="judul_posting">Judul Halaman</label>
											<input class="form-control" id="judul_posting" name="judul_posting" value="" placeholder="Judul Halaman" type="text">
										</div>
										<div class="form-group" style="display:none;">
											<label for="isi_posting">Isi Halaman</label>
											<input class="form-control" id="isi_posting" name="isi_posting" value="" placeholder="Isi Halaman" type="text">
										</div>
                    <div class="row">
                    <textarea id="editor_isi_posting"></textarea>
                    </div>
										<div class="form-group">
											<label for="kata_kunci">Kata Kunci</label>
											<input class="form-control" id="kata_kunci" name="kata_kunci" value="" placeholder="kata_kunci" type="text">
										</div>
										<div class="form-group">
											<label for="keterangan">Keterangan Halaman</label>
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
												<tbody id="tbl_attachment_posting">
												</tbody>
											</table>
										</div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="simpan_posting">SIMPAN</button>
                    <button type="submit" class="btn btn-primary" id="update_posting" style="display:none;">UPDATE</button>
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
      <div class="tab-pane" id="tab_2">
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
                      <th>Posisi</th>
                      <th>Judul Halaman</th>
                      <th>Urut</th>
                      <th>High Light</th>
                      <th>PROSES</th> 
                    </tr>
                    <tbody id="tbl_utama_posting">
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
      <div class="tab-pane" id="tab_3">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">
                  Data Menu Atas
                </h3>
              </div>
              <div class="box-body">
                <div>
                  <div id="tbl_utama_posting1">
                  </div>
                  <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right" id="pagination">
                    </ul>
                  </div>
                </div>
              </div>
              <div class="overlay" id="spinners_data1" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
              <div class="box-footer">
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab_4">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">
                  Data Menu Kanan
                </h3>
              </div>
              <div class="box-body">
                <div>
                  <div id="tbl_utama_posting2">
                  </div>
                  <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right" id="pagination">
                    </ul>
                  </div>
                </div>
              </div>
              <div class="overlay" id="spinners_data2" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
              <div class="box-footer">
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab_5">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">
                  Data Menu Kiri
                </h3>
              </div>
              <div class="box-body">
                <div>
                  <div id="tbl_utama_posting3">
                  </div>
                  <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right" id="pagination">
                    </ul>
                  </div>
                </div>
              </div>
              <div class="overlay" id="spinners_data3" style="display:none;">
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
  function load_option_posting_by_posisi(posisi) {
    $('#parent').html('');
    $('#spinners_data').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        posisi: posisi
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>posting/load_the_option_by_posisi/',
      success: function(html) {
        $('#parent').html('<option value="0">Utama</option>  '+html+'');
      }
    });
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#posisi').on('change', function(e) {
      e.preventDefault();
      var posisi = $('#posisi').val();
      load_option_posting_by_posisi(posisi);
    });
  });
</script>

<script>
  function load_option_posting() {
    $('#parent').html('');
    $('#spinners_data').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        halaman: 1
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>posting/load_the_option/',
      success: function(html) {
        $('#parent').html('<option value="0">Utama</option>  '+html+'');
      }
    });
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
  load_option_posting();
});
</script>

<script>
  function load_pagination() {
    var tr = '';
    var td = TotalData('<?php echo base_url(); ?>posting/total_posting/?limit='+limit_per_page_custome(20000)+'');
    for (var i = 1; i <= td; i++) {
      tr += '<li page="'+i+'" id="'+i+'"><a class="update_id" href="#">'+i+'</a></li>';
    }
    $('#pagination').html(tr);
  }
</script>
 
<script>
  function AfterSavedPosting() {
    $('#id_posting, #judul_posting, #isi_posting, #urut, #posisi, #icon, #keterangan').val('');
    $('#tbl_attachment_posting').html('');
    $('#PesanProgresUpload').html('');
    load_option_posting();
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#temp').val(Math.random());
  load_pagination();
});
</script>
 
<script>
  function load_data_posting(halaman, limit) {
    $('#tbl_utama_posting').html('');
    $('#spinners_data').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        halaman: halaman,
        limit: limit
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>posting/load_table/',
      success: function(html) {
        $('#tbl_utama_posting').html(html);
        $('#spinners_data').hide();
      }
    });
  }
</script>
 
<script>
  function load_data_posting1(halaman, limit) {
    $('#tbl_utama_posting1').html('');
    $('#spinners_data1').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        halaman: halaman,
        limit: limit
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>posting/load_table1/',
      success: function(html) {
        $('#tbl_utama_posting1').html(html);
        $('#spinners_data1').hide();
      }
    });
  }
</script>
 
<script>
  function load_data_posting2(halaman, limit) {
    $('#tbl_utama_posting2').html('');
    $('#spinners_data2').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        halaman: halaman,
        limit: limit
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>posting/load_table2/',
      success: function(html) {
        $('#tbl_utama_posting2').html(html);
        $('#spinners_data2').hide();
      }
    });
  }
</script>
 
<script>
  function load_data_posting3(halaman, limit) {
    $('#tbl_utama_posting3').html('');
    $('#spinners_data3').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        halaman: halaman,
        limit: limit
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>posting/load_table3/',
      success: function(html) {
        $('#tbl_utama_posting3').html(html);
        $('#spinners_data3').hide();
      }
    });
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#klik_tab_tampil').on('click', function(e) {
    var halaman = 1;
    var limit = limit_per_page_custome(20000);
    load_data_posting(halaman, limit);
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#klik_tab_tampil_menu_atas').on('click', function(e) {
    var halaman = 1;
    var limit = limit_per_page_custome(20000);
    load_data_posting1(halaman, limit);
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#klik_tab_tampil_menu_kanan').on('click', function(e) {
    var halaman = 1;
    var limit = limit_per_page_custome(20000);
    load_data_posting2(halaman, limit);
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#klik_tab_tampil_menu_kiri').on('click', function(e) {
    var halaman = 1;
    var limit = limit_per_page_custome(20000);
    load_data_posting3(halaman, limit);
  });
});
</script>

<script>
	function AttachmentByMode(mode, value) {
		$('#tbl_attachment_posting').html('');
		$.ajax({
			type: 'POST',
			async: true,
			data: {
        table:'posting',
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
				$('#tbl_attachment_posting').append(tr);
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
          var value = $('#id_posting').val();
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
  $('#tbl_attachment_posting').on('click', '#del_ajax', function() {
    var id_attachment = $(this).closest('tr').attr('id_attachment');
    alertify.confirm('Anda yakin data akan dihapus?', function(e) {
      if (e) {
        var parameter = {}
        parameter["id_attachment"] = id_attachment;
        var url = '<?php echo base_url(); ?>attachment/hapus/';
        HapusAttachment(parameter, url);
        var mode = $('#mode').val();
          if(mode == 'edit'){
            var value = $('#id_posting').val();
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
  $('#tbl_utama_posting').on('click', '#del_ajax', function() {
    var id_posting = $(this).closest('tr').attr('id_posting');
    alertify.confirm('Anda yakin data akan dihapus?', function(e) {
      if (e) {
        var parameter = {}
        parameter["id_posting"] = id_posting;
        var url = '<?php echo base_url(); ?>posting/hapus/';
        HapusData(parameter, url);
        $('[id_posting='+id_posting+']').remove();
      } else {
        alertify.error('Hapus data dibatalkan');
      }
    });
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#tbl_utama_posting').on('click', '.update_id', function() {
    $('#mode').val('edit');
    $('#simpan_posting').hide();
    $('#update_posting').show();
    var id_posting = $(this).closest('tr').attr('id_posting');
    var mode = $('#mode').val();
    var value = $(this).closest('tr').attr('id_posting');
    $('#form_baru').show();
    $('#judul_formulir').html('FORMULIR EDIT');
    $('#id_posting').val(id_posting);
		$.ajax({
        type: 'POST',
        async: true,
        data: {
          id_posting:id_posting
        },
        dataType: 'json',
        url: '<?php echo base_url(); ?>posting/get_by_id/',
        success: function(json) {
          for (var i = 0; i < json.length; i++) {
            $('#judul_posting').val(json[i].judul_posting);
            $('#parent').val(json[i].parent);
            $('#highlight').val(json[i].highlight);
            $('#tampil_menu').val(json[i].tampil_menu);
            //$('#isi_posting').val(json[i].isi_posting);
            $('#urut').val(json[i].urut);
            $('#posisi').val(json[i].posisi);
            $('#icon').val(json[i].icon);
            $('#kata_kunci').val(json[i].kata_kunci);
            $('#keterangan').val(json[i].keterangan);
            CKEDITOR.instances.editor_isi_posting.setData(json[i].isi_posting);
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
    $('#simpan_posting').show();
    $('#update_posting').hide();
    $('#tbl_attachment_posting').html('');
    $('#id_posting, #judul_posting, #highlight, #tampil_menu, #parent, #isi_posting, #urut, #posisi, #icon, #kata_kunci, #keterangan').val('');
    $('#form_baru').hide();
    $('#mode').val('input');
    $('#judul_formulir').html('FORMULIR INPUT');
  });
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#simpan_posting').on('click', function(e) {
      e.preventDefault();
      var editor_isi_posting = CKEDITOR.instances.editor_isi_posting.getData();
      $('#isi_posting').val( editor_isi_posting );
      var parameter = [ 'judul_posting', 'highlight', 'tampil_menu', 'parent', 'parent', 'isi_posting', 'urut', 'posisi', 'icon', 'kata_kunci', 'keterangan' ];
			InputValid(parameter);
      
      var parameter = {}
      parameter["judul_posting"] = $("#judul_posting").val();
      parameter["highlight"] = $("#highlight").val();
      parameter["tampil_menu"] = $("#tampil_menu").val();
      parameter["parent"] = $("#parent").val();
      parameter["isi_posting"] = $("#isi_posting").val();
      parameter["urut"] = $("#urut").val();
      parameter["posisi"] = $("#posisi").val();
      parameter["icon"] = $("#icon").val();
      parameter["kata_kunci"] = $("#kata_kunci").val();
      parameter["keterangan"] = $("#keterangan").val();
      parameter["temp"] = $("#temp").val();
      var url = '<?php echo base_url(); ?>posting/simpan_posting';
      
      var parameterRv = [ 'judul_posting', 'highlight', 'tampil_menu', 'parent', 'isi_posting', 'urut', 'posisi', 'icon', 'temp', 'kata_kunci', 'keterangan' ];
      var Rv = RequiredValid(parameterRv);
      if(Rv == 0){
        alertify.error('Mohon data diisi secara lengkap');
      }
      else{
        SimpanData(parameter, url);
        AfterSavedPosting();
      }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#update_posting').on('click', function(e) {
      e.preventDefault();
      var editor_isi_posting = CKEDITOR.instances.editor_isi_posting.getData();
      $('#isi_posting').val( editor_isi_posting );
      var parameter = [ 'judul_posting', 'highlight', 'tampil_menu', 'parent', 'isi_posting', 'urut', 'posisi', 'icon', 'kata_kunci', 'keterangan' ];
			InputValid(parameter);
      
      var parameter = {}
      parameter["judul_posting"] = $("#judul_posting").val();
      parameter["highlight"] = $("#highlight").val();
      parameter["tampil_menu"] = $("#tampil_menu").val();
      parameter["parent"] = $("#parent").val();
      parameter["isi_posting"] = $("#isi_posting").val();
      parameter["urut"] = $("#urut").val();
      parameter["posisi"] = $("#posisi").val();
      parameter["icon"] = $("#icon").val();
      parameter["kata_kunci"] = $("#kata_kunci").val();
      parameter["keterangan"] = $("#keterangan").val();
      parameter["temp"] = $("#temp").val();
      parameter["id_posting"] = $("#id_posting").val();
      var url = '<?php echo base_url(); ?>posting/update_posting';
      
      var parameterRv = [ 'judul_posting', 'highlight', 'tampil_menu', 'parent', 'isi_posting', 'urut', 'posisi', 'icon', 'id_posting', 'kata_kunci', 'keterangan' ];
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
    load_data_posting(halaman, limit);
    
	});
});
</script>
<!----------------------->
<script type="text/javascript">
$(function() {
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('editor_isi_posting');
	$(".textarea").wysihtml5();
});
</script