<form name="form" method="post" action="<?php echo base_url($admin_path);?>/client/saveClient" enctype="multipart/form-data">
    <div class="col-sm-12">
        <div class="row">
            <?php $isOldClientId =  isset($settings['show_old_client_id'])?$settings['show_old_client_id']:0;
            $isMobileRequired =  isset($settings['is_mobile_required'])?$settings['is_mobile_required']:0;
            ?>
            <div class="<?php echo ($isOldClientId == 1)?'col-sm-3':'col-sm-6'; ?>">
                <div class="form-group">
                    <label>Client ID</label>
                    <input type="text" name="client_id" id="client_id" placeholder="Enter client id" class="form-control hilight-bg disable" value="<?php echo $client_id;?>" required>
                </div>
            </div>
            <?php if($isOldClientId == 1){ ?>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Old Client ID</label>
                    <input type="text" name="old_client_id" id="old_client_id" placeholder="Enter old client id" class="form-control" value="<?php echo set_value('old_client_id');?>">
                </div>
            </div>
            <?php } ?>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?php echo set_value('full_name');?>" placeholder="Enter name" class="form-control" >
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" placeholder="Enter mobile" value="<?php echo set_value('mobile');?>" class="form-control" <?php echo $isMobileRequired==1?'required':'';?>>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="Email" name="email" placeholder="Enter email" value="<?php echo set_value('email');?>" class="form-control" >
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                    <option <?php echo set_select('gender', '1', TRUE); ?> value="1">Male</option>
                    <option <?php echo set_select('gender', '2'); ?> value="2">Female</option>
                    <option <?php echo set_select('gender', '3'); ?> value="3">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Client Type</label>
                    <select name="client_type" class="form-control">
                    <?php foreach($client_types as $arr){?>
                    <option <?php echo set_select('client_type', $arr['value']); ?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
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
                    <option <?php echo set_select('address', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Address 2</label>
                    <input type="text" name="address2" class="form-control" value="<?php echo set_value('address2');?>"  placeholder="Enter address2 if needed">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Zone</label>
                    <select id="zone" onchange="changeZone(this)" name="zone" class="form-control" required>
                    <?php foreach($zones as $obj){?>
                    <option slug="<?php echo $obj->slug;?>" <?php echo set_select('zone', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>House No</label>
                    <input type="text" name="house_no" value="<?php echo set_value('house_no');?>" placeholder="Enter house no" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Floor</label>
                    <select name="floor" class="form-control">
                    <?php foreach($floors as $obj){?>
                    <option <?php echo set_select('floor', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
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
                    <option <?php echo set_select('apartment', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" class="form-control">
                    <?php foreach($payment_types as $arr){?>
                    <option <?php echo set_select('payment_type', $arr['value']); ?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
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
                    <option <?php echo set_select('package', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?> (Monthly Bill: <?php echo $obj->price;?>) (VAT: <?php echo $obj->vat;?>%) (Total: <?php echo $obj->total;?>)</option>
                    <?php } ?>
                    </select>
                </div>
            </div>        
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Connection Fee</label>
                    <input type="number" name="connection_fee" value="<?php echo set_value('connection_fee')=='' ? $settings['connection_fee'] : set_value('connection_fee');?>" placeholder="Enter connection fee" class="form-control" step="any" required>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>First Bill Pay</label>
                    <input type="number" name="first_bill" value="<?php echo set_value('first_bill');?>"placeholder="Enter first bill amount" class="form-control" step="any">
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

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Connection Date</label>
                    <input type="text" name="connection_date" id="connection_date" placeholder="Enter connection date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                </div>
            </div>
        </div>
        

        <div class="form-group">
            <label>Summary</label>
            <textarea class="form-control" name="summary"><?php echo set_value('summary');?></textarea>
        </div>


        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
            <?php foreach($statuses as $arr){?>
                <option <?php echo set_select('status', $arr['value']); ?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
            <?php } ?>
            </select>
        </div>

        <div class="form-group text-right">
            <a href="<?php echo base_url($admin_path);?>/client/list"><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-reply" aria-hidden="true"></i> Cancel</button></a>
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Save</button>
        </div>
    </div>

    
</form>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#connection_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
<?php
if( isset($settings['is_client_prefix_by_zone']) && $settings['is_client_prefix_by_zone'] == '1'){ ?>
<script type="text/javascript">
    function changeZone(e){
        var slug = $('#zone option:selected').attr('slug');
        $.ajax({
            'url': base_url+'admin/client/getClientPrefix',
            'method': 'post',
            'data': {prefix:slug},
            'dataType': 'json',
            'success': function(json){
                if(json.status=='success'){
                    $('#client_id').val(json.prefix);
                }
            }
        })
    }
</script>
<?php } ?>