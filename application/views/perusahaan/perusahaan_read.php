<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Perusahaan Read</h2>
        <table class="table">
	    <tr><td>Nama Perusahaan</td><td><?php echo $nama_perusahaan; ?></td></tr>
	    <tr><td>Alamat Kantor</td><td><?php echo $alamat_kantor; ?></td></tr>
	    <tr><td>Alamat Plant</td><td><?php echo $alamat_plant; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('perusahaan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>