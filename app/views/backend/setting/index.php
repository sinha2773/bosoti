<?php global $data_array;
$data_array = $data;
function filter_array($key){
    global $data_array;
    foreach($data_array as $item){
        if($item->meta_key == $key)
            return $item->meta_value;
    }
}

?>

<form name="inline-form" method="post" action="<?php echo base_url($admin_path)?>/setting/setting_update">
    <div class="col-sm-5">
        <div class="form-group">
            <label>Application Title</label>
            <input type="text" name="app_title" placeholder="Enter application title" value="<?php echo filter_array("app_title");?>" class="form-control">

        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="full_address" placeholder="Enter the full address" value="<?php echo filter_array("full_address");?>" class="form-control">

        </div>
        <div class="form-group">
            <label>Owner Email</label>
            <input type="text" name="app_email" placeholder="Enter owner email address" value="<?php echo filter_array("app_email");?>" class="form-control">

        </div>
        
        <div class="form-group">
            <label>App Opening Date</label>
            <input type="text" name="default_date" placeholder="Enter default app opening date (Ex: yyyy-mm-dd)" value="<?php echo filter_array("default_date");?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Date Format</label>
            <input type="text" name="date_format" placeholder="Enter date format (Ex: Y-m-d h:m:s A)" value="<?php echo filter_array("date_format");?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Invoice Prefix</label>
            <input type="text" name="invoice_prefix" placeholder="Enter invoice prefix (Ex: vcn)" value="<?php echo filter_array("invoice_prefix");?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Currency</label>
            <input type="text" name="currency" placeholder="Enter currency (Ex: Tk, $)" value="<?php echo filter_array("currency");?>" class="form-control">
        </div>
        
    </div>

    <div class="col-sm-6 col-sm-offset-1">
         
    </div>

    <div class="col-sm-12 form-group text-right">

        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update Setting</button>

    </div>

</form>