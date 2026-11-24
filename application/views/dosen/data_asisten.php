<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Data Asisten</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="#">Config option 1</a>
							</li>
							<li><a href="#">Config option 2</a>
							</li>
						</ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-md-12">
							<div>                                   
								<button class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#myAsisten"> 
									Tambah
								</button>
								<span>
									<?php if($this->session->userdata('info')): ?>
										<div class="alert alert-success">
											<a class="alert-link" href="#"><?= $this->session->userdata('info'); ?></a>.
										</div>
										<?php $this->session->unset_userdata('info'); ?>
									<?php endif; ?>
								</span>
							</div>
<div class="table-responsive">
							<table class="table table-hover margin bottom" id="table-dosen">
								<thead>
									<tr>
										<th class="text-center">No.</th>
										<th>Photo</th>
										<th>NIM</th>
										<th>Nama</th>
										<th>Jenis Kelamin</th>
										<th>Kontak</th>
										<th>Nama Praktek</th>
										<th>Kelompok</th>
										<th>Password</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($asisten as $a): ?>
										<tr>
											<td class="text-center"><?= $no++; ?></td>
											<td><img width="40px" class="img-thumbnail" src="<?= base_url('assets/media/photo/'.$a->photo_asisten); ?>" alt=""></td>
											<td><?= $a->nim_asisten; ?></td>
											<td><?= $a->nama_asisten; ?></td>
											<td><?= $a->jk_asisten; ?></td>
											<td><?= $a->kontak_asisten; ?></td>
											<td><?= $a->judul; ?></td>
											<td><?= $a->kelompok; ?></td>
											<td><?= $a->password_asisten; ?></td>
											<td class="text-center">                                
												<a href="asisten/hapus/<?= $a->id_asisten; ?>" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
											</td>
										</tr>                                                
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr><th></th></tr>
								</tfoot>
							</table>
</div>
						</div>
                        <!-- <div class="col-lg-6">
                            <div id="world-map" style="height: 300px;"></div>
                         </div> -->
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>        

       <!-- Modal Tambah Asistent -->
       <div class="modal inmodal" id="myAsisten" tabindex="-1" role="dialog" aria-hidden="true">
       	<div class="modal-dialog">
       		<div class="modal-content animated bounceInRight">
       			<div class="modal-header">                
       				<h4 class="modal-title">Tambah Asistent</h4>                
       			</div>
       			<div class="modal-body">
       				<?= form_open_multipart('asisten/tambahAsisten','class="form-horizontal"'); ?>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">NIM</label>
       					<div class="col-sm-10">
       						<input type="text" name="nim" id="nim" class="form-control" required="">
       					</div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Nama Asisten</label>
       					<div class="col-sm-10">
       						<input type="text" name="nama" id="nama" class="form-control" required="">
       					</div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Praktek</label>
       					<div class="col-sm-10">
       						<select name="jadwal" class="form-control">
       							<?php foreach ($praktek as $p): ?>
       								<option value="<?= $p->id_jadwal_praktek ?>"><?= $p->judul; ?></option>
       							<?php endforeach ?>           
       						</select>
       					</div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Jenis Kelamin</label>
       					<div class="col-sm-10">
       						<select name="jk" class="form-control">
       							<option value="Laki-laki">Laki-laki</option>
       							<option value="Perempuan">Perempuan</option>
       						</select>
       					</div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Kontak</label>
       					<div class="col-sm-10"><input type="number" name="kontak" class="form-control"></div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Nama Kelompok</label>
       					<div class="col-sm-10"><input type="text" name="kelompok" class="form-control"></div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Photo</label>
       					<div class="col-sm-10"><input type="file" name="photo" class="form-control"></div>
       				</div>
       			</div>
       			<div class="modal-footer">
       				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
       				<button type="submit" class="btn btn-primary">Submit</button>
       			</div>
       			<?= form_close(); ?>
       		</div>
       	</div>
       </div>
<!-- .Modal Tambah Asistent -->