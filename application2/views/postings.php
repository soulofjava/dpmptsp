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
        <style>
        .videoWrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            padding-top: 25px;
            height: 0;
        }
        .videoWrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        </style>
        <!-- Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <script src="https://cdn.keyzie.org/js/jquery.min.js"></script>
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
            <div id="content">
                <div class="container background-white">
                    <div class="row margin-vert-40">
                        <div class="col-md-3">
                          <div class="row">
                            <?php echo $menu_kiri; ?>
                          </div>
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
                        
                        
                        <!-- End Sidebar Menu -->
                        <div class="col-md-9" id="startcontent">
                            <!-- Paragraph Examples -->
                            <div class="row">
                                <div class="col-md-12">
                                    <?php $this -> load -> view($main_view);  ?>
                                    <?php if(!empty($isi_posting)){ $this -> load -> view('modul/'.$nama_modul.''); } ?>
                                </div>
                            </div>
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
                            <div class="row">
                              <div class="col-md-12">
                                <?php
                                $url =  $this->uri->segment(2);
                                if($url == 'categories'){
                                  $this -> load -> view('postings/info_lainnya1.php');
                                }
                                elseif($url == 'detail'){
                                  $this -> load -> view('postings/info_lainnya2.php');
                                }
                                else{
                                }
                                ?>
                              </div>
                            </div>
                            <!-- End Inline Lists -->
                            <div class="clearfix margin-bottom-10"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
            <div id="base">
                <div class="container bottom-border padding-vert-30">
                    <div class="row">
                        <!-- Disclaimer -->
                        <div class="col-md-4">
                            <?php if(!empty($disclaimer)){ echo $disclaimer; } ?>
                        </div>
                        
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
                            <ul class="list-unstyled list-inline">
                                <li><a href="#" target="_blank">&nbsp;</a></li>
                            </ul>
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
    </body>
</html>
<!-- === END FOOTER === -->