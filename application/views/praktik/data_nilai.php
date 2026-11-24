<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Data Penilaian</h5>
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
											<th>Nama kelompok</th>
											<th>Asisten Praktek</th>
											<th>Kontak Asisten</th>
											<th>Mahasiswa</th>      
											<th>Judul Praktikum</th>
											<th>Nilai Jurnal</th>                                            
											<th>Nilai Praktik</th>
											<th>Nilai Laporan</th>
											<th>Rata-rata</th>
											<th>Ulasan</th>
											<?php if ($this->session->userdata('level') != 'mahasiswa'): ?>
												<th class="text-center">Aksi</th>                                                
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($nilai as $n): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $n->kelompok; ?></td>
												<td><?= $n->nama_asisten; ?></td>
												<td><?= $n->kontak_asisten; ?></td>
												<td><?= $n->nama_mahasiswa; ?></td>
												<td><?= $n->judul; ?></td>
												<td><?= $n->nilai_jurnal; ?></td>
												<td><?= $n->nilai_praktek; ?></td>
												<td><?= $n->nilai_laporan; ?></td>
												<td><?= $n->rata_rata; ?></td>
												<td><?= $n->ulasan; ?></td>
												<?php if ($this->session->userdata('level') != 'mahasiswa'): ?>
													<td>
														<a onclick="return confirm('Yakin hapus data penilaian');" href="hapusNilai/<?= $n->id_nilai; ?>/<?= $n->id_portofolio; ?>" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
													</td>
												<?php endif ?>
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
<!-- </div>