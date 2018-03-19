<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">

<?php $status_arr = array('', 'Disconnect', 'Active', 'Inactive', 'Hold'); ?>
<?php $ptype_arr = array('', 'Free', 'Prepaid', 'Postpaid'); ?>

<form name="form" method="get" action="" enctype="multipart/form-data">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select name="payment_type" id="payment_type" class="form-control">
                        <option value="">Select Payment Type</option>
                        <?php foreach($payment_types as $arr){?>
                        <option value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Due Months</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Select Due</option>
                        <?php foreach($statuses as $arr){?>
                            <option value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Select Status</option>
                        <?php foreach($statuses as $arr){?>
                            <option value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <table id="listTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll" /></th>
                                <th>#SL</th>
                                <th>Client ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Client</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php 
                            foreach ($clients as $key => $value) { ?>
                            <tr class="">
                                <td><input type="checkbox" class="my_checkbox status_<?php echo $value->status;?>" value="<?php echo $value->id;?>" /></td>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value->client_id;?></td>
                                <td><?php echo $value->full_name; ?></td>
                                <td><?php echo $value->mobile; ?></td>
                                <td><?php echo $ptype_arr[$value->payment_type]; ?></td>
                                <td><?php echo $status_arr[$value->status]; ?></td>                                
                            </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Message From</label>
                    <input type="text" name="message_from" id="message_from" value="" placeholder="Enter your musk" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" id="message" style="min-height: 200px" placeholder="Enter the message" class="form-control" required></textarea>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus-circle" aria-hidden="true"></i> Save</button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block"><i class="fa fa-envelope" aria-hidden="true"></i> Save &amp; Send</button>
                    </div>
                </div>  
            </div> 
                
        </div>        
    </div>   
</form>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#listTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pageLength": 50,
        });
    });
</script>