<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Data</span>
					<h5>Dosen</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins"><?= $dosen; ?> Orang</h1>
					<div class="stat-percent font-bold text-success">* <i class="fa fa-users"></i></div>
					<small>Jumlah Dosen</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-info pull-right">Data</span>
					<h5>Praktikan</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins"><?= $praktikan; ?> Orang</h1>
					<div class="stat-percent font-bold text-info">* <i class="fa fa-users"></i></div>
					<small>Jumlah Praktikan</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-primary pull-right">Data</span>
					<h5>Portofolio</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins"><?= $portofolio; ?> Portofolio</h1>
					<div class="stat-percent font-bold text-navy">* <i class="fa fa-file"></i></div>
					<small>Jumlah Portofolio</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-warning pull-right">Data</span>
					<h5>Jadwal</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins"><?= $jadwal; ?> Praktik</h1>
					<div class="stat-percent font-bold text-warning">* <i class="fa fa-calendar"></i></div>
					<small>Jumlah Jadwal Praktek</small>
				</div>
			</div>
		</div>
	</div>       
	<div class="row">
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Portofolio Photo</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>						
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="carousel slide" id="carousel1">
						<div class="carousel-inner">
							<div class="item active">
								<img alt="image" class="img-responsive" src="./assets/media/portofolio/default.png">
							</div>							
							<?php foreach ($docPhoto as $photo): ?>
								<div class="item">
									<img alt="image" class="img-responsive" src="./assets/media/portofolio/<?= $photo; ?>">
								</div>							
							<?php endforeach ?>
						</div>
						<a data-slide="prev" href="#carousel1" class="left carousel-control">
							<span class="icon-prev"></span>
						</a>
						<a data-slide="next" href="#carousel1" class="right carousel-control">
							<span class="icon-next"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Portofolio Video</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>						
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="lightBoxGallery">
						<div class="row">
							<?php foreach ($docVideo as $video): ?>
								<div class="col-md-4">
									<small><?= $video; ?></small>									
									<video id="putarVideoDashboard" controls="" src="./assets/media/portofolio/<?= $video; ?>"></video>
								</div>							
							<?php endforeach ?>
						</div>
					</div>						
			</div>
		</div>
	</div>

	<div class="row">                                        
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5 class="text-center">Tentang Website</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-content text-center p-md">
									<span>
										<?php if($this->session->userdata('info')): ?>
											<div class="alert alert-warning">
												<a class="alert-link" href="#"><strong><?= $this->session->userdata('info'); ?></a>.</strong>
											</div>
											<?php $this->session->unset_userdata('info'); ?>
										<?php endif; ?>
									</span>
									<h2><span class="text-navy">LPKFTK</span>
										LABORATORIUM PENDIDIKAN KIMIA FAKULTAS TARBIYAH DAN KEGURUAN<br/></h2>
										<h3 class="text-capitallize">UIN Sunan Gunung Djati Bandung</h3>
										<p>
											Jalan Cimencrang, Panyileukan, Cimencrang, Gedebage, Kota Bandung, Jawa Barat 4029247.
										</p>
									</div>
								</div>
							</div>                        
						</div>
					</div>
				</div>
			</div>                
		</div>
	</div>