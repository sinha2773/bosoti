<form name="form" method="post" action="<?php echo base_url($admin_path);?>/client/saveClient/update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data->id;?>">
    <div class="col-sm-12">
        <div class="row">
            <?php $isOldClientId =  isset($settings['show_old_client_id'])?$settings['show_old_client_id']:0;
            $isMobileRequired =  isset($settings['is_mobile_required'])?$settings['is_mobile_required']:0;
            ?>
            <div class="<?php echo ($isOldClientId == 1)?'col-sm-2':'col-sm-4'; ?>">
                <div class="form-group">
                    <label>Client ID</label>
                    <input type="text" name="client_id" id="client_id" placeholder="Enter client id" class="form-control hilight-bg disable" readonly value="<?php echo $data->client_id;?>" required>
                </div>
            </div>
            <?php if($isOldClientId == 1){ ?>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Old Client ID</label>
                    <input type="text" name="old_client_id" id="old_client_id" placeholder="Enter old client id" class="form-control" value="<?php echo $data->old_client_id;?>">
                </div>
            </div>
            <?php } ?>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Zone</label>
                    <select id="zone" onchange="changeZone(this)" name="zone" class="form-control" required>
                    <!-- <option value="">Select Zone</option> -->
                    <?php foreach($zones as $obj){?>
                    <option <?php echo $obj->id==$data->zone_id?'selected':'';?> slug="<?php echo $obj->slug;?>"  value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Connection Date</label>
                    <input type="text" name="connection_date" id="connection_date" placeholder="Enter connection date" class="form-control" value="<?php echo $data->connection_date;?>" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Client Type</label>
                    <select name="client_type" class="form-control">
                    <option value="">Select Client Type</option>
                    <?php foreach($client_types as $arr){?>
                    <option <?php echo $arr['value']==$data->client_type?'selected':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" class="form-control">
                    <option value="">Select Payment Type</option>
                    <?php foreach($payment_types as $arr){?>
                    <option <?php echo $arr['value']==$data->payment_type?'selected':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?php echo $data->full_name;?>" placeholder="Enter name" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option <?php echo $data->gender==1?'selected':'';?> value="1">Male</option>
                    <option <?php echo $data->gender==2?'selected':'';?> value="2">Female</option>
                    <option <?php echo $data->gender==3?'selected':'';?> value="3">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Profession</label>
                    <select name="profession" class="form-control">
                        <option value="">Select Profession</option>
                        <option <?php echo $data->profession==1?'selected':'';?> value="1">Business</option>
                        <option <?php echo $data->profession==2?'selected':'';?> value="2">Job</option>
                        <option <?php echo $data->profession==3?'selected':'';?> value="3">Housewife</option>
                        <option <?php echo $data->profession==0?'selected':'';?> value="0">Others</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Resident Type</label>
                    <select name="resident" class="form-control">
                        <option value="">Select Resident</option>
                        <option <?php echo $data->resident==1?'selected':'';?> value="1">Present</option>
                        <option <?php echo $data->resident==2?'selected':'';?> value="2">Permanent</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" placeholder="Enter mobile" value="<?php echo $data->mobile;?>" class="form-control" <?php echo $isMobileRequired==1?'required':'';?>>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Email</label>
                    <input type="Email" name="email" placeholder="Enter email" value="<?php echo $data->email;?>" class="form-control" >
                </div>
            </div>  

            <div class="col-sm-2">
                <div class="form-group">
                    <label>House No</label>
                    <input type="text" name="house_no" value="<?php echo $data->house_no;?>" placeholder="Enter house no" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Floor</label>
                    <select name="floor" class="form-control">
                    <option value="">Select Floor</option>
                    <?php foreach($floors as $obj){?>
                    <option <?php echo $data->floor_id==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div> 
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Apartment</label>
                    <select name="apartment" class="form-control">
                    <option value="">Select Apartment</option>
                    <?php foreach($apartments as $obj){?>
                    <option <?php echo $data->apartment_id==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Address</label>
                    <select name="address" class="form-control" >
                    <option value="">Select Address</option>
                    <?php foreach($address as $obj){?>
                    <option <?php echo $data->address_id==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Address 2</label>
                    <input type="text" name="address2" class="form-control" value="<?php echo $data->address2;?>"  placeholder="Enter address2 if needed">
                </div>
            </div> 
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <?php foreach($statuses as $arr){?>
                        <option <?php echo $data->status==$arr['value']?'selected':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>  

            <div class="col-sm-2">
                <div class="form-group">
                    <label>Package (monthly bill)</label>
                    <select id="package" name="package[]" style="width:100%;" multiple required>
                    <?php foreach($packages as $obj){?>

                    	<?php 
                    	$selected = '';
                    	if( in_array($obj->id, array_keys($data->packages)) ){ 
                    		$selected = 'selected';
                    	} ?>
                    	<option <?php echo $selected;?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?> (<?php echo $obj->total;?>)</option>

                    <?php } ?>
                    </select>
                </div>
            </div>
                   
        </div>
      

        <div class="form-group">
            <label>Summary</label>
            <textarea class="form-control" name="summary"><?php echo $data->summary;?></textarea>
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
        $('#package').select2();
    });
</script>
<?php /*
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
<?php } */ ?>