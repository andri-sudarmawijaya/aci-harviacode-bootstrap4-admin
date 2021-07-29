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
        <h2 style="margin-top:0px">Perusahaan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Perusahaan <?php echo form_error('nama_perusahaan') ?></label>
            <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" placeholder="Nama Perusahaan" value="<?php echo $nama_perusahaan; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat_kantor">Alamat Kantor <?php echo form_error('alamat_kantor') ?></label>
            <textarea class="form-control" rows="3" name="alamat_kantor" id="alamat_kantor" placeholder="Alamat Kantor"><?php echo $alamat_kantor; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="alamat_plant">Alamat Plant <?php echo form_error('alamat_plant') ?></label>
            <textarea class="form-control" rows="3" name="alamat_plant" id="alamat_plant" placeholder="Alamat Plant"><?php echo $alamat_plant; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('perusahaan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>