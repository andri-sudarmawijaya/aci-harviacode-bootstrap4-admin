<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
        </ol>
    </div>

    <table class="table">
	    <tr><td>Nama Perusahaan</td><td><?php echo $nama_perusahaan; ?></td></tr>
	    <tr><td>Alamat Kantor</td><td><?php echo $alamat_kantor; ?></td></tr>
	    <tr><td>Alamat Plant</td><td><?php echo $alamat_plant; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('perusahaan') ?>" class="btn btn-info">Kembali</a></td></tr>
	</table>
</div>
<!---Container Fluid-->
