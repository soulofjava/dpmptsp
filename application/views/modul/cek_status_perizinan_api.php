<form>
    <label>Masukkan NIK/No SK/Tanggal SK Anda<span class="color-red">*</span></label>
    <div class="row margin-bottom-20">
        <div class="col-md-4 col-md-offset-0">
            <input class="form-control" type="text" name="nik" id="nik" placeholder="NIK">
        </div>
        <div class="col-md-4 col-md-offset-0">
            <input class="form-control" type="text" name="no_sk" id="no_sk" placeholder="Nomor SK">
        </div>
        <div class="col-md-4 col-md-offset-0">
            <input class="form-control" type="text" name="tgl_sk" id="tgl_sk"  placeholder="Tanggal SK">
        </div>
    </div>
    <!--<label>Masukkan No HP anda<span class="color-red">*</span></label>-->
    <div class="row margin-bottom-20">
        <div class="col-md-6 col-md-offset-0">
            <input class="form-control" type="hidden" name="telp" id="telp">
        </div>
    </div>
    <p>
        <button type="submit" id="cek1" class="btn btn-primary">Cek API NIK</button>
        <button type="submit" id="cek2" class="btn btn-primary">Cek API NO SK</button>
        <button type="submit" id="cek3" class="btn btn-primary">Cek API Tanggal SK</button>
    </p>
</form>
<div class="row"> 
  <div class="col-md-12">
      <div class="panel panel-default">
          <div id="hasil"></div>
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
    $('#cek1').on('click', function(e) {
      e.preventDefault();
      $('#hasil').html('');
      var nik = $('#nik').val();
      //var no_sk = $('#no_sk').val();
      //var tgl_awal = $('#tgl_awal').val();
      //var tgl_akhir = $('#tgl_akhir').val();
      var username = $('#username').val();
      var password = $('#password').val();
      $.ajax({
        type: 'POST',
        async: true,
        data: {
          nik:nik, // format : 3307092912690002
          //no_sk:no_sk,  //format : 503.1.5/048/IX/DPMPTSP/2015
          //tgl_awal:tgl_awal,  //format : YYYY-MM-DD || ex : 2015-10-29
          //tgl_akhir:tgl_akhir,  //format : YYYY-MM-DD || ex : 2015-10-29
          username:'bppkad',
          password:'XXXXXXXXXXXXXXXXX'//md5 dari Bee51t4w0n2021%
        },
        dataType: 'json',
        url: 'https://apriz.wonosobokab.go.id/cek_status/api_perizinan',
        success: function(json) {
          $('#hasil').html(json);
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#cek1').on('click', function(e) {
      e.preventDefault();
      $('#hasil').html('');
      var nik = $('#nik').val();
      //var no_sk = $('#no_sk').val();
      //var tgl_sk = $('#tgl_sk').val();
      $.ajax({
        type: 'POST',
        async: true,
        data: {
          nik:nik // format : 3307010101010001
          //no_sk:no_sk  format : 503.1.5/048/IX/DPMPTSP/2015
          //tgl_sk:tgl_sk  format : YYYY-MM-DD || ex : 2015-10-29
        },
        dataType: 'json',
        url: 'https://apriz.wonosobokab.go.id/cek_status/api_perizinan_json',
        success: function(json) {
          $('#hasil').json(json);
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#cek2').on('click', function(e) {
      e.preventDefault();
      $('#hasil').html('');
      var no_sk = $('#no_sk').val();
      $.ajax({
        type: 'POST',
        async: true,
        data: {
          no_sk:no_sk
        },
        dataType: 'html',
        url: 'https://apriz.wonosobokab.go.id/cek_status/api_perizinan',
        success: function(html) {
          $('#hasil').html(html);
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#cek3').on('click', function(e) {
      e.preventDefault();
      $('#hasil').html('');
      var tgl_sk = $('#tgl_sk').val();
      $.ajax({
        type: 'POST',
        async: true,
        data: {
          tgl_sk:tgl_sk
        },
        dataType: 'html',
        url: 'https://apriz.wonosobokab.go.id/cek_status/api_perizinan',
        success: function(html) {
          $('#hasil').html(html);
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