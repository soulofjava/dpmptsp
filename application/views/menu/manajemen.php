<ul class="nav navbar-nav">
	<li><a href="<?php echo base_url(); ?>komponen">Komponen</a></li>
	<li><a href="<?php echo base_url(); ?>posting">Posting</a></li>
	<li><a href="<?php echo base_url(); ?>saran">Kotak Saran</a></li>
  	<li class="dropdown">
	    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book"></i> BUKU AGENDA<span class="caret"></span></a>
	    <ul class="dropdown-menu" role="menu">
		    <li><a href="<?php echo base_url(); ?>surat/?id_kelembagaan=3&jenis_surat=surat_masuk"><i class="fa fa-envelope"></i> Surat Masuk </a></li>
		    <li><a href="<?php echo base_url(); ?>surat/?id_kelembagaan=3&jenis_surat=surat_keluar"><i class="fa fa-envelope-o"></i> Surat Keluar </a></li>
	    </ul>
  	</li>
</ul>