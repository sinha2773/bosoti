<div id="widget-grid" class="col-sm-12">       
    <div class="section">
        <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
            <header>
                <h2>Advance Filter</h2>
            </header>
            <div class="widget-body section_content">
                <form method="get" action="<?php echo base_url($admin_path);?>/payment/billingReportAdvance">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Client Type</label>
                                <select name="client_type" class="form-control">
                                <option value="">All</option>
                                <?php foreach($client_types as $arr){?>
                                <option <?php echo isset($data['client_type'])?$data['client_type']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Payment Type</label>
                                <select name="payment_type" class="form-control">
                                <option value="">All</option>
                                <?php foreach($payment_types as $arr){?>
                                <option <?php echo isset($data['payment_type'])?$data['payment_type']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Package (monthly bill)</label>
                                <select name="package_id" class="form-control" >
                                <option value="">All</option>
                                <?php foreach($packages as $obj){?>
                                <option <?php echo isset($data['package_id'])?$data['package_id']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?> (Monthly Bill: <?php echo $obj->price;?>) (VAT: <?php echo $obj->vat;?>%) (Total: <?php echo $obj->total;?>)</option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                            <?php /*
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All</option>
                                <?php foreach($statuses as $arr){?>
                                    <option <?php echo isset($data['status'])?$data['status']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                                </select>
                            */ ?>

                                <label>Bill Type</label>
                                <select name="billing_type" class="form-control">
                                    <option value="">All</option>
                                <?php foreach($billing_types as $arr){?>                    
                                <option <?php echo isset($data['billing_type'])?$data['billing_type']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Address</label>
                                <select name="address" class="form-control" >
                                <option value="">All</option>
                                <?php foreach($address as $obj){?>
                                <option <?php echo isset($data['address'])?$data['address']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Zone</label>
                                <select name="zone" class="form-control" >
                                <option value="">All</option>
                                <?php foreach($zones as $obj){?>
                                <option <?php echo isset($data['zone'])?$data['zone']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Apartment</label>
                                <select name="apartment" class="form-control">
                                <option value="">All</option>
                                <?php foreach($apartments as $obj){?>
                                <option <?php echo isset($data['apartment'])?$data['apartment']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Collector</label>
                                <select name="collector" class="form-control" >
                                <option value="">All</option>
                                <?php foreach($operators as $obj){?>
                                <option <?php echo isset($data['collector'])?$data['collector']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->name;?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div id="dueTypeContainer" class="col-sm-3">
                            <label>Due Type</label>
                            <span class="option_checkbox">
                            <input <?php echo isset($_GET['dueAbove']) && $_GET['dueAbove']==1?'checked':'';?> type="checkbox" id="dueAbove" onclick="$('#dueBelow').prop('checked', false)" name="dueAbove" value="1"> Above
                            <input <?php echo isset($_GET['dueBelow']) && $_GET['dueBelow']==1?'checked':'';?> type="checkbox" id="dueBelow" onclick="$('#dueAbove').prop('checked', false)" name="dueBelow" value="1"> Below
                            </span>
                            <select class="form-control" id="dueType" name="dueType">
                                <option value="">Select Due Type</option>
                                <?php foreach($dueTypes as $arr){?>
                                <option <?php echo isset($data['dueType'])?$data['dueType']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="advTypeContainer" class="col-sm-3">
                            <label>Advance</label>
                            <span class="option_checkbox">
                            <input <?php echo isset($_GET['advAbove']) && $_GET['advAbove']==1?'checked':'';?> type="checkbox" id="advAbove" onclick="$('#advBelow').prop('checked', false)" name="advAbove" value="1"> Above
                            <input <?php echo isset($_GET['advBelow']) && $_GET['advBelow']==1?'checked':'';?> type="checkbox" id="advBelow" onclick="$('#advAbove').prop('checked', false)" name="advBelow" value="1"> Below
                            </span>
                            <select class="form-control" id="advType" name="advType">
                                <option value="">Select Advance Type</option>
                                <?php foreach($advanceTypes as $arr){?>
                                <option <?php echo isset($data['advType'])?$data['advType']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Book No</label>
                                <input type="text" name="book_no" value="<?php echo isset($data['book_no'])?$data['book_no']:'';?>" placeholder="Enter book number" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Text(name,mobile,summary)</label>
                            <input type="text" name="txtInput" value="<?php echo isset($data['txtInput'])?$data['txtInput']:'';?>" class="form-control" placeholder="Enter name,mobile,summary">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="FromDate">From Date: </label>
                                <input type="text" class="form-control" id="FromDate" name="from_date" placeholder="From Date" value="<?php echo isset($data['from_date'])?$data['from_date'] : $settings['default_date'];?>">
                            </div>                            
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="ToDate">To Date: </label>
                                <input type="text" class="form-control" id="ToDate" name="to_date" placeholder="To Date" value="<?php echo isset($data['to_date'])?$data['to_date'] : date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div id="showOnlyContainer" class="col-sm-3">
                            <div class="form-group">
                                
                                <input type="radio" class="" id="due_paid_only" name="due_paid_only" value="1" <?php echo isset($data['due_paid_only']) && $data['due_paid_only']==1?'checked' : '';?>>
                                <label for="due_paid_only">Show paid only</label>
                                <br>
                                <input type="radio" class="" id="due_paid_only" name="due_paid_only" value="2" <?php echo isset($data['due_paid_only']) && $data['due_paid_only']==2?'checked' : '';?>>
                                <label for="due_paid_only">Show due only</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Search</button>
                </form>                
            </div>
        </div>    
    </div>
</div>

<?php if( isset($_GET['from_date']) ) { ?>

<section class="col-sm-12">
    <div class="row">

        <div class="col-sm-12 alert alert-info">
            <h3 style="margin:0">Total Billing Information</h3>
            <div class="row">
                <div class="col-sm-2">
                    <h4>Balance</h4>
                    (-) means DUE<br>
                    (+) means Advance
                </div>
                <div class="col-sm-2">
                    <h4>In Action</h4>
                    View Details<br>
                    Modify Record
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Zone</th>
                        <th>House No</th>
                        <th>Floor</th>
                        <th>Payment Type</th>
                        <th>Billed</th>
                        <th>Paid</th>
                        <th>Balance</th>
                        <th>Book No</th>
                        <th>Collector</th>
                        <th>Action</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php 
                    $total_monthly_billed = 0;
                    $total_paid = 0;
                    $total_balance = 0;
                    foreach ($lists as $key => $value) { ?>
                    <?php 
                    	
                    	if ( isset($data['due_paid_only']) && $data['due_paid_only']==1 ){
                    		// show only paid
                    		if ( $value->amount + $value->discount < 1)
                    			continue; 
                    	}
                    	if ( isset($data['due_paid_only']) && $data['due_paid_only']==2 ){
                    		// show only due
                    		if ( $value->amount + $value->discount > 0)
                    			continue; 
                    	}

                        $total_monthly_billed += $value->monthly_bill;
                        $total_paid += $value->total_amount;   
                        $total_balance =  ($total_paid-$total_monthly_billed);                        
                    ?>
                    <tr class="">
                        <td><?php echo $value->client_id ?></td>
                        <td><?php echo $value->full_name; ?></td>
                        <td><?php echo $value->mobile; ?></td>
                        <td><?php echo $value->zone; ?></td>
                        <td><?php echo $value->house_no; ?></td>
                        <td><?php echo $value->floor; ?></td>
                        <!-- <td><?php //echo $value->apartment; ?></td> -->
                        <!-- <td><?php //echo date('F', strtotime($value->billing_date));?>, <?php //echo $value->billing_year;?></td> -->
                        <td><?php echo $this->payment->get_payment_type($value->billing_type); ?></td>
                        <td><?php echo $value->monthly_bill; ?></td>
                        <td><?php echo $value->amount; ?></td>
                        
                        <td><?php 
                           
                        echo $this->payment->currencyFormat($value->amount - $value->monthly_bill);   
                        ?>        
                        </td>
                        <td><?php echo $value->book_no; ?></td>
                        <td><?php echo $value->collector; ?></td>
                        <!-- <td><?php //echo date('d-m-Y h:m:s A', strtotime($value->created)); ?></td> -->
                        <td style="text-align: center">
                            
                            <div class="dropdown">
                              <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i>
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu pull-right" style="min-width: auto;">
                                <li><a class="" href="<?php echo base_url($admin_path) ?>/payment/bill/details/<?php echo $value->id ?>">Details</a> </li>
                                <?php /* if( $this->master->isPermission('super_admin_power') ){ ?> 
                            <li><a class="" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path) ?>/payment/bill/delete/<?php echo $value->payment_id ?>">Delete</a></li>
                            <?php } */ ?>
                              </ul>
                            </div>

                            
                            
                        </td>
                    </tr>
                        
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Zone</th>
                        <th>House No</th>
                        <th>Floor</th>
                        <th>Payment Type</th>
                        <th>Billed</th>
                        <th>Paid</th>
                        <th>Balance</th>
                        <th>Book No</th>
                        <th>Collector</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <!-- <th></th> -->
                        <!-- <th></th> -->
                        <th><?php echo $this->payment->currencyFormat($total_monthly_billed);?></th>
                        <th><?php echo $this->payment->currencyFormat($total_paid);?></th>                        
                        <th><?php echo $this->payment->currencyFormat($total_balance);   
                        ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                    <tr>
                        <th colspan="16">
                        <p>Total Billed= <?php echo $this->payment->currencyFormat($total_monthly_billed);?></p>
                        <p>Total Paid= <?php echo $this->payment->currencyFormat($total_paid);?></p>
                        <?php echo $total_balance>0?'Total Advance= ':'Total Due= '; echo $this->payment->currencyFormat(abs($total_balance));?>
                        </th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</section>

<?php } ?>

<?php setGrid();?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#FromDate, #ToDate').datepicker({dateFormat: 'yy-mm-dd'});

        $("#dueType").on('change', function(){
            if ( $(this).val()!="" ){
                $("#advType").val('');
                $("#advTypeContainer").hide();
                $("#showOnlyContainer").hide();
                $("#due_paid_only").val('');
            }else{
                $("#advType").val('');
                $("#advTypeContainer").show();
                $("#showOnlyContainer").show(); 
            }
        });
        $("#advType").on('change', function(){
            if ( $(this).val()!="" ){
                $("#dueType").val('');
                $("#dueTypeContainer").hide();
                $("#showOnlyContainer").hide();
                $("#due_paid_only").val('');
            }else{
                $("#dueType").val('');
                $("#dueTypeContainer").show();
                $("#showOnlyContainer").show();
            }
        })
    });
</script>
<style type="text/css">
	.Deleted td { background-color: #ce9696!important; }
    .option_checkbox { float: right; }
</style>