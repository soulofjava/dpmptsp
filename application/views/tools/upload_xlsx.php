<section class="content" id="awal">
  <div class="row">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab" id="klik_tab_input">GENERAL</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
        <div class="row" id="div_form_input">
          <div class="col-md-6">
            <div class="box box-danger box-solid">
              <div class="box-header">
                <h3 class="box-title">FORMULIR INPUT</h3>
              </div>
              <div class="box-body">
                <form role="form" id="form_skpd" method="post" action="<?php echo base_url(); ?>tools/do_upload_xlsx/" enctype="multipart/form-data">
                  <div class="box-body">
										<input id="id_skpd" name="id_skpd" type="hidden">
										<div class="alert alert-info alert-dismissable">
                      <div class="form-group">
												<label for="remake">Keterangan Lampiran Skpd</label>
												<input class="form-control" id="remake" name="remake" placeholder="Keterangan Lampiran Skpd" value="Upload XLSX" type="text">
											</div>
											<div class="form-group">
												<label for="myfile">File Lampiran Skpd</label>
												<input type="file" size="60" name="myfile" id="skpd_baru" >
											</div>
											<div id="progress_upload_lampiran_skpd">
												<div id="bar_progress_upload_lampiran_skpd"></div>
												<div id="percent_progress_upload_lampiran_skpd">0%</div >
											</div>
											<div id="message_progress_upload_lampiran_skpd"></div>
										</div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="simpan_skpd">SIMPAN</button>
                  </div>
                </form>
              </div>
              <div class="overlay" id="overlay_form_input" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <p>Format File</p>
            <table class="table table-bordered">
            <tr>
              <td>Merek Motor</td>
              <td>Seri Motor</td>
              <td>Kode SParepart</td>
              <td>Nama Resmi</td>
              <td>Nama Pasaran</td>
            </tr>
            <tbody id="tbl_desa">
            </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function read_file(nama_file) {
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        nama_file:nama_file
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>tools/read_xls_file_on_dir',
      success: function(response) {
        $('#message_progress_upload_lampiran_skpd').html(response);
        }
    });
  }
</script>

<script>
	$(document).ready(function(){
			var options = { 
				beforeSend: function() {
					$('#progress_upload_lampiran_skpd').show();
					$('#bar_progress_upload_lampiran_skpd').width('0%');
					$('#message_progress_upload_lampiran_skpd').html('');
					$('#percent_progress_upload_lampiran_skpd').html('0%');
					},
				uploadProgress: function(event, position, total, percentComplete){
					$('#bar_progress_upload_lampiran_skpd').width(percentComplete+'%');
					$('#percent_progress_upload_lampiran_skpd').html(percentComplete+'%');
					},
				success: function(){
					$('#bar_progress_upload_lampiran_skpd').width('100%');
					$('#percent_progress_upload_lampiran_skpd').html('100%');
					},
				complete: function(response){
					$('#message_progress_upload_lampiran_skpd').html('<font color="green">'+response.responseText+'</font>');
          var nama_file = response.responseText;
					read_file(nama_file);
					},
				error: function(){
					$('#message_progress_upload_lampiran_skpd').html('<font color="red"> ERROR: unable to upload files</font>');
					}     
			};
			document.getElementById('skpd_baru').onchange = function() {
					$('#form_skpd').submit();
				};
			$('#form_skpd').ajaxForm(options);
		});
</script>
