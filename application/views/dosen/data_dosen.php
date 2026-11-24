<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Dosen</h5>
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
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kontak</th>
                                        <th>Password</th>
                                        <th>Alamat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dosen as $dosen): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><img width="40px" class="img-thumbnail" src="<?= base_url('assets/media/photo/'.$dosen->foto_dosen); ?>" alt=""></td>
                                            <td><?= $dosen->nidn; ?></td>
                                            <td><?= $dosen->nama_dosen; ?></td>
                                            <td><?= $dosen->jk_dosen; ?></td>
                                            <td><?= $dosen->kontak; ?></td>
                                            <td><?= $dosen->password; ?></td>
                                            <td><?= $dosen->alamat_dosen; ?></td>
                                            <td class="text-center">                                                
                                                <a href="hapus/<?= $dosen->id_dosen; ?>" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
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

<!-- Modal Tambah Dosen -->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">                
                <h4 class="modal-title">Tambah Dosen</h4>                
            </div>
            <div class="modal-body">
                <?= form_open_multipart('dosen/tambahDosen','class="form-horizontal"'); ?>          
                <div class="form-group">
                    <label class="col-sm-2 control-label">NIP</label>
                    <div class="col-sm-10"><input type="text" name="nidn" class="form-control"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10"><input type="text" name="nama" class="form-control"></div>
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