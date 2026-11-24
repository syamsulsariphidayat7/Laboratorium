</div>
<!-- Modal Ubah Profil admin -->
<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header bg-warning">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Ubah Password</h4>
                <span>Silahkan lengkapi data!</span>
            </div>
            <div class="modal-body">
                <?= form_open('admin/ubahPassword'); ?>
                <div class="form-group">
                    <label for="">Password Sekarang</label>
                    <input type="hidden" name="id" value="<?= $this->session->userdata('login'); ?>">
                    <input type="hidden" name="level" value="<?= $this->session->userdata('level'); ?>">
                    <input type="password" name="password" id="password" class="form-control" autofocus="">
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" name="passwordBaru" id="passwordBaru" class="form-control">
                </div>                
                <div class="form-group">
                    <label for="">Konfirmasi Password</label>
                    <input type="password" name="konfirmasiPassword" id="konfirmasiPassword" class="form-control">
                </div>
                <div class="form-group">
                    <input type="checkbox" id="lihatPassword" class="i-checks">
                    <label for="">Lihat Password</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-warning">Ubah</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- .Modal Ubah Profil admin -->
<!-- Modal Penilaian -->
<div class="modal inmodal" id="myModalNilai" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">                
                <h4 class="modal-title">Form Penilaian</h4>                
            </div>
            <div class="modal-body">
                <?= form_open('portofolio/formNilai','class="form-horizontal"'); ?>                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Jurnal</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="anggota" id="anggota" value="">
                        <input type="hidden" name="dosen" id="dosen" value="">
                        <input type="hidden" name="prt" id="prt" value="">
                        <input type="hidden" name="mk" id="mk" value="">
                        <input type="hidden" name="jadwal" id="jadwal" value="">
                        <input type="text" class="form-control" name="jurnal" id="jurnal">    
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Laporan</label>
                    <div class="col-sm-10">
                        <input type="text" name="laporan" class="form-control" name="laporan" id="laporan">    
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Documentasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="documentasi" id="documentasi">    
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ulasan</label>
                    <div class="col-sm-10">
                        <textarea name="ulasan" cols="30" rows="7" class="form-control"></textarea>
                    </div>
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
<!-- .Modal Penilaian -->

<!-- Modal ubahPhoto -->
<div class="modal inmodal" id="ubahPhoto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated rubberBand">
            <div class="modal-header">                
                <h4 class="modal-title">Form Ubah Photo</h4>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('admin/ubahPhoto','class="form-horizontal"'); ?>
                <div class="form-group text-center">
                    <img width="300px" src="<?= site_url('assets/media/photo/'.$this->session->userdata('photo')); ?>" class="img-thumbnail" alt="">   
                </div>
                <div class="form-group text-center">
                    <label>Upload Photo Baru</label>                    
                    <input type="file" name="photo" class="form-control">
                    <small class="text-danger">Type : jpg/png/jpeg | Max Size : 2 MB</small>                    
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
<!-- .Modal ubahPhoto -->

<!-- .wrapper wrapper-content -->
<div class="footer">
    <div class="pull-right">
        <strong>&copy; 2018</strong>
    </div>
    <div>
        <strong>Copyright</strong> Laboratorium Pendidikan Kimia Fakultas Tarbiyah Dan Keguruan.
    </div>
</div>
</div>
</div>

<!-- Mainly scripts -->
<script src="<?= base_url('assets/'); ?>js/jquery-2.1.1.js"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/jeditable/jquery.jeditable.js"></script>

<!-- Data Tables -->
<script src="<?= base_url('assets/'); ?>js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/dataTables/dataTables.responsive.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/dataTables/dataTables.tableTools.min.js"></script>


<!-- Flot -->
<script src="<?= base_url('assets/'); ?>js/plugins/flot/jquery.flot.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/flot/jquery.flot.time.js"></script>

<!-- Peity -->
<script src="<?= base_url('assets/'); ?>js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= base_url('assets/'); ?>js/inspinia.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="<?= base_url('assets/'); ?>js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jvectormap -->
<script src="<?= base_url('assets/'); ?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- EayPIE -->
<script src="<?= base_url('assets/'); ?>js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="<?= base_url('assets/'); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="<?= base_url('assets/'); ?>js/demo/sparkline-demo.js"></script>

<!-- My Script -->
<script src="<?= base_url('assets/'); ?>js/myscript.js"></script>
<script src="http://localhost:35729/livereload.js"></script>

<script>
    $(document).ready(function() {
        $('.chart').easyPieChart({
            barColor: '#f8ac59',
//                scaleColor: false,
scaleLength: 5,
lineWidth: 4,
size: 80
});

        $('.chart2').easyPieChart({
            barColor: '#1c84c6',
//                scaleColor: false,
scaleLength: 5,
lineWidth: 4,
size: 80
});

        var data2 = [
        [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
        [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
        [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
        [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
        [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
        [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
        [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
        [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
        ];

        var data3 = [
        [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
        [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
        [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
        [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
        [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
        [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
        [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
        [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
        ];


        var dataset = [
        {
            label: "Number of orders",
            data: data3,
            color: "#1ab394",
            bars: {
                show: true,
                align: "center",
                barWidth: 24 * 60 * 60 * 600,
                lineWidth:0
            }

        }, {
            label: "Payments",
            data: data2,
            yaxis: 2,
            color: "#464f88",
            lines: {
                lineWidth:1,
                show: true,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.2
                    }, {
                        opacity: 0.2
                    }]
                }
            },
            splines: {
                show: false,
                tension: 0.6,
                lineWidth: 1,
                fill: 0.1
            },
        }
        ];


        var options = {
            xaxis: {
                mode: "time",
                tickSize: [3, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                position: "left",
                max: 1070,
                color: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3
            }, {
                position: "right",
                clolor: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: ' Arial',
                axisLabelPadding: 67
            }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        var previousPoint = null, previousLabel = null;

        $.plot($("#flot-dashboard-chart"), dataset, options);

        var mapData = {
            "US": 298,
            "SA": 200,
            "DE": 220,
            "FR": 540,
            "CN": 120,
            "AU": 760,
            "BR": 550,
            "IN": 200,
            "GB": 120,
        };

        $('#world-map').vectorMap({
            map: 'world_mill_en',
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    "fill-opacity": 0.9,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 0
                }
            },

            series: {
                regions: [{
                    values: mapData,
                    scale: ["#1ab394", "#22d6b1"],
                    normalizeFunction: 'polynomial'
                }]
            },
        });
    });
</script>
</body>
</html>