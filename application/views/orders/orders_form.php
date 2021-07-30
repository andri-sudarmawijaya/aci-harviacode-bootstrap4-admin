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
        <h2 style="margin-top:0px">Orders <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="datetime">OrderDate <?php echo form_error('orderDate') ?></label>
            <input type="text" class="form-control" name="orderDate" id="orderDate" placeholder="OrderDate" value="<?php echo $orderDate; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">RequiredDate <?php echo form_error('requiredDate') ?></label>
            <input type="text" class="form-control" name="requiredDate" id="requiredDate" placeholder="RequiredDate" value="<?php echo $requiredDate; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">ShippedDate <?php echo form_error('shippedDate') ?></label>
            <input type="text" class="form-control" name="shippedDate" id="shippedDate" placeholder="ShippedDate" value="<?php echo $shippedDate; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="comments">Comments <?php echo form_error('comments') ?></label>
            <textarea class="form-control" rows="3" name="comments" id="comments" placeholder="Comments"><?php echo $comments; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="int">CustomerNumber <?php echo form_error('customerNumber') ?></label>
            <input type="text" class="form-control" name="customerNumber" id="customerNumber" placeholder="CustomerNumber" value="<?php echo $customerNumber; ?>" />
        </div>
	    <input type="hidden" name="orderNumber" value="<?php echo $orderNumber; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('orders') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>