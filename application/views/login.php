<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>KEYZIE</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>boots/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>boots/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>boots/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>boots/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

 <style>
    html,
    body {
      min-height: 100%;
    }
    
    #body {
      background-image: url(<?php echo base_url(); ?>backgraundcpanel.jpg);
       
	  background-repeat:no-repeat;
      background-position:top center;
      padding-top:100px;
      background-size: 100% auto;
	  	  
    }
    
    @media (min-width: 1120px),
    (min-height: 800px) {
      body {
        background-size: auto;
      }
    }
    
    #hed {
      background-color: #EEE8AA;
      border: 1px solid black;
      opacity: 0.4;
      font-weight: bold;
      color: blue;
      font: bold 52px Helvetica, Arial, Sans-Serif;
      text-shadow: 1px 1px #fe4902, 2px 2px #fe4902, 3px 3px #fe4902;
      padding: 40px 0 70px 0;
      text-align: center;
      filter: alpha(opacity=60);
      /* For IE8 and earlier */
    }
    
    #hed:hover {
      position: relative;
      top: -3px;
      left: -3px;
      text-shadow: 1px 1px #fe4902, 2px 2px #fe4902, 3px 3px #fe4902, 4px 4px #fe4902, 5px 5px #fe4902, 6px 6px #fe4902;
    }
  </style>


  </head>
  <body id="body" class="login-page">
<br>


    <div class="login-box">
		<div class="box box-danger box-solid">
			<div class="alert alert-danger alert-dismissable" id="tunggu_redirect" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Mohon Tunggu !</h4>
				<div id="error2"></div>Anda akan diarahkan ke dashboard
			</div>




      <div class="login-box-body" id="box_login">
        <form action="#" method="post">
					<div class="alert alert-warning alert-dismissable" id="loading_login" style="display:none;">
						<h4><i class="fa fa-refresh fa-spin"></i> Mohon tunggu....</h4>
					</div>
					<div class="alert alert-danger alert-dismissable" id="login_error" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Error !</h4>
						<div id="pesan_error"></div>
					</div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="user_name" placeholder="User Name"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>									
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" id="login_submit">Sign In</button>
            </div><!-- /.col -->

          </div>

<br>
              	<li><a href="<?php echo base_url(); ?>buku_manual_web.pdf" target="_blank">KLIK UNTUK DOWNLOAD BUKU MANUAL</a></li>
                    <li><a href="https://dpmptsp.wonosobokab.go.id/Video_panduan/Video_panduan_web_dpmptsp.ogv" target="_blank">KLIK UNTUK DOWNLOAD VIDEO PANDUAN</a></li>

        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
		</div>	
<script type="text/javascript">
  $(document).ready(function () {
            $("#login_submit").on("click", function(e){
            e.preventDefault();
						$('#login_error').hide();
						$('#loading_login').show();
						var user_name = $("#user_name").val();
						var password = $("#password").val();
            $.ajax({
                    type: "POST",
                    async: true, 
                    data: { 
														user_name:user_name,
														password:password
                          }, 
                    dataType: "json",
										url: '<?php echo base_url(); ?>login/proses_login',   
										success: function(json) {
												var trHTML = '';
												for (var i = 0; i < json.length; i++) {   
													if(json[i].errors == 'form_kosong')
														{
															$('#loading_login').fadeOut( "slow" );
															$('#login_error').show();
															$('#pesan_error').html('Mohon isi data secara lengkap');
															if(json[i].user_name == ''){ $('#user_name').css('background-color','#DFB5B4'); } else { $('#user_name').removeAttr( 'style' ); }
															if(json[i].password == ''){ $('#password').css('background-color','#DFB5B4'); } else { $('#password').removeAttr( 'style' ); }
														}	  
													else if(json[i].errors == 'user_tidak_ada')
														{
															$('#loading_login').fadeOut( "slow" );
															$('#login_error').show();
															$('#pesan_error').html('Data login anda salah');
															if(json[i].user_name == ''){ $('#user_name').css('background-color','#DFB5B4'); } else { $('#user_name').removeAttr( 'style' ); }
															if(json[i].password == ''){ $('#password').css('background-color','#DFB5B4'); } else { $('#password').removeAttr( 'style' ); }
														}  
													else if(json[i].errors == 'miss_match')
														{
															$('#loading_login').fadeOut( "slow" );
															$('#login_error').show();
															$('#pesan_error').html('Data login anda salah');
															if(json[i].user_name == ''){ $('#user_name').css('background-color','#DFB5B4'); } else { $('#user_name').removeAttr( 'style' ); }
															if(json[i].password == ''){ $('#password').css('background-color','#DFB5B4'); } else { $('#password').removeAttr( 'style' ); }
														}	
													else
														{	
															$('#error2').html('Pesan : '+json[i].errors+'');
															$('#box_login').hide();
															$('#tunggu_redirect').show();		
															window.location = "<?php echo base_url(); ?>posting";
														}
													}
											}
                });
          });
  });
</script>
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url(); ?>boots/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>boots/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>boots/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>