<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
        </ol>
    </div>
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

</div>
<!---Container Fluid-->
