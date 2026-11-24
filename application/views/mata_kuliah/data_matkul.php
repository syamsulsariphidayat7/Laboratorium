<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Fasilitas</h5>
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
                                <button class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#myModalMatkul"> 
                                    Tambah
                                </button>
                        <?php endif; ?>                         
                                <span>
                                    <?php if($this->session->userdata('info')): ?>
                                        <div class="alert alert-success">
                                            <a class="alert-link" href="#"><?= $this->session->userdata('info'); ?></a>
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
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Dosen</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($matakuliah as $matkul): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $matkul->kode_mata_kuliah; ?></td>
                                            <td><?= $matkul->nama_mata_kuliah; ?></td>
                                            <td><?= $matkul->sks; ?></td>
                                            <td><?= $matkul->nama_dosen; ?></td>
                                            <td>
                                                <a href="hapus/<?= $matkul->id_mata_kuliah; ?>" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
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
<div class="modal inmodal" id="myModalMatkul" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header bg-primary">                
                <h4 class="modal-title">Tambah Mata Kuliah</h4>                
            </div>
            <div class="modal-body">
                <?= form_open('matkul/tambahMatkul','class="form-horizontal"'); ?>          
                <div class="form-group">
                    <label class="col-sm-2 control-label">Dosen</label>
                    <div class="col-sm-10">
                        <select name="dosen" id="dosen" class="form-control">
                            <?php foreach ($dosen as $d): ?>
                                <option value="<?= $d->id_dosen; ?>"><?= $d->nama_dosen; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Kode Mata Kuliah</label>
                    <div class="col-sm-10"><input type="text" name="kode" class="form-control"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Mata Kuliah</label>
                    <div class="col-sm-10"><input type="text" name="matkul" class="form-control"></div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 control-label">SKS</label>
                    <div class="col-sm-10"><input type="number" name="sks" class="form-control"></div>
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