<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$ses=$this->session->userdata('id_users');
if(!$ses) { return redirect(''.base_url().'login');  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>DPMPTSP - Content Management System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>boots/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>boots/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>boots/font-awesome/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris charts -->
    <link href="<?php echo base_url(); ?>css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>boots/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>boots/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="../../https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="../../https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
		
		<!-- Alert Confirmation -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/alertify/alertify.core.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/datepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/alertify/alertify.default.css" id="toggleCSS" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/Typeahead-BS3-css.css" id="toggleCSS" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>boots/dist/css/bootstrap-timepicker.min.css" />
		<!-- Progress bar -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-combined.min.css" id="toggleCSS" />
		
		<style>
		tr:hover {
				background-color: #76bbf7;
				color:red;
		}
   
		tr:hover td {
				background-color: transparent; /* or #000 */
		}
		</style>
    <style>
    #div_data_cari { overflow:hidden;height:whatever px; }
    #div_data_cari:hover { overflow-x:scroll; }
    </style>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
	<div class="overlay" id="overlay_loading" style="display:none;" >
		<i class="fa fa-refresh fa-spin"></i>
	</div>
    <div class="wrapper">
      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
          <div class="navbar-header">
            <a href="" class="navbar-brand"><b>DPMPTSP</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="navbar-collapse">
					
					<?php
						$this -> load -> view('menu/'.$this->session->userdata('hak').'');
					?>
						<ul class="nav navbar-nav navbar-right">
							<?php 
							$where = array(
							'id_tabel' => $this->session->userdata('id_users'),
							'table_name' => 'users'
							);
							$this->db->where($where);
							$this->db->limit(1);
							$this->db->from('attachment');
							$jml = $this->db->count_all_results(); // Produces an integer, like 17
							
							if( $jml > 0 ){
								$this->db->where($where);
								$this->db->limit(1);
								$query = $this->db->get('attachment');
								foreach ($query->result() as $row)
									{
									$file_kecil = 'k_'.$row->file_name.'';
									$file_sedang = 's_'.$row->file_name.'';
									}
								}
							else{
									$file_kecil = 'blank_user.png';
									$file_sedang = 'blank_user.png';
								}
							?>
							<li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>media/upload/<?php echo $file_sedang; ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">
									Akuns Saya
									</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
										<img src="<?php echo base_url(); ?>media/upload/<?php echo $file_sedang; ?>" class="img-circle" alt="User Image" />
                    <p>
                      YYY
                      <small>ZZZ <span class="caret"></span></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="<?php echo base_url(); ?>foto_profil">Foto</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="<?php echo base_url(); ?>"><?php echo $this->session->userdata('hak'); ?></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="<?php echo base_url(); ?>">id: <?php echo $this->session->userdata('id_users'); ?></a>
                    </div>
                  </li> 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>ganti_password" class="btn btn-default btn-flat">Ganti Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat">Keluar</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Main content -->
          <section class="content">
            <script type="text/javascript">
              //----------------------------------------------------------------------------------------------
              function reset() {
                $('#toggleCSS').attr('href', '<?php echo base_url(); ?>css/alertify/alertify.default.css');
                alertify.set({
                  labels: {
                    ok: 'OK',
                    cancel: 'Cancel'
                  },
                  delay: 5000,
                  buttonReverse: false,
                  buttonFocus: 'ok'
                });
              }
              //----------------------------------------------------------------------------------------------
            </script>
            <?php $this -> load -> view($main_view);  ?>
          </section><!-- /.content -->
        </div><!-- /.container -->
				<div style="display:none;">

				</div>	
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="pull-right hidden-xs">
            <b>Version</b> 3.0.0 <a target="_blank" href="<?php echo base_url(); ?>manual/manual_sik_v.1.0.docx">&nbsp;</a>
          </div>
          <strong>Copyright <?php //echo $this->session->userdata('id_users'); echo $this->session->userdata('hak'); ?> &copy; <?php echo date('Y'); ?> <a href="#">www.kenzie.co.id</a>.</strong> All rights reserved.
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->
		

		<!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url(); ?>boots/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>boots/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>boots/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>boots/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>boots/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
		<!-- uut -->
		<script src="<?php echo base_url(); ?>js/uut.js"></script>
    
		<!-- alertify -->
		<script src="<?php echo base_url(); ?>js/alertify.min.js"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url(); ?>js/plugins/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/morris/morris.min.js" type="text/javascript"></script>
		<!--- -->
		<script src="<?php echo base_url(); ?>js/colorbox/jquery.colorbox.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-typeahead.js"></script>
    <script src="<?php echo base_url(); ?>js/hogan-2.0.0.js"></script>
		<!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>boots/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
		<script src="<?php echo base_url(); ?>boots/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		
    <script type="text/javascript" src="<?php echo base_url(); ?>boots/dist/js/moment-with-locales.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>boots/dist/js/bootstrap-datetimepicker.js"></script>
    
    <!-- InputMask -->
    <script src="<?php echo base_url(); ?>js/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    
    <script>
      $(function () {
        $("[data-mask]").inputmask();
      });
    </script>
    
		<!-- Start editor-->
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
  </body>
</html>
