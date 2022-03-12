<form>
    <label>Masukkan NIK Anda<span class="color-red">*</span></label>
    <div class="row margin-bottom-20">
        <div class="col-md-6 col-md-offset-0">
            <input class="form-control" type="text" name="nik" id="nik">
        </div>
    </div>
    <!--<label>Masukkan No HP anda<span class="color-red">*</span></label>-->
    <div class="row margin-bottom-20">
        <div class="col-md-6 col-md-offset-0">
            <input class="form-control" type="hidden" name="telp" id="telp">
        </div>
    </div>
    <p>
        <button type="submit" id="cek" class="btn btn-primary">Cek Status Perizinan</button>
    </p>
</form>
<div class="row"> 
  <div class="col-md-12">
      <div class="panel panel-default">
          <div id="hasilnya">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Permohonan</th>
                <th>Jenis Perizinan</th>
                <th>Nama Perusahaan</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="tabel_data">
            </tbody>
          </table>
          </div>
      </div>
  </div>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
      <div class="modal-dialog cascading-modal" role="document">
          <div class="modal-content">
              <!--Header-->
              <div class="modal-header light-blue darken-3 white-text">
                  <h4 class="title" id="judul_status"><i class="fa fa-pencil"></i> Detail Status Perizinan</h4>
              </div>
              <div class="modal-body">
                <div class="box box-warning box-solid">
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tr>
                        <th>No</th>
                        <th>Log</th>
                        <th>Waktu</th>
                      </tr>
                      <tbody id="load_log"></tbody>
                    </table>
                  </div>
                </div>
                <div id="status"></div>
              </div>
              <div class="modal-footer">
                <div class="overlay" id="overlay_form_input" style="display:none;">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">Close</button>
              </div>
          </div>
      </div>
  </div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#cek').on('click', function(e) {
      e.preventDefault();
      $('#tabel_data').html('');
      var nik = $('#nik').val();
      $.ajax({
        type: 'POST',
        async: true,
        data: {
          nik:nik
        },
        dataType: 'html',
        url: 'https://apriz.wonosobokab.go.id/cek_status/data_perizinan',
        success: function(html) {
          $('#tabel_data').html(html);
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tabel_data').on('click', '#cek_status', function(e) {
      $('#load_log').html('');
      var nama_tabel = $(this).closest('tr').attr('nama_tabel');
      var temp = $(this).closest('tr').attr('temp');
      $.ajax({
        type: 'POST',
        async: true,
        data: {
          nama_tabel:nama_tabel,
          temp:temp
        },
        dataType: 'json',
        url: 'https://apriz.wonosobokab.go.id/cek_status/log_data_perizinan',
        success: function(json) {
            var tr = '';
            var start = 0;
            for (var i = 0; i < json.length; i++) {
              var start = start + 1;
              tr += '<tr>';
              tr += '<td valign="top">' + (start) + '</td>';
              tr += '<td valign="top">' + json[i].isi_log + '</td>';
              tr += '<td valign="top">' + json[i].created_time + '</td>';
              tr += '</td>';
              tr += '</tr>';
            }
            $('#load_log').append(tr);
        }
      });

      $('#status').html('');
      var id = $(this).closest('tr').attr('id');
      if(id == 0){
        text = '<img src="https://dpmptsp.wonosobokab.go.id/media/upload/0.jpg" width="100%">';
      }else if(id == 1){
        text = '<img src="https://dpmptsp.wonosobokab.go.id/media/upload/1.jpg" width="100%">';
      }else if(id == 2){
        text = '<img src="https://dpmptsp.wonosobokab.go.id/media/upload/2.jpg" width="100%">';
      }else if(id == 3){
        text = '<img src="https://dpmptsp.wonosobokab.go.id/media/upload/3.jpg" width="100%">';
      }else if(id == 4){
        text = '<img src="https://dpmptsp.wonosobokab.go.id/media/upload/4.jpg" width="100%">';
      }
      $('#status').html(text);
    });
  });
</script>