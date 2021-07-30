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
        <h2 style="margin-top:0px">Orders Read</h2>
        <table class="table">
	    <tr><td>OrderDate</td><td><?php echo $orderDate; ?></td></tr>
	    <tr><td>RequiredDate</td><td><?php echo $requiredDate; ?></td></tr>
	    <tr><td>ShippedDate</td><td><?php echo $shippedDate; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Comments</td><td><?php echo $comments; ?></td></tr>
	    <tr><td>CustomerNumber</td><td><?php echo $customerNumber; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('orders') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>