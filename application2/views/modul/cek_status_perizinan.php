<form>
    <label>Masukkan NIK Anda<span class="color-red">*</span></label>
    <div class="row margin-bottom-20">
        <div class="col-md-6 col-md-offset-0">
            <input class="form-control" type="text" name="nik" id="nik">
        </div>
    </div>
    <label>Masukkan No HP anda<span class="color-red">*</span></label>
    <div class="row margin-bottom-20">
        <div class="col-md-6 col-md-offset-0">
            <input class="form-control" type="text" name="telp" id="telp">
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
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#cek').on('click', function(e) {
      e.preventDefault();
      $('#hasilnya').html('');
      var nik = $('#nik').val();
      var telp = $('#telp').val();
      $.ajax({
        type: 'POST',
        async: true,
        data: {
          nik:nik,
          telp:telp
        },
        dataType: 'html',
        url: 'https://apriz.wonosobokab.go.id/cek_status/data_perizinan',
        success: function(html) {
          $('#hasilnya').html(html);
        }
      });
    });
  });
</script>