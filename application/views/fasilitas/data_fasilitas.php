<div class="wrapper wrapper-content animated fadeInRight">
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
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Alat</h5>                        
                    <?php if ($this->session->userdata('level') === 'admin'): ?>
                            <button class="btn btn-primary btn-xs fa fa-plus pull-right" data-toggle="modal" data-target="#myFasilitas"> 
                                Tambah
                            </button>
                        <?php endif; ?>
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
                            <div class="table-responsive">
                            <table class="table table-hover margin bottom" id="table-dosen">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th>Nama Alat</th>
                                        <th>Jumlah Ketersediaan</th>
                                        <th>Spesifikasi</th>
                        <?php if ($this->session->userdata('level') === 'admin'): ?>
                                        <th class="text-center">Aksi</th>
                        <?php endif; ?>                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fasilitasAlat as $f): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $f->fasilitas; ?></td>
                                            <td><?= $f->jumlah; ?></td>
                                            <td><?= $f->keterangan; ?></td>                                                
                                        <?php if ($this->session->userdata('level') === 'admin'): ?>
                                            <td class="text-center">                                                
                                                <a href="hapus/<?= $f->id_fasilitas; ?>" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
                                            </td>
                                        <?php endif; ?>                         
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
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Bahan</h5>
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
                        <div class="table-responsive">                          
                            <table class="table table-hover margin bottom" id="table-bahan">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th>Nama Bahan</th>
                                        <th>Jumlah Ketersediaan</th>
                                        <th>Spesifikasi</th>
                        <?php if ($this->session->userdata('level') === 'admin'): ?>
                                        <th class="text-center">Aksi</th>
                        <?php endif; ?>                         
                                    </tr>
                                </thead>
                                <tbody><?php $nomor=1; ?>
                                    <?php foreach ($fasilitasBahan as $bahan): ?>
                                        <tr>
                                            <td class="text-center"><?= $nomor++; ?></td>
                                            <td><?= $bahan->fasilitas; ?></td>
                                            <td><?= $bahan->jumlah; ?></td>
                                            <td><?= $bahan->keterangan; ?></td>                                                
                                        <?php if ($this->session->userdata('level') === 'admin'): ?>
                                            <td class="text-center">                                                
                                                <a href="hapus/<?= $bahan->id_fasilitas; ?>" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-xs fa fa-trash"> Hapus</a>
                                            </td>
                                        <?php endif; ?>                         
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

<!-- Modal Tambah Fasilitas -->
<div class="modal inmodal" id="myFasilitas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">                
                <h4 class="modal-title">Tambah Fasilitas</h4>        
            </div>
            <div class="modal-body">
                <?= form_open('fasilitas/tambahfasilitas','class="form-horizontal"'); ?>          
                <div class="form-group">
                    <label class="col-sm-2 control-label">Jenis Fasilitas</label>
                    <div class="col-sm-10">
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="alat">Alat</option>
                            <option value="bahan">Bahan</option>
                        </select>
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Fasilitas</label>
                    <div class="col-sm-10"><input type="text" name="fasilitas" class="form-control" required=""></div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Jumlah</label>
                    <div class="col-sm-10"><input type="number" name="jumlah" class="form-control" required=""></div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Keterangan</label>
                    <div class="col-sm-10"><textarea name="keterangan" cols="30" rows="5" class="form-control" required=""></textarea></div>
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
<!-- .Modal Tambah Fasilitas -->