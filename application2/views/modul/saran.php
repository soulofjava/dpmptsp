<div class="row">
  <div class="col-md-6">
    <div class="box-header with-border">
      <h3 class="box-title" id="pesan_kirim">Mohon Isikan Data Anda Secara Lengkap</h3><br />
    </div>
    <form id="kotak_saran">
        <label>Masukkan NIK Anda<span class="color-red">*</span></label>
        <div class="row margin-bottom-20">
            <div class="col-md-12 col-md-offset-0">
                <input class="form-control" type="text" name="nik" id="nik">
            </div>
        </div>
        <label>Nama Anda<span class="color-red">*</span></label>
        <div class="row margin-bottom-20">
            <div class="col-md-12 col-md-offset-0">
                <input class="form-control" type="text" name="nama_pengirim" id="nama_pengirim">
            </div>
        </div>
        <label>Masukkan No HP Anda<span class="color-red">*</span></label>
        <div class="row margin-bottom-20">
            <div class="col-md-12 col-md-offset-0">
                <input class="form-control" type="text" name="telp" id="telp">
            </div>
        </div>
        <label>Masukkan Alamat Email Anda<span class="color-red">*</span></label>
        <div class="row margin-bottom-20">
            <div class="col-md-12 col-md-offset-0">
                <input class="form-control" type="text" name="email" id="email">
            </div>
        </div>
        <label>Silahkan isi Keluhan, Saran atau Pertanyaan Anda<span class="color-red">*</span></label>
        <div class="row margin-bottom-20">
            <div class="col-md-12 col-md-offset-0">
                <textarea class="form-control" type="text" name="isi_saran" id="isi_saran"></textarea>
            </div>
        </div>
        <p>
            <button type="submit" id="simpan_saran" class="btn btn-primary">Kirim Saran/Aduan/Pertanyaan</button>
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
  </div>
  
  
  <div class="col-md-6">
  <?php
  $where = array(
  'status' => 2
  );
  $this->db->select("*");
  $this->db->where($where);
  $this->db->order_by('created_time');
  $saran = $this->db->get('saran');
  
  ?>
    <div class="carousel slide testimonials" id="testimonials3">
        <ol class="carousel-indicators">
          <?php
          $a = 0;
          foreach($saran->result() as $r1){
            $a = $a + 1;
            if( $a == 1 ){
              echo '<li class="active" data-slide-to="'.$a.'" data-target="#testimonials3"></li>';
            }
            else{
              echo '<li data-slide-to="'.$a.'" data-target="#testimonials3"></li>';
            }
          }
          ?>
        </ol>
        <div class="carousel-inner">
          <?php
          $b = 0;
          foreach($saran->result() as $r2){
            $b = $b + 1;
            if( $b == 1 ){
              echo 
              '
              <div class="item active">
                  <div class="testimonials-bg-primary col-md-12">
                      <p>
                        '.$r2->isi_saran.'
                      </p>
                      <div class="testimonial-info">
                          <img alt="" src="'.base_url().'media/upload/penanya.png" class="img-circle img-responsive">
                          <span class="testimonial-author">
                              '.$r2->nama_pengirim.'
                              <em>
                                  '.$r2->created_time.'
                              </em>
                          </span>
                      </div>
                  </div>
                  <div class="clearfix"></div>
              </div>
              ';
            }
            else{
              echo 
              '
              <div class="item">
                  <div class="testimonials-bg-primary col-md-12">
                      <p>
                        '.$r2->isi_saran.'
                      <div class="testimonial-info">
                          <img alt="" src="'.base_url().'media/upload/penanya.png" class="img-circle img-responsive">
                          <span class="testimonial-author">
                              '.$r2->nama_pengirim.'
                              <em>
                                '.$r2->created_time.'
                              </em>
                          </span>
                      </div>
                  </div>
                  <div class="clearfix"></div>
              </div>
              ';
            }
          }
          ?>
        </div>
    </div>
    <div class="testimonials-arrows pull-right">
        <a class="left" href="#testimonials3" data-slide="prev">
            <span class="fa fa-arrow-left"></span>
        </a>
        <a class="right" href="#testimonials3" data-slide="next">
            <span class="fa fa-arrow-right"></span>
        </a>
        <div class="clearfix"></div>
    </div>
  </div>
  
</div>

<script src="https://cdn.keyzie.org/js/alertify.min.js"></script>
<script src="https://cdn.keyzie.org/js/uut.js"></script>
            
<script>
  function AfterSavedSaran() {
    $('#id_saran, #nik, #telp, #isi_saran, #email, #nama_pengirim').val('');
    $('#pesan_kirim').html('<span style="color:blue;">Terima Kasih Atas Saran Anda, Akan Segera Kami Tindak Lanjuti...</span>');
    $('#kotak_saran').hide();
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#simpan_saran').on('click', function(e) {
      e.preventDefault();
      var parameter = [ 'nik', 'telp', 'isi_saran', 'email', 'nama_pengirim' ];
			InputValid(parameter);
      
      var parameter = {}
      parameter["nik"] = $("#nik").val();
      parameter["nama_pengirim"] = $("#nama_pengirim").val();
      parameter["email"] = $("#email").val();
      parameter["telp"] = $("#telp").val();
      parameter["isi_saran"] = $("#isi_saran").val();
      parameter["temp"] = $("#temp").val();
      var url = '<?php echo base_url(); ?>saran/simpan_saran';
      
      var parameterRv = [ 'nik', 'telp', 'temp', 'isi_saran', 'email', 'nama_pengirim' ];
      var Rv = RequiredValid(parameterRv);

      if(Rv == 0){
        $('html, body').animate({
          scrollTop: $('#startcontent').offset().top
        }, 1000);
        $('#pesan_kirim').html('<span style="color:red;">Mohon Isikan Data Secara Lengkap</span>');
      }
      else{
        SimpanData(parameter, url);
        AfterSavedSaran();
      }
    });
  });
</script>