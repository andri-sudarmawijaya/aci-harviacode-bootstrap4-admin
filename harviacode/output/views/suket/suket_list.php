<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <style>
            .dataTables_wrapper {
                min-height: 500px
            }
            
            .dataTables_processing {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100%;
                margin-left: -50%;
                margin-top: -25px;
                padding-top: 20px;
                text-align: center;
                font-size: 1.2em;
                color:grey;
            }
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Suket List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('suket/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('suket/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('suket/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>No</th>
		    <th>Suket Bapr No</th>
		    <th>Nomor Laporan</th>
		    <th>Nomor Sertifikat</th>
		    <th>Tanggal Penerbitan</th>
		    <th>Nomor Suket</th>
		    <th>Kelompok Uji</th>
		    <th>Template</th>
		    <th>Jenis Pesawat</th>
		    <th>Nama Alat</th>
		    <th>Nama Alat Awal</th>
		    <th>Suket Jenis Pemeriksaan</th>
		    <th>Suket Nama Perusahaan</th>
		    <th>Nama Perusahaan Awal</th>
		    <th>Qty</th>
		    <th>Pabrik Pembuat</th>
		    <th>Tempat Pembuatan</th>
		    <th>Tahun Pembuatan</th>
		    <th>Memenuhi Syarat K3</th>
		    <th>Tanggal Suket</th>
		    <th>Suket Riksa Kembali</th>
		    <th>Suket Riksa Kembali Tahun</th>
		    <th>Suket Riksa Kembali Bulan</th>
		    <th>Keterangan</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "suket/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id",
                            "orderable": false
                        },{"data": "no"},{"data": "suket_bapr_no"},{"data": "nomor_laporan"},{"data": "nomor_sertifikat"},{"data": "tanggal_penerbitan"},{"data": "nomor_suket"},{"data": "kelompok_uji"},{"data": "template"},{"data": "jenis_pesawat"},{"data": "nama_alat"},{"data": "nama_alat_awal"},{"data": "suket_jenis_pemeriksaan"},{"data": "suket_nama_perusahaan"},{"data": "nama_perusahaan_awal"},{"data": "qty"},{"data": "pabrik_pembuat"},{"data": "tempat_pembuatan"},{"data": "tahun_pembuatan"},{"data": "memenuhi_syarat_k3"},{"data": "tanggal_suket"},{"data": "suket_riksa_kembali"},{"data": "suket_riksa_kembali_tahun"},{"data": "suket_riksa_kembali_bulan"},{"data": "keterangan"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>
    </body>
</html>