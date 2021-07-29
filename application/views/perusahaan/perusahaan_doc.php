<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Perusahaan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Perusahaan</th>
		<th>Alamat Kantor</th>
		<th>Alamat Plant</th>
		
            </tr><?php
            foreach ($perusahaan_data as $perusahaan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $perusahaan->nama_perusahaan ?></td>
		      <td><?php echo $perusahaan->alamat_kantor ?></td>
		      <td><?php echo $perusahaan->alamat_plant ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>