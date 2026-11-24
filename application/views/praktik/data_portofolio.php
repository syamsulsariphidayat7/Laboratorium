<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Data Portofolio</h5>
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
								<?php if ($this->session->userdata('level') === 'mahasiswa'): ?>
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
								<table class="table table-hover margin bottom nilai" id="table-dosen">
									<thead>
										<tr>
											<th class="text-center">No.</th>
											<th>Nama kelompok</th>
											<th>Nama Mahasiswa</th>
											<th>Judul Praktikum</th>
											<th>File Jurnal</th>                        
											<th>File Praktik</th>
											<th>File Laporan</th>                       
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>     
										<?php foreach ($portofolio as $prt): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $prt->kelompok; ?></td>
												<td><?= $prt->nama_mahasiswa; ?></td>
												<td><?= $prt->judul; ?></td>
												<td>													
													<?php if ($prt->jurnal): ?>
														<a target="_blank" href="http://docs.google.com/viewer?url=<?= site_url(); ?>assets/media/portofolio/<?= $prt->jurnal; ?>"><i class="fa fa-book"></i> Jurnal</a>
														<?php else: ?>
															<span class="label label-danger">file jurnal kosong</span>
														<?php endif ?>
													</td>
													<td>
														<?php if ($prt->praktek): ?>
															<a class="btn btn-info btn-xs" id="tombolVideo" data-putar="<?= site_url(); ?>assets/media/portofolio/<?= $prt->praktek; ?>" data-toggle="modal" data-target="#myVideo">
																<i class="fa fa-file-video-o"></i> Documentasi
															</a>                                            
															<?php else: ?>
																<span class="label label-danger">file praktek kosong</span>
															<?php endif ?>
														</td>
														<td>
															<?php if ($prt->laporan): ?>
																<a target="_blank" href="http://docs.google.com/viewer?url=<?= site_url(); ?>assets/media/portofolio/<?= $prt->laporan; ?>"><i class="fa fa-book"></i> Laporan</a>
																<?php else: ?>
																	<span class="label label-danger">file laporan kosong</span>
																<?php endif ?>
															</td>
															<td>
																<?php if ($prt->status === '1'): ?>
																	<span class="label label-primary">Sudah Dinilai</span>
																	<?php else: ?>
																		<?php if ($this->session->userdata('level') != 'mahasiswa'): ?>
																			<button id="form-nilai" data-toggle="modal" data-target="#myModalNilai" class="btn btn-warning btn-xs fa fa-edit" data-idprt="<?= $prt->id_portofolio; ?>" data-idanggota="<?= $prt->id_anggota; ?>" data-iddosen="<?= $prt->id_dosen; ?>" data-mk="<?= $prt->id_mata_kuliah; ?>" data-jadwal="<?= $prt->id_jadwal_praktek; ?>"> Form Nilai</button>
																			<?php else: ?>
																				<span class="label label-success">Belum Dinilai</span>
																				<a onclick="return confirm('Anda yakin?')" href="portofolio/hapus/<?= $prt->id_portofolio; ?>" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
																			<?php endif ?>
																		<?php endif ?>                                                
																	</td>                                            													
																</tr>															
															<?php endforeach; ?>
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
       				<h4 class="modal-title">Portofolio</h4>                
       				<p>Silahkan Lengkapi Data</p>
       			</div>
       			<div class="modal-body">
       				<?= form_open_multipart('portofolio/tambahPortofolio','class="form-horizontal"'); ?>                
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Judul Praktek</label>
       					<div class="col-sm-10">
       						<select name="asisten" id="ambilIdAnggota" class="form-control" required="">
       							<option value="">-- Pilih --</option>
       							<?php foreach ($anggota as $ang): ?>
       								<option value="<?= $ang->id_asisten; ?>" idAng="<?= $ang->id_anggota; ?>"><?= $ang->judul; ?></option>
       							<?php endforeach; ?>
       						</select>
       					</div>
       				</div>
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Jurnal</label>
       					<div class="col-sm-10">
       						<input type="hidden" name="idanggota" id="idanggota">
       						<input type="file" name="jurnal" class="form-control">
       						<p>Type File : doc/docx/pdf</p>
       					</div>
       				</div>                
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Laporan</label>
       					<div class="col-sm-10">
       						<input type="file" name="laporan" class="form-control">    
       						<p>Type File : doc/docx/pdf</p>
       					</div>
       				</div>                
       				<div class="form-group">
       					<label class="col-sm-2 control-label">Video/ Image</label>
       					<div class="col-sm-10">
       						<input type="file" name="media" class="form-control">    
       						<p>Type File : mp4/mkv/mpeg/jpg/png/jpeg</p>
       					</div>
       				</div>
       			</div>
       			<div class="modal-footer">
       				<button type="submit" class="btn btn-primary">Submit</button>
       				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
       			</div>
       			<?= form_close(); ?>
       		</div>
       	</div>
       </div>
       <!-- .Modal Tambah Dosen	-->
       <!-- Modal Putar -->
       <div class="modal inmodal fade" id="myVideo" tabindex="-1" role="dialog"  aria-hidden="true">
       	<div class="modal-dialog modal-lg">
       		<div class="modal-content">
       			<div class="modal-header">
       				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       				<h4 class="modal-title">Documentasi</h4>                                            
       			</div>
       			<div class="modal-body">
       				<div id="isiMedia" class="text-center"></div>       				
       			</div>

       			<div class="modal-footer">
       				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
       			</div>
       		</div>
       	</div>
       </div>
       <!-- .Modal Putar -->
