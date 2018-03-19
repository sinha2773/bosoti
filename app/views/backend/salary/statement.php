<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">

<form name="form" method="get" action="" enctype="multipart/form-data">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">                
                <div class="form-group">
                    <label>Employee</label>
                    <select name="employee_id" id="employee_id" class="" onchange="empDetails(this.value)" style="width: 100%;" required>
                    <option value="">Select Employee</option>
                    <?php foreach($employees as $obj){?>
                    <option <?php echo $employee_id==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->full_name;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>From Date</label>
                    <input type="text" name="from_date" id="from_date" value="<?php echo $settings['default_date'];?>" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>To Date</label>
                    <input type="text" name="to_date" id="to_date" value="<?php echo date('Y-m-d');?>" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-eye" aria-hidden="true"></i> Show</button>
                </div>
            </div>     
        </div>        
    </div>   
</form>


<?php if( isset($employee_id) && (int)$employee_id>0 ){ ?>

<?php include(dirname(__dir__).'/common/page_part/all_status_title.php');?>

<div class="client_statement">
    <?php if( !empty($employee_info)){ ?>
        <?php $this->load->view('backend/common/page_part/employee_details'); ?>
    <?php } //if client info ?>

    <?php if( !empty($payment_info)){ ?>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    
                    <table id="listTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#Invoice</th>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Bill Type</th>
                                <th>Monthly Salary</th>
                                <th>Paid</th>
                                <th>Bonus/Adj</th>
                                <th>Book No</th>
                                <th>Summary</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php 
                            $total_monthly_billed = 0;
                            $total_paid = 0;
                            $total_dis_adj = 0;
                            foreach ($payment_info as $key => $value) { ?>
                            <tr class="">
                                <td><?php echo $value->payment_id;?></td>
                                <td><?php echo $value->billing_year;?></td>
                                <td><?php echo date('m', strtotime($value->billing_date)); ?></td>
                                <td><?php echo $value->billing_type==1?'Salary':'Advance'; ?></td>
                                <td><?php echo $value->monthly_bill; ?></td>
                                <td><?php echo $value->amount; ?></td>
                                <td>
                                    <?php echo $value->adjustment_amount; ?>
                                </td>                           
                                <td><?php echo $value->book_no; ?></td>
                                <td><?php echo $value->summary; ?></td>
                                <td><?php echo date('d-m-Y h:m:s A', strtotime($value->created)); ?></td>
                                
                            </tr>
                                <?php 
                                    $total_monthly_billed += $value->monthly_bill;
                                    $total_paid += $value->amount;
                                    $total_dis_adj += $value->adjustment_amount;
                                ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo $this->payment->currencyFormat($total_monthly_billed);?></th>
                                <th><?php echo $this->payment->currencyFormat($total_paid);?></th>
                                <th><?php echo $this->payment->currencyFormat($total_dis_adj);?></th>
                                
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="10">
                                <p>Total Billed= <?php echo $this->payment->currencyFormat($total_monthly_billed);?></p>
                                Total Paid= <?php echo $this->payment->currencyFormat($total_paid + $total_dis_adj);?>
                                </th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </section>

    <?php }else{ echo '<h4 class="text-center">No Records</h4>';} // if payment info ?>
</div>
<?php } // if client id ?>

<?php setGrid(); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#employee_id').select2();
        $('#from_date,#to_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>