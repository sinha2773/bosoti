<form name="form" method="post" action="<?php echo base_url($admin_path)?>/client/update" enctype="multipart/form-data">
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
                    <input type="text" name="mobile" value="<?php echo $data->mobile;?>" placeholder="Enter mobile" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="Email" name="email" value="<?php echo $data->email;?>" placeholder="Enter email" class="form-control" >
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option <?php echo $data->gender=='male'?'selected':'';?> value="male">Male</option>
                        <option <?php echo $data->gender=='female'?'selected':'';?> value="female">Female</option>
                        <option <?php echo $data->gender=='other'?'selected':'';?> value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Client Type</label>
                    <select name="client_type" class="form-control">
                    <?php foreach($client_types as $user_type){?>
                    <option <?php echo $data->client_type==$user_type['value']?'selected':'';?> value="<?php echo $user_type['value'];?>"><?php echo $user_type['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?php echo $data->address;?>" class="form-control" required>
                    <!-- <select name="address" class="form-control" required>
                    <?php foreach($address as $addr){?>
                    <option <?php echo $data->address==$addr->id?'selected':'';?> value="<?php echo $addr->id;?>"><?php echo $addr->title;?></option>
                    <?php } ?>
                    </select> -->
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Zone</label>
                    <input type="text" name="zone" value="<?php echo $data->zone;?>" class="form-control" required>
                    <!-- <select name="zone" class="form-control" required>
                    <?php foreach($zones as $zone){?>
                    <option <?php echo $data->zone==$zone->id?'selected':'';?> value="<?php echo $zone->id;?>"><?php echo $zone->title;?></option>
                    <?php } ?>
                    </select> -->
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
                    <input type="text" name="floor" value="<?php echo $data->floor;?>" class="form-control">
                    <!-- <select name="floor" class="form-control">
                    <?php foreach($floors as $floor){?>
                    <option <?php echo $data->floor==$floor->id?'selected':'';?> value="<?php echo $floor->id;?>"><?php echo $floor->title;?></option>
                    <?php } ?>
                    </select> -->
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Monthly Bill</label>
                    <input type="number" name="monthly_bill" value="<?php echo $data->monthly_bill;?>" placeholder="Enter monthly bill" class="form-control" step="any" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>VAT (%)</label>
                    <input type="number" name="vat" value="<?php echo $data->vat;?>" placeholder="Enter vat (ex: 15)" class="form-control" required>
                </div>
            </div>            
        </div>

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
            <input <?php echo $data->status==1?'checked':'';?> type="radio" name="status" value="1"> Enable  
            <input <?php echo $data->status==2?'checked':'';?> type="radio" name="status" value="2">  Disable
        </div>
    </div>

    <div class="form-group">
        <a href="<?php echo base_url($admin_path);?>/client/list"><input type="button" class="btn btn-danger pull-left" style="width: 49% " value="Cancel"></a>
        <input type="submit" class="btn btn-primary pull-right" style="width: 50% " value="Update">
    </div>
</form>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#connection_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>