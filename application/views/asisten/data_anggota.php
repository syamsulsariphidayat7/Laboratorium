<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Anggota</h5>
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
                                <button class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#myModal"> 
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
                            <table class="table table-hover table-responsive-md margin bottom" id="table-dosen">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Nama kelompok</th>
                                        <th>Judul Praktikum</th>
                                        <th>Nama Asisten</th>                                            
                                        <th>Dosen Pembimbing</th>
                                        <th>Nama Anggota</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($anggota as $ang): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $ang->kelompok; ?></td>
                                            <td><?= $ang->judul; ?></td>
                                            <td><?= $ang->nama_asisten; ?></td>
                                            <td><?= $ang->nama_dosen; ?></td>
                                            <td><?= $ang->nama_mahasiswa; ?></td>                                                
                                            <td class="text-center">                                                
                                                <a href="anggota/hapus/<?= $ang->id_anggota; ?>" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
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
<!-- Modal Tambah anggota -->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">                
                <h4 class="modal-title">Tambah Anggota</h4>                
            </div>
            <div class="modal-body">
                <!-- data mahasiswa -->                
               <div class="row">
                   <div class="col-md-12">                       
                       <div class="table-responsive">          
                       <table class="table table-hover" id="table-addAsisten">
                           <thead>
                               <tr>
                                   <th class="text-center">No.</th>        
                                   <th>Photo</th>        
                                   <th>NIM</th>        
                                   <th>Nama</th>                                   
                                   <th>Semester</th>                                   
                                   <th class="text-center">Aksi</th>
                               </tr>
                           </thead>
                           <tbody>
                             	<?php $nomor=1; ?>
                               <?php foreach ($mahasiswa as $mhs): ?>
                                   <tr>
                                       <td><?= $nomor++; ?></td>
                                       <td>
                                           <img width="40px" class="img-thumbnail" src="<?= base_url('assets/media/photo/').$mhs->foto_mahasiswa; ?>">
                                       </td>
                                       <td><?= $mhs->nim; ?></td>
                                       <td><?= $mhs->nama_mahasiswa; ?></td>
                                       <td><?= $mhs->semester; ?></td>
                                       <td class="text-center">
                                           <a href="anggota/tambahAnggota/<?= $mhs->nim; ?>" class="btn btn-primary btn-xs fa fa-plus"> Tambahkan</a>
                                       </td>
                                   </tr>                                                
                               <?php endforeach ?>
                           </tbody>
                       </table>
                       </div>
                   </div>
                </div>
                <!-- .data mahasiswa -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>                
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- .Modal Tambah anggota