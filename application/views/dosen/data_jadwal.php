<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Data Jadwal</h5>
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
								<?php if ($this->session->userdata('level') == 'dosen'): ?>
									<button class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#myModal"> 
										Tambah
									</button>
								<?php endif ?>
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
											<th>Nama Dosen</th>
											<?php if ($this->session->userdata('level') == 'mahasiswa'): ?>
												<th>Nama Asisten</th>
											<?php endif; ?>
											<th>Mata Kuliah</th>
											<th>Judul</th>
											<th>Jadwal Praktik</th>
											<th>Modul</th>
											<?php if ($this->session->userdata('level') == 'dosen' || $this->session->userdata('level') == 'asisten'): ?>
											<th class="text-center">Aksi</th>
										<?php endif; ?>                                               
									</tr>
								</thead>
								<tbody>
									<?php foreach ($jadwal as $jdl): ?>
										<tr>
											<td class="text-center"><?= $no++; ?></td>
											<td><?= $jdl->nama_dosen; ?></td>
											<?php if ($this->session->userdata('level') == 'mahasiswa'): ?>
												<td><?= $jdl->nama_asisten; ?></td>
											<?php endif; ?>
											<td><?= $jdl->nama_mata_kuliah; ?></td>
											<td><?= $jdl->judul; ?></td>
											<td><?= $jdl->jadwal_praktek; ?></td>
											<td>
												<a class="btn btn-info btn-xs fa fa-print" target="_blank" href="http://docs.google.com/viewer?url=<?= site_url();?>assets/media/document/<?= $jdl->modul; ?>"> Preview</a>
											</td>
												<td class="text-center">
													<?php if ($this->session->userdata('level') == 'dosen' || $this->session->userdata('level') == 'asisten'): ?>
													<a href="jadwal/hapus/<?= $jdl->id_jadwal_praktek; ?>" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>                          
												<?php endif; ?>                                               
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
       <!-- Modal Tambah jadwal -->
       <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
       	<div class="modal-dialog">
       		<div class="modal-content animated bounceInRight">
       			<div class="modal-header">                
       				<h4 class="modal-title">Tambah Jadwal Praktikum</h4>                
       			</div>
       			<div class="modal-body">
       				<?= form_open_multipart('jadwal/tambahJadwal','class="form-horizontal"'); ?>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Mata Kuliah</label>                    
       					<div class="col-sm-10">
       						<select name="matkul" class="form-control">
       							<?php foreach ($matakuliah as $matkul): ?>
       								<option value="<?= $matkul->id_mata_kuliah; ?>"><?= $matkul->nama_mata_kuliah; ?></option>
       							<?php endforeach; ?>
       						</select>
       					</div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Judul Praktik</label>                    
       					<div class="col-sm-10"><input type="text" name="judul" maxlength="45" class="form-control" required=""></div>
       				</div>
       				<div class="form-group">
       					<label for="meeting-time" class="col-sm-2 control-label">Tanggal</label>
       					<div class="col-sm-10"><input type="datetime-local" name="tanggal" class="form-control" required=""></div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Modul</label>
       					<div class="col-sm-10"><input type="file" name="modul" class="form-control" required=""></div>
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
<!-- .Modal Tambah Dosen