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
                <h2 style="margin-top:0px">Spd List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('spd/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('spd/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('spd/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Spd Nomor Po</th>
		    <th>Spd No</th>
		    <th>Spd Tanggal</th>
		    <th>Spd Id Perusahaan</th>
		    <th>Spd Nama Perusahaan</th>
		    <th>Spd Hari Mulai</th>
		    <th>Spd Tanggal Mulai</th>
		    <th>Spd Hari Selesai</th>
		    <th>Spd Tanggal Selesai</th>
		    <th>Petugas1</th>
		    <th>Petugas2</th>
		    <th>Petugas3</th>
		    <th>Petugas4</th>
		    <th>Petugas5</th>
		    <th>Alat1</th>
		    <th>Jumlah1</th>
		    <th>Alat2</th>
		    <th>Jumlah2</th>
		    <th>Alat3</th>
		    <th>Jumlah3</th>
		    <th>Alat4</th>
		    <th>Jumlah4</th>
		    <th>Alat5</th>
		    <th>Jumlah5</th>
		    <th>Alat6</th>
		    <th>Jumlah6</th>
		    <th>Alat7</th>
		    <th>Jumlah7</th>
		    <th>Alat8</th>
		    <th>Jumlah8</th>
		    <th>Alat9</th>
		    <th>Jumlah9</th>
		    <th>Alat10</th>
		    <th>Jumlah10</th>
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
                    ajax: {"url": "spd/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id",
                            "orderable": false
                        },{"data": "spd_nomor_po"},{"data": "spd_no"},{"data": "spd_tanggal"},{"data": "spd_id_perusahaan"},{"data": "spd_nama_perusahaan"},{"data": "spd_hari_mulai"},{"data": "spd_tanggal_mulai"},{"data": "spd_hari_selesai"},{"data": "spd_tanggal_selesai"},{"data": "petugas1"},{"data": "petugas2"},{"data": "petugas3"},{"data": "petugas4"},{"data": "petugas5"},{"data": "alat1"},{"data": "jumlah1"},{"data": "alat2"},{"data": "jumlah2"},{"data": "alat3"},{"data": "jumlah3"},{"data": "alat4"},{"data": "jumlah4"},{"data": "alat5"},{"data": "jumlah5"},{"data": "alat6"},{"data": "jumlah6"},{"data": "alat7"},{"data": "jumlah7"},{"data": "alat8"},{"data": "jumlah8"},{"data": "alat9"},{"data": "jumlah9"},{"data": "alat10"},{"data": "jumlah10"},
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