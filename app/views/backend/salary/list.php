<div id="widget-grid" class="col-sm-12">       
    <div class="section">
        <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
            <header>
                <h2>Advance Filter</h2>
            </header>
            <div class="widget-body section_content">
                <form method="get" action="<?php echo base_url($admin_path);?>/payment/bill/list">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Client Type</label>
                                <select name="client_type" class="form-control">
                                <option value="">Select Client Type</option>
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
                                <option value="">Select Payment Type</option>
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
                                <option value="">Select package</option>
                                <?php foreach($packages as $obj){?>
                                <option <?php echo isset($data['package_id'])?$data['package_id']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?> (Monthly Bill: <?php echo $obj->price;?>) (VAT: <?php echo $obj->vat;?>%) (Total: <?php echo $obj->total;?>)</option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                <?php foreach($statuses as $arr){?>
                                    <option <?php echo isset($data['status'])?$data['status']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
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
                                <option value="">Select Address</option>
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
                                <option value="">Select Zone</option>
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
                                <option value="">Select Apartment</option>
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
                                <option value="">Select Bill Collector</option>
                                <?php foreach($operators as $obj){?>
                                <option <?php echo isset($data['collector'])?$data['collector']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->name;?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <label>Due Type</label>
                            <select class="form-control" name="dueType">
                                <option value="">Select Due Type</option>
                                <?php foreach($dueTypes as $arr){?>
                                <option <?php echo isset($data['dueType'])?$data['dueType']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Advance</label>
                            <select class="form-control" name="advType">
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
                        <div class="col-sm-3">
                            <div class="form-group">
                                
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

<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Zone</th>
                        <th>House No</th>
                        <th>Floor</th>
                        <th>Apartment</th>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Payment Type</th>
                        <th>Monthly Billed</th>
                        <th>Bill Paid</th>
                        <th>Dis/Adj</th>
                        <th>Advance</th>
                        <th>Book No</th>
                        <th>Collector</th>
                        <th>Time</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php 
                    $total_monthly_billed = 0;
                    $total_paid = 0;
                    $total_dis_adj = 0;
                    $total_advance = 0;
                    foreach ($lists as $key => $value) { ?>
                    <tr class="">
                        <td><?php echo $value->client_id ?></td>
                        <td><?php echo $value->full_name; ?></td>
                        <td><?php echo $value->mobile; ?></td>
                        <td><?php echo $value->address; ?></td>
                        <td><?php echo $value->zone; ?></td>
                        <td><?php echo $value->house_no; ?></td>
                        <td><?php echo $value->floor; ?></td>
                        <td><?php echo $value->apartment; ?></td>
                        <td><?php echo $value->billing_year;?></td>
                        <td><?php echo date('m', strtotime($value->billing_date)); ?></td>
                        <td><?php echo $value->billing_type; ?></td>
                        <td><?php echo $value->monthly_bill; ?></td>
                        <td><?php echo $value->amount; ?></td>
                        <td>
                            <?php echo $value->discount; ?>+
                            <?php echo $value->adjustment_amount; ?>
                        </td>
                        <td><?php echo $value->advance_amount; ?></td>
                        <td><?php echo $value->book_no; ?></td>
                        <td><?php echo $value->collector; ?></td>
                        <td><?php echo date('d-m-Y h:m:s A', strtotime($value->created)); ?></td>
                        <td style="text-align: center">
                            <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path) ?>/payment/bill/details/<?php echo $value->id ?>">Details</a> 
                            <!-- <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path) ?>/client/edit/<?php echo $value->id ?>">Edit</a> 
                            <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path) ?>/client/delete/<?php echo $value->id ?>">Delete</a> -->
                        </td>
                    </tr>
                        <?php 
                            $total_monthly_billed += $value->monthly_bill;
                            $total_paid += $value->amount;
                            $total_dis_adj += $value->discount + $value->adjustment_amount;
                            $total_advance += $value->advance_amount;                         
                        ?>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><?php echo $this->payment->currencyFormat($total_monthly_billed);?></th>
                        <th><?php echo $this->payment->currencyFormat($total_paid);?></th>
                        <th><?php echo $this->payment->currencyFormat($total_dis_adj);?></th>
                        <th><?php echo $this->payment->currencyFormat($total_advance);?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="19">
                        <p>Total Billed= <?php echo $this->payment->currencyFormat($total_monthly_billed);?></p>
                        Total Paid= <?php echo $this->payment->currencyFormat($total_paid + $total_dis_adj + $total_advance);?>
                        </th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</section>

<?php setGrid();?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#FromDate, #ToDate').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
<style type="text/css">
	.Deleted td { background-color: #ce9696!important; }
</style>