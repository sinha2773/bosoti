<?php 
function setDefault($field, $value, $is_input=false){
    if($is_input)
        return (isset($_SESSION['client_reg'][$field]))?$_SESSION['client_reg'][$field]:'';
    else
        return (isset($_SESSION['client_reg'][$field]) && $_SESSION['client_reg'][$field]==$value)?'selected':'';
}
?>
<form name="form" method="post" action="<?php echo base_url($admin_path);?>/client/saveClient" enctype="multipart/form-data">
    <div class="col-sm-12">
        <div class="row">
            <?php $isOldClientId =  isset($settings['show_old_client_id'])?$settings['show_old_client_id']:0;
            $isMobileRequired =  isset($settings['is_mobile_required'])?$settings['is_mobile_required']:0;
            ?>
            <div class="<?php echo ($isOldClientId == 1)?'col-sm-2':'col-sm-4'; ?>">
                <div class="form-group">
                    <label>Client ID</label>
                    <input type="text" name="client_id" id="client_id" placeholder="Enter client id" class="form-control hilight-bg disable" readonly value="<?php echo $client_id;?>" required>
                </div>
            </div>
            <?php if($isOldClientId == 1){ ?>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Old Client ID</label>
                    <input type="text" name="old_client_id" id="old_client_id" placeholder="Enter old client id" class="form-control" value="<?php echo set_value('old_client_id');?>">
                </div>
            </div>
            <?php } ?>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Zone</label>
                    <select id="zone" onchange="changeZone(this)" name="zone" class="form-control" required>
                    <!-- <option value="">Select Zone</option> -->
                    <?php foreach($zones as $obj){?>
                    <option <?php echo setDefault('zone', $obj->id);?> slug="<?php echo $obj->slug;?>" <?php echo set_select('zone', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Connection Date</label>
                    <input type="text" name="connection_date" id="connection_date" placeholder="Enter connection date" class="form-control" value="<?php echo isset($_SESSION['client_reg']['connection_date'])?$_SESSION['client_reg']['connection_date']:date('Y-m-d');?>" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Client Type</label>
                    <select name="client_type" class="form-control">
                    <option value="">Select Client Type</option>
                    <?php foreach($client_types as $arr){?>
                    <option <?php echo setDefault('client_type', $arr['value']);?> <?php echo set_select('client_type', $arr['value']); ?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" id="payment_type" onchange="changePaymentType()" class="form-control" required>
                    <option value="">Select Payment Type</option>
                    <?php foreach($payment_types as $arr){?>
                    <option <?php echo setDefault('payment_type', $arr['value']);?> <?php echo set_select('payment_type', $arr['value']); ?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?php echo set_value('full_name');?>" placeholder="Enter name" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option <?php echo setDefault('gender',1);?> <?php echo set_select('gender', '1'); ?> value="1">Male</option>
                    <option <?php echo setDefault('gender',2);?> <?php echo set_select('gender', '2'); ?> value="2">Female</option>
                    <option <?php echo setDefault('gender',3);?>  <?php echo set_select('gender', '3'); ?> value="3">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Profession</label>
                    <select name="profession" class="form-control">
                        <option value="">Select Profession</option>
                        <option <?php echo set_select('profession', '1'); ?> value="1">Business</option>
                        <option <?php echo set_select('profession', '2'); ?> value="2">Job</option>
                        <option <?php echo set_select('profession', '3'); ?> value="3">Housewife</option>
                        <option <?php echo set_select('profession', '0'); ?> value="0">Others</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Resident Type</label>
                    <select name="resident" class="form-control">
                        <option value="">Select Resident</option>
                        <option <?php echo set_select('resident', '1'); ?> value="1">Present</option>
                        <option <?php echo set_select('resident', '2'); ?> value="2">Permanent</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" placeholder="Enter mobile" value="<?php echo set_value('mobile');?>" class="form-control" <?php echo $isMobileRequired==1?'required':'';?>>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Email</label>
                    <input type="Email" name="email" placeholder="Enter email" value="<?php echo set_value('email');?>" class="form-control" >
                </div>
            </div>  

            <div class="col-sm-2">
                <div class="form-group">
                    <label>House No</label>
                    <input type="text" name="house_no" value="<?php echo set_value('house_no');?>" placeholder="Enter house no" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Floor</label>
                    <select name="floor" class="form-control">
                    <option value="">Select Floor</option>
                    <?php foreach($floors as $obj){?>
                    <option <?php echo set_select('floor', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
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
                    <option <?php echo set_select('apartment', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
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
                    <option <?php echo setDefault('address',$obj->id);?>  <?php echo set_select('address', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Address 2</label>
                    <input type="text" name="address2" class="form-control" value="<?php echo set_value('address2');?>"  placeholder="Enter address2 if needed">
                </div>
            </div> 
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                    <option value="">Select Status</option>
                    <?php foreach($statuses as $arr){?>
                        <option <?php echo setDefault('status',$arr['value']);?> <?php echo set_select('status', $arr['value']); ?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>  

            <div class="col-sm-2">
                <div class="form-group">
                    <label>Package (monthly bill)</label>
                    <select id="package" name="package[]" style="width:100%;" multiple required>
                    <?php foreach($packages as $obj){?>
                    <option <?php echo set_select('package', $obj->id); ?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?> (<?php echo $obj->total;?>)</option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <?php 
            $hide_connection_fee =  isset($settings['hide_connection_fee'])?$settings['hide_connection_fee']:0;
            if ( $hide_connection_fee != 1 ) {
            ?>
            <div class="col-sm-2">
                <div class="form-group">
                    <label title="Connection fee will be generated if checkbox is enabled"><input type="checkbox" checked value="1" name="conn_bill"> Connection Fee</label>
                    <input type="number" name="connection_fee" value="<?php echo set_value('connection_fee')=='' ? $settings['connection_fee'] : set_value('connection_fee');?>" placeholder="Enter connection fee" class="form-control" step="any">
                </div>
            </div>
            <?php } ?>

            <?php 
            $hide_first_bill =  isset($settings['hide_first_bill'])?$settings['hide_first_bill']:0;
            if ( $hide_first_bill != 1 ) {
            ?>
            <div class="col-sm-2" id="first_bill">
                <div class="form-group">
                    <label title="Monthly bill will be generated if checkbox is enabled"><input type="checkbox" checked value="1" name="month_bill"> Generate first month bill</label>
                    <input type="number" name="first_bill" value="<?php echo set_value('first_bill');?>" placeholder="Pay first month bill" class="form-control" step="any">
                </div>
            </div> 
            <?php } ?>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Collector</label>
                    <select name="collector" class="form-control">
                    <option value="">Select Bill Collector</option>
                    <?php foreach($operators as $obj){?>
                    <option <?php echo setDefault('collector',$obj->id);?> <?php echo set_select('collector', $obj->id);?> value="<?php echo $obj->id;?>"><?php echo $obj->name;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div> 
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Book No</label>
                    <input type="text" name="book_no" value="<?php echo set_value('book_no');?>" placeholder="Enter book number" class="form-control">
                </div>
            </div>       
        </div>
      

        <div class="form-group">
            <label>Summary</label>
            <textarea class="form-control" name="summary"><?php echo set_value('summary');?></textarea>
        </div>

        <div class="form-group text-right">
            <a href="<?php echo base_url($admin_path);?>/client/list"><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-reply" aria-hidden="true"></i> Cancel</button></a>
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Save</button>
        </div>
    </div>

    
</form>
<script type="text/javascript">
    function changePaymentType(){
        var payment_type = $('#payment_type').val();
        if(payment_type==2){
            $('#first_bill').show();
        }
        else{
            $('#first_bill').hide();
        }
    }
    changePaymentType();


    jQuery(document).ready(function(){

        <?php if( isset($settings['connection_date_changeable']) && $settings['connection_date_changeable'] == 1 ){?>
            $('#connection_date').datepicker({dateFormat: 'yy-mm-dd'});
        <?php }else{ ?>
            $('#connection_date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: '<?php echo date('Y-m'); ?>-01',
                maxDate: '<?php echo date('Y-m-d'); ?>'
            });
        <?php } ?>

        // $('#package').select2();
        $("#package").select2({
          placeholder: "Select a Package",
          // multiple: true,
          //allowClear: true
        });




        // delegate a click event on the input box
        // $('.select2-input').on('click',function()
        // {
        //     // remove select2-disabled class from all li under the dropdown
        //     $('.select2-drop .select2-results li').removeClass('select2-disabled');
        //     // add select2-result-selectable class to all li which are missing the respective class
        //     $('.select2-drop .select2-results li').each(function()
        //     {       console.log(this);
        //         $(this).removeClass('select2-selected');
        //      if(!$(this).hasClass('select2-result-selectable'))
        //        $(this).addClass('select2-result-selectable');
        //     });   
        // });
        // had to include the following code as a hack since the click event required double click on 'select2-input' to invoke the event
        // $('.select2-container-multi').on('mouseover',function()
        // {
        //     $('.select2-input').click();
        // });
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
    changeZone(); // for default
</script>
<?php } ?>