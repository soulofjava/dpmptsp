
<div class="row"> 
  <div class="col-md-6">
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Informasi Terkait</h3>
          </div>
          <div class="panel-body">
              <ul class="posts-list margin-top-10" id="informasi_terkait">
                  
              </ul>
          </div>
      </div>
  </div>
  <!-- End Main Text -->
  <div class="col-md-6">
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Informasi Lainnya</h3>
          </div>
          <div class="panel-body">
              <ul class="posts-list margin-top-10" id="informasi_lainnya">
                  
              </ul>
          </div>
      </div>
  </div>
</div>
<?php 
$urls =  $this->uri->segment(3);
?>
<script>
  function load_informasi_terkait() {
    $('#informasi_terkait').html('');
    $('#spinners_informasi_terkait').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        parent:'<?php echo $urls; ?>'
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>postings/informasi_terkait/',
      success: function(html) {
        $('#informasi_terkait').html(html);
				$('#spinners_informasi_terkait').fadeOut('slow');
      }
    });
  }
</script>
<script>
  function informasi_lainnya() {
    $('#informasi_lainnya').html('');
    $('#spinners_informasi_lainnya').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        parent:'<?php echo $urls; ?>'
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>postings/informasi_lainnya/',
      success: function(html) {
        $('#informasi_lainnya').html(html);
				$('#spinners_informasi_lainnya').fadeOut('slow');
      }
    });
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
  load_informasi_terkait();
  informasi_lainnya();
});
</script>