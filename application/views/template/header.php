<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $title; ?></title>
	<link rel="shortcut icon" href="<?= base_url('assets/media/logo/logo.png'); ?>">

	<link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet">
	<!-- Morris -->
	<link href="<?= base_url('assets/'); ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
	<!-- Gritter -->
	<link href="<?= base_url('assets/'); ?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
	<link href="<?= base_url('assets/'); ?>css/animate.css" rel="stylesheet">
	<link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet">
	<!-- Data Tables -->
	<link href="<?= base_url('assets/'); ?>css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
	<link href="<?= base_url('assets/'); ?>css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
	<link href="<?= base_url('assets/'); ?>css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<!-- My CSS -->
	<link href="<?= base_url('assets/'); ?>css/mystyle.css" rel="stylesheet">       
</head>

<body>
	<div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element text-center">
							<span>
								<?php if (file_exists('./assets/media/photo/'.$this->session->userdata('photo')) && $this->session->userdata('photo') != null): ?>
								<img alt="image" width="100px" class="img-thumbnail" src="<?= base_url('assets/media/photo/'.$this->session->userdata('photo')); ?>" />
								<?php else: ?>
									<img alt="image" width="100px" class="img-thumbnail" src="<?= base_url('assets/media/photo/user.png'); ?>" />
								<?php endif ?>
							</span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $this->session->userdata('nama'); ?></strong>
								</span> <span class="text-muted text-xs block text-capitalize"><?= $this->session->userdata('level'); ?> <b class="caret"></b></span> </span> </a>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a href="" data-toggle="modal" data-target="#myModal2">Ubah Password</a></li>
									<li><a href="" data-toggle="modal" data-target="#ubahPhoto">Ubah Photo</a></li>
									<li class="divider"></li>
									<li><a href="<?= base_url('auth/getlogout'); ?>">Logout</a></li>
								</ul>
							</div>
							<div class="logo-element">
								LPKFTK                              
			             <ul class="nav" id="side-menu">
			             	<li>
			             		<a href="index.html"><i class="fa fa-gear"></i></a>
			             		<ul class="nav nav-second-level">              
			             			<li><a href="" data-toggle="modal" data-target="#myModal2"><i class="fa fa-key"></i> Password</a></li>
										<li><a href="" data-toggle="modal" data-target="#ubahPhoto"><i class="fa fa-image"></i> Photo</a></li>
										<li><a href="<?= base_url('auth/getlogout'); ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
			             		</ul>
			             	</li>
			             </ul>
          </div>            
       </li>
       <li>
       	<a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
       	<ul class="nav nav-second-level">              
       		<li><a href="<?= base_url(); ?>"><i class="fa fa-circle-o"></i> Home</a></li>
       	</ul>
       </li>
       <li>
       	<a href="index.html"><i class="fa fa-building fa-lg"></i> <span class="nav-label">Fasilitas</span> <span class="fa arrow"></span></a>
       	<ul class="nav nav-second-level"><li><a href="<?= base_url('fasilitas/getFasilitas'); ?>"><i class="fa fa-circle-o"></i> Fasilitas</a></li></ul>
       </li>
       <?php if ($this->session->userdata('level') == 'dosen' || $this->session->userdata('level') == 'mahasiswa'): ?>
       <li>
       	<a href="index.html"><i class="fa fa-calendar fa-large"></i> <span class="nav-label">Jadwal</span> <span class="fa arrow"></span></a>
       	<ul class="nav nav-second-level">         
       		<?php if ($this->session->userdata('level') == 'dosen'): ?>
       			<li><a href="<?= base_url('jadwal'); ?>"><i class="fa fa-circle-o"></i> Jadwal</a></li>
       			<?php elseif ($this->session->userdata('level') == 'mahasiswa'): ?>
       				<li><a href="<?= base_url('jadwal/getJadwalMahasiswa'); ?>"><i class="fa fa-circle-o"></i>Jadwal</a></li>
       			<?php endif; ?>
       		</ul>
       	</li>
       <?php endif; ?>
       <?php if ($this->session->userdata('level') == 'admin'): ?>
       	<li>
       		<a href="index.html"><i class="fa fa-user fa-lg"></i> <span class="nav-label">Dosen</span> <span class="fa arrow"></span></a>
       		<ul class="nav nav-second-level">
       			<li><a href="<?= base_url('dosen/getdosen'); ?>"><i class="fa fa-circle-o"></i> Dosen</a></li>
       		</ul>
       	</li>                    
       	<li>
       		<a href="index.html"><i class="fa fa-user fa-lg"></i> <span class="nav-label">Mahasiswa</span> <span class="fa arrow"></span></a>
       		<ul class="nav nav-second-level"><li><a href="<?= base_url('mahasiswa/getmahasiswa'); ?>"><i class="fa fa-circle-o"></i> Mahasiswa</a></li></ul>
       	</li>
       	<li>
       		<a href="index.html"><i class="fa fa-book fa-lg"></i> <span class="nav-label">Mata Kuliah</span> <span class="fa arrow"></span></a>
       		<ul class="nav nav-second-level"><li><a href="<?= base_url('Matkul/getMatkul'); ?>"><i class="fa fa-circle-o"></i> Mata Kuliah</a></li></ul>
       	</li>
       	<?php elseif($this->session->userdata('level') == 'dosen'): ?>
       		<li>
       			<a href="index.html"><i class="fa fa-users fa-large"></i> <span class="nav-label">Asisten</span> <span class="fa arrow"></span></a>
       			<ul class="nav nav-second-level">                            
       				<li><a href="<?= base_url('asisten') ?>"><i class="fa fa-circle-o"></i> Asisten</a></li>
       			</ul>
       		</li>
       		<li>
       			<a href="index.html"><i class="fa fa-calculator fa-large"></i> <span class="nav-label">Penilaian</span> <span class="fa arrow"></span></a>
       			<ul class="nav nav-second-level">                            
       				<li><a href="<?= base_url('portofolio/') ?>getPortofolio"><i class="fa fa-circle-o"></i> Portofolio</a></li>
       				<li><a href="<?= base_url('portofolio/') ?>getNilai"><i class="fa fa-circle-o"></i> Nilai</a></li>
       			</ul>
       		</li>
       		<?php elseif($this->session->userdata('level') == 'asisten'): ?>
       			<li>
       				<a href="index.html"><i class="fa fa-users fa-large"></i> <span class="nav-label">Anggota</span> <span class="fa arrow"></span></a>
       				<ul class="nav nav-second-level">                            
       					<li><a href="<?= base_url('anggota'); ?>"><i class="fa fa-circle-o"></i> Anggota</a></li>
       				</ul>
       			</li>
       			<li>
       				<a href="index.html"><i class="fa fa-calculator fa-large"></i> <span class="nav-label">Penilaian</span> <span class="fa arrow"></span></a>
       				<ul class="nav nav-second-level">                            
       					<li><a href="<?= base_url('portofolio/') ?>getPortofolioAsisten"><i class="fa fa-circle-o"></i> Portofolio</a></li>
       					<li><a href="<?= base_url('portofolio/') ?>getNilaiAsisten"><i class="fa fa-circle-o"></i> Nilai</a></li>
       				</ul>
       			</li>
       			<?php elseif($this->session->userdata('level') == 'mahasiswa'): ?>          
       				<li>
       					<a href="index.html"><i class="fa fa-dashboard fa-large"></i> <span class="nav-label">Portofolio</span> <span class="fa arrow"></span></a>
       					<ul class="nav nav-second-level">                            
       						<li><a href="<?= base_url('portofolio') ?>"><i class="fa fa-circle-o"></i> Portofolio</a></li>
       						<li><a href="<?= base_url('portofolio/') ?>getNilaiMahasiswa"><i class="fa fa-circle-o"></i> Data Nilai</a></li>
       					</ul>
       				</li>
       			<?php endif; ?>
       			<li class="landing_link">
       				<a target="_blank" href="https://uinsgd.ac.id"><i class="fa fa-university"></i> <span class="nav-label">UIN SGD</span> <span class="label label-warning pull-right">Web</span></a>
       			</li>       			
       			<li class="special_link">
       				<a target="_blank" href="http://docs.google.com/viewer?url=<?= site_url();?>assets/media/document/panduan.pdf"><i class="fa fa-question-circle"></i> <span class="nav-label">Panduan</span></a>
       			</li>       			
       		</ul>

       	</div>
       </nav>
       <div id="page-wrapper" class="gray-bg">
       	<div class="row border-bottom">
       		<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
       			<div class="navbar-header">
       				<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
       			</div>
       			<ul class="nav navbar-top-links navbar-right">
       				<li>
       					<span class="m-r-sm text-muted welcome-message"><strong class="text-uppercase">Laboratorium Pendidikan Kimia Fakultas Tarbiyah Dan Keguruan</strong></span>
       				</li>          
       				<li>
       					<a href="<?= base_url('auth/getlogout'); ?>"><i class="fa fa-sign-out"></i> Log out</a>
       				</li>
       			</ul>

       		</nav>
       	</div>
       	<!-- wrapper wrapper-content -->
       	<!-- isi -->
       	<div class="wrapper wrapper-content">      
       		<div class="row wrapper border-bottom white-bg page-heading">
       			<div class="col-lg-12">
       				<h2 class="text-capitalize">
       					<?php if ($this->uri->segment(1) === 'Admin') : ?>
       						Dashboard
       						<?php else: ?>                    
       							<?php if ($this->uri->segment(1) === 'Matkul'): ?>
       								Mata Kuliah
       								<?php else: ?>                    
       									<?= $this->uri->segment(1); ?>
       								<?php endif ?>
       							<?php endif ?>
       						</h2>
       						<ol class="breadcrumb">
       							<li>
       								<a href="<?= base_url(); ?>">Home</a>
       							</li>                
       							<li class="active">
       								<strong><?= $title; ?></strong>
       							</li>
       						</ol>
       					</div>        
       				</div>      