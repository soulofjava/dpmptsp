<?php
$where = array(
  'id_tabel' => $this->uri->segment(3),
  'table_name' => 'posting'
);
$this->db->where($where);
$this->db->order_by('attachment.id_attachment');
$query = $this->db->get('attachment');
$file = $query->row();
$j = $query->num_rows();
?>
<?php
if ($j == 0) {
} else {
  $tipefile = substr(strrchr($file->file_name, '.'), 1);
  if ($tipefile == 'jpg') {
?>
    <div class="row">
      <div id="carousel-example" class="carousel slide" data-ride="carousel">
        <!-- Carousel Indicators -->
        <ol class="carousel-indicators">
          <?php
          for ($x = 0; $x <= $j; $x++) {
            if ($x == 0) {
              echo '<li style="background:red;" data-target="#carousel-example" data-slide-to="' . $x . '" class="active"></li>';
            } else {
              echo '<li style="background:red;" data-target="#carousel-example" data-slide-to="' . $x . '"></li>';
            }
          }

          ?>
        </ol>
        <div class="clearfix"></div>
        <!-- End Carousel Indicators -->
        <!-- Carousel Images -->
        <div class="carousel-inner" id="slide_image">

        </div>
        <!-- End Carousel Images -->
        <!-- Carousel Controls -->
        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
        <!-- End Carousel Controls -->
      </div>
    </div>
    <div class="headline">
      <h2><?php if (!empty($judul_posting)) {
            echo $judul_posting;
          } ?></h2>
    </div>
    <?php if (!empty($isi_posting)) {
      echo $isi_posting;
    } ?>

    <script>
      function slide_image(halaman, limit) {
        $('#slide_image').html('');
        $('#load_slidshow').show();
        $.ajax({
          type: 'POST',
          async: true,
          data: {
            id: '<?php echo $this->uri->segment(3); ?>',
            halaman: halaman,
            limit: limit
          },
          dataType: 'json',
          url: '<?php echo base_url(); ?>postings/json_image_slide_show/',
          success: function(json) {
            var tr = '';
            var start = ((halaman - 1) * limit);
            for (var i = 0; i < json.length; i++) {
              if (i == 0) {
                tr += '<div class="item active">';
              } else {
                tr += '<div class="item">';
              }
              tr += '<center><img src="<?php echo base_url(); ?>media/upload/' + json[i].file_name + '"></center>';
              tr += '</div>';
            }
            $('#slide_image').html(tr);
            $('#load_slidshow').hide();
          }
        });
      }
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        slide_image(1, 1000);
      });
    </script>
  <?php
  } else { ?>
    <div class="row">
      <div id="carousel-example" class="carousel slide" data-ride="carousel">
        <!-- Carousel Indicators -->
        <ol class="carousel-indicators">
          <?php
          for ($x = 0; $x <= $j; $x++) {
            if ($x == 0) {
              echo '<li style="background:red;" data-target="#carousel-example" data-slide-to="' . $x . '" class="active"></li>';
            } else {
              echo '<li style="background:red;" data-target="#carousel-example" data-slide-to="' . $x . '"></li>';
            }
          }

          ?>
        </ol>
        <div class="clearfix"></div>
        <!-- End Carousel Indicators -->
        <!-- Carousel Images -->
        <div class="carousel-inner" id="slide_image">

        </div>
        <!-- End Carousel Images -->
        <!-- Carousel Controls -->
        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
        <!-- End Carousel Controls -->
      </div>
    </div>
    <div class="headline">
      <h2><?php if (!empty($judul_posting)) {
            echo $judul_posting;
          } ?></h2>
    </div>
    <?php if (!empty($isi_posting)) {
      echo $isi_posting;
    } ?>

    <script>
      function slide_image(halaman, limit) {
        $('#slide_image').html('');
        $('#load_slidshow').show();
        $.ajax({
          type: 'POST',
          async: true,
          data: {
            id: '<?php echo $this->uri->segment(3); ?>',
            halaman: halaman,
            limit: limit
          },
          dataType: 'json',
          url: '<?php echo base_url(); ?>postings/json_image_slide_show/',
          success: function(json) {
            var tr = '';
            var start = ((halaman - 1) * limit);
            for (var i = 0; i < json.length; i++) {
              if (i == 0) {
                tr += '<div class="item active">';
              } else {
                tr += '<div class="item">';
              }
              tr += '<center><object type="application/pdf" width="100%" height="700px" data="<?php echo base_url(); ?>media/upload/' + json[i].file_name + '"></object></center>';
              tr += '</div>';
            }
            $('#slide_image').html(tr);
            $('#load_slidshow').hide();
          }
        });
      }
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        slide_image(1, 1000);
      });
    </script>
<?php }
}
?>