<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-4">
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
		<div class="col-lg-4">
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
		<div class="col-lg-4">
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
	</div>                
	<div class="row">
		<div class="col-lg-8">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div>						
						<span class="pull-right text-right">
                   <h3 class="font-bold no-margins">Bahan</h3>
	               </span>
						<h3 class="font-bold no-margins">Alat</h3>
					</div>

					<div class="m-t-sm">
						<div class="row">
							<div class="col-xs-6">
								<ul class="list-group">
									<?php foreach ($fasilitasAlat as $alat): ?>
									  <li class="list-group-item d-flex justify-content-between align-items-center">
									    <?= $alat->fasilitas; ?>
									    <span class="badge badge-primary badge-pill"><?= $alat->jumlah; ?></span>
									  </li>						  
									<?php endforeach ?>
								</ul>
							</div>
							<div class="col-xs-6">
								<ul class="list-group">
								  <?php foreach ($fasilitasBahan as $bahan): ?>
									  <li class="list-group-item d-flex justify-content-between align-items-center">
									    <?= $bahan->fasilitas; ?>
									    <span class="badge badge-primary badge-pill"><?= $bahan->jumlah; ?></span>
									  </li>						  
									<?php endforeach ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-warning pull-right"><?= $jadwal; ?></span>
					<h5>Jadwal Praktik</h5>
				</div>
				<div class="ibox-content">
					<div class="row">
						<?php $no=1; ?>
						<?php foreach ($jadwal_praktik as $j): ?>
							<div class="col-xs-12">
								<small class="stats-label"><?= $no++; ?>. <?= $j->judul; ?></small>
								<span class="pull-right"><?= date('l, d M Y | H:i:s',strtotime($j->jadwal_praktek)); ?></span>
								<hr>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>