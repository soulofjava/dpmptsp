<!-- === BEGIN HEADER === -->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <!-- Title -->
        <title>Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</title>
        <!-- Meta -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Favicon -->
        <link href="favicon.ico" rel="shortcut icon">
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>Template/HTML/assets/css/bootstrap.css" rel="stylesheet">
        <!-- Template CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>Template/HTML/assets/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>Template/HTML/assets/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>Template/HTML/assets/css/nexus.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>Template/HTML/assets/css/responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>Template/HTML/assets/css/custom.css" rel="stylesheet">
        <!-- Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="body-bg">
            <!-- Phone/Email -->
            
            <!-- End Phone/Email -->
            <!-- Header -->
            <div id="header">
                <div class="container">
                    <div class="row">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="#" title="">
                                
                            </a>
                        </div>
                        <!-- End Logo -->
                    </div>
                </div>
            </div>
            <!-- End Header -->
            <!-- Top Menu -->
            <div id="hornav" class="bottom-border-shadow">
                <div class="container no-padding border-bottom">
                    <div class="row">
                        <div class="col-md-12 no-padding">
                            <div class="visible-lg">
                                <?php echo $menu_atas; ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Menu -->
            <!-- === END HEADER === -->
            <!-- === BEGIN CONTENT === -->
            <div id="slideshow" class="bottom-border-shadow">
                <div class="container no-padding background-white bottom-border">
                    <div class="row">
                        <!-- Carousel Slideshow -->
                        <div id="carousel-example" class="carousel slide" data-ride="carousel">
                            <!-- Carousel Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example" data-slide-to="1"></li>
                                <li data-target="#carousel-example" data-slide-to="2"></li>
                            </ol>
                            <div class="clearfix"></div>
                            <!-- End Carousel Indicators -->
                            <!-- Carousel Images -->
                            <div class="carousel-inner" id="show_slide_show">
                              <div class="item active">
                                <center><h1 style="font-size:200px;"><i class="fa-li fa fa-spinner fa-spin"></i> &nbsp;</li></h1></center>
                              </div>
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
                        <!-- End Carousel Slideshow -->
                    </div>
                </div>
            </div>
            
            <div id="content" class="bottom-border-shadow">
                <div class="container background-white bottom-border">
                    <div class="row margin-vert-30">
                        <!-- Main Text -->
                        <div class="col-md-6">
                            <?php if(!empty($welcome1)){ echo $welcome1; } ?>
                            <div class="row">
                              <div class="box-header with-border">
                                <h3 class="box-title">
                                  <span class="label label-primary" type="span">
                                    <i class="fa fa-bar-chart-o"></i> <span id="visitor"></span>
                                  </span>
                                </h3>
                              </div>
                            </div>
                        </div>
                        <!-- End Main Text -->
                        <div class="col-md-6">
                            <?php if(!empty($welcome2)){ echo $welcome2; } ?>
                            <div class="row">
                              <div class="col-md-12">
                                    <h3 class="progress-label">Total Dibaca
                                        <span class="pull-right" id="hit_counter"></span>
                                    </h3>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-orange" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <!-- End Orange -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Portfolio -->
            <div id="portfolio" class="bottom-border-shadow">
                <div class="container bottom-border">
                    <div class="row padding-top-40">
                        <ul class="portfolio-group">
                            <?php if(!empty($galery_berita)){ echo $galery_berita; } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Portfolio -->
            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
            <div id="base">
                <div class="container bottom-border padding-vert-30">
                    <div class="row">
                        <!-- Disclaimer -->
                        <div class="col-md-4">
                            <?php if(!empty($disclaimer)){ echo $disclaimer; } ?>
                        </div>
                        <!-- End Disclaimer -->
                        <!-- Contact Details -->
                        <div class="col-md-4 margin-bottom-20">
                            <?php if(!empty($kontak_detail)){ echo $kontak_detail; } ?>
                        </div>
                        <!-- End Contact Details -->
                        <!-- Sample Menu -->
                        <div class="col-md-4 margin-bottom-20">
                            <?php if(!empty($data_link_bawah)){ echo $data_link_bawah; } ?>
                        </div>
                        <!-- End Sample Menu -->
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div id="footer" class="background-grey">
                <div class="container">
                    <div class="row">
                        <!-- Footer Menu -->
                        <div id="footermenu" class="col-md-8">
                            
                        </div>
                        <!-- End Footer Menu -->
                        <!-- Copyright -->
                        <div id="copyright" class="col-md-4">
                            <p class="pull-right">(c) <?php echo date('Y'); ?> DPMPTSP</p>
                        </div>
                        <!-- End Copyright -->
                    </div>
                </div>
            </div>
            <!-- End Footer -->
            <!-- JS -->
            <script type="text/javascript" src="<?php echo base_url(); ?>Template/HTML/assets/js/jquery.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>Template/HTML/assets/js/bootstrap.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>Template/HTML/assets/js/scripts.js"></script>
            <!-- Isotope - Portfolio Sorting -->
            <script type="text/javascript" src="<?php echo base_url(); ?>Template/HTML/assets/js/jquery.isotope.js" type="text/javascript"></script>
            <!-- Mobile Menu - Slicknav -->
            <script type="text/javascript" src="<?php echo base_url(); ?>Template/HTML/assets/js/jquery.slicknav.js" type="text/javascript"></script>
            <!-- Animate on Scroll-->
            <script type="text/javascript" src="<?php echo base_url(); ?>Template/HTML/assets/js/jquery.visible.js" charset="utf-8"></script>
            <!-- Sticky Div -->
            <script type="text/javascript" src="<?php echo base_url(); ?>Template/HTML/assets/js/jquery.sticky.js" charset="utf-8"></script>
            <!-- Slimbox2-->
            <script type="text/javascript" src="<?php echo base_url(); ?>Template/HTML/assets/js/slimbox2.js" charset="utf-8"></script>
            <!-- Modernizr -->
            <script src="<?php echo base_url(); ?>Template/HTML/assets/js/modernizr.custom.js" type="text/javascript"></script>
            <!-- End JS -->
            
<script>
  function LoadVisitor() {
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        table:'visitor'
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>visitor/simpan_visitor/',
      success: function(html) {
        $('#visitor').html('Total Pengunjung '+html+' ');
      }
    });
  }
</script>
<script>
  function LoadHitCounter() {
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        current_url:'<?php echo current_url(); ?>'
      },
      dataType: 'html',
      url: '<?php echo base_url(); ?>visitor/hit_counter/',
      success: function(html) {
        $('#hit_counter').html(''+html+' Kali ');
      }
    });
  }
</script>
<script type="text/javascript">
$(document).ready(function() {
  LoadVisitor();
  LoadHitCounter();
});
</script>
            
<script>
  function show_slide_show(halaman, limit) {
    $('#show_slide_show').html('');
    $('#load_slidshow').show();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        halaman: halaman,
        limit: limit
      },
      dataType: 'json',
      url: '<?php echo base_url(); ?>komponen/json_slide_show/',
      success: function(json) {
        var tr = '';
        var start = ((halaman - 1) * limit);
        for (var i = 0; i < json.length; i++) {
          if( i == 1 ){
            tr += '<div class="item active">';
          }
          else{
            tr += '<div class="item">';
          }
					tr += '<center><img src="<?php echo base_url(); ?>media/upload/' + json[i].file_name + '"></center>';
					tr += '</div>';
        }
        $('#show_slide_show').html(tr);
        $('#load_slidshow').hide();
      }
    });
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	var halaman = 1;
  var limit = 4;
  show_slide_show(halaman, limit);
});
</script>
    </body>
</html>
<!-- === END FOOTER === -->