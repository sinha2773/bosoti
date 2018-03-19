<form name="form" method="post" action="<?php echo base_url($admin_path);?>/client/saveClient/update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data->id;?>">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Client ID</label>
                    <input type="text" name="client_id" placeholder="Enter client id" class="form-control" readonly value="<?php echo $data->client_id;?>" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?php echo $data->full_name;?>" placeholder="Enter name" class="form-control" >
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" placeholder="Enter mobile" value="<?php echo $data->mobile;?>" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="Email" name="email" placeholder="Enter email" value="<?php echo $data->email;?>" class="form-control" >
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                    <option <?php echo $data->gender=='1'?'selected':'';?> value="1">Male</option>
                    <option <?php echo $data->gender=='2'?'selected':'';?> value="2">Female</option>
                    <option <?php echo $data->gender=='3'?'selected':'';?> value="3">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Client Type</label>
                    <select name="client_type" class="form-control">
                    <?php foreach($client_types as $arr){?>
                    <option <?php echo $data->client_type==$arr['value']?'selected':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Address</label>
                    <select name="address" class="form-control" required>
                    <?php foreach($address as $obj){?>
                    <option <?php echo $data->address==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Address 2</label>
                    <input type="text" name="address2" class="form-control" value="<?php echo $data->address2;?>"  placeholder="Enter address2 if needed">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Zone</label>
                    <select name="zone" class="form-control" required>
                    <?php foreach($zones as $obj){?>
                    <option <?php echo $data->zone==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>House No</label>
                    <input type="text" name="house_no" value="<?php echo $data->house_no;?>" placeholder="Enter house no" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Floor</label>
                    <select name="floor" class="form-control">
                    <?php foreach($floors as $obj){?>
                    <option <?php echo $data->floor==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Apartment</label>
                    <select name="apartment" class="form-control">
                    <?php foreach($apartments as $obj){?>
                    <option <?php echo $data->apartment==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" class="form-control">
                    <?php foreach($payment_types as $arr){?>
                    <option <?php echo $data->payment_type==$arr['value']?'selected':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Package (monthly bill)</label>
                    <select name="package" class="form-control" required>
                    <option value="">Select package</option>
                    <?php foreach($packages as $obj){?>
                    <option <?php echo $data->package_id==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?> (Monthly Bill: <?php echo $obj->price;?>) (VAT: <?php echo $obj->vat;?>%) (Total: <?php echo $obj->total;?>)</option>
                    <?php } ?>
                    </select>
                </div>
            </div>        
        </div>

        <?php /*
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Connection Fee</label>
                    <input type="number" name="connection_fee" value="<?php echo $data->connection_fee;?>" placeholder="Enter connection fee" class="form-control" step="any" required>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>First Bill Pay</label>
                    <input type="number" name="first_bill" value="<?php echo $data->first_bill;?>" placeholder="Enter first bill amount" class="form-control" step="any">
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Collector</label>
                    <select name="collector" class="form-control" required>
                    <option value="">Select Bill Collector</option>
                    <?php foreach($operators as $obj){?>
                    <option <?php echo set_select('collector', $obj->id);?> value="<?php echo $obj->id;?>"><?php echo $obj->name;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Book No</label>
                    <input type="text" name="book_no" value="<?php echo set_value('book_no');?>" placeholder="Enter book number" class="form-control">
                </div>
            </div>            
        </div>
        */ ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Connection Date</label>
                    <input type="text" name="connection_date" id="connection_date" placeholder="Enter connection date" class="form-control" value="<?php echo $data->connection_date;?>" required>
                </div>
            </div>
        </div>
        

        <div class="form-group">
            <label>Summary</label>
            <textarea class="form-control" name="summary"><?php echo $data->summary;?></textarea>
        </div>


        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
            <?php foreach($statuses as $arr){?>
                <option <?php echo $data->status==$arr['value']?'selected':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
            <?php } ?>
            </select>
        </div>

        <div class="form-group text-right">
            <a href="<?php echo base_url($admin_path);?>/client"><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-reply" aria-hidden="true"></i> Cancel</button></a>
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update</button>
        </div>
    </div>

    
</form>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#connection_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>