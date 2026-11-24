<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Mahasiswa</h5>
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
                        <?php if ($this->session->userdata('level') === 'admin'): ?>
                                <button class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#myModalMahasiswa"> 
                                    Tambah
                                </button>
                        <?php endif; ?>                         
                                <span>
                                    <?php if($this->session->userdata('info')): ?>
                                        <div class="alert alert-success">
                                            Data. <a class="alert-link" href="#"><?= $this->session->userdata('info'); ?></a>.
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
                                        <th>Semester</th>        
                                        <th>Password</th>        
                                        <th>Alamat</th>        
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mahasiswa as $mhs): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>
                                                <img width="40px" class="img-thumbnail" src="<?= base_url('assets/media/photo/').$mhs->foto_mahasiswa; ?>">
                                            </td>
                                            <td><?= $mhs->nim; ?></td>
                                            <td><?= $mhs->nama_mahasiswa; ?></td>
                                            <td><?= $mhs->jk_mahasiswa; ?></td>
                                            <td><?= $mhs->semester; ?></td>
                                            <td><?= $mhs->password; ?></td>
                                            <td><?= $mhs->alamat_mahasiswa; ?></td>
                                            <td>
                                                <a href="hapus/<?= $mhs->id_mahasiswa; ?>" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
                                            </td>
                                        </tr>                                                
                                    <?php endforeach ?>
                                </tbody>
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
<!-- Modal Tambah Dosen -->
<div class="modal inmodal" id="myModalMahasiswa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header bg-primary">                
                <h4 class="modal-title">Tambah Mahasiswa</h4>                
            </div>
            <div class="modal-body">
                <?= form_open_multipart('mahasiswa/tambahMahasiswa','class="form-horizontal"'); ?>          
                <div class="form-group">
                    <label class="col-sm-2 control-label">NIM</label>
                    <div class="col-sm-10"><input type="text" name="nim" class="form-control"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10"><input type="text" name="nama" class="form-control"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Semester</label>
                    <div class="col-sm-10"><input type="text" name="semester" class="form-control"></div>
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
                    <label class="col-sm-2 control-label">Photo</label>
                    <div class="col-sm-10"><input type="file" name="photo" class="form-control"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10"><textarea name="alamat" cols="30" rows="5" class="form-control"></textarea></div>
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
<!-- .Modal Tambah Dosen -->