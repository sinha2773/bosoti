<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">

<form name="form" method="get" action="" enctype="multipart/form-data">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Client ID</label>
                    <select name="client_id" id="client_id" class="" onchange="clientDetails(this.value)" style="width: 100%;" required>
                    <option value="">Select Client</option>
                    <?php foreach($clients as $client){?>
                    <option <?php echo $client_id==$client->id?'selected':'';?> value="<?php echo $client->id;?>"><?php echo $client->client_id;?></option>
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


<?php if( isset($client_id) && (int)$client_id>0 ){ ?>

<?php //include(dirname(__dir__).'/common/page_part/all_status_title.php');?>

<div class="client_statement">
    <?php if( !empty($client_info)){ ?>
        <?php $this->load->view('backend/common/page_part/client_details'); ?>
    <?php } //if client info ?>

    <?php if( !empty($payment_info)){ ?>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    
                    <table id="listTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Bill Month</th>
                                <th>Bill</th>
                                <th>&nbsp;</th>
                                <th>Collection Date</th>
                                <th>Collector</th>
                                <th>Book No</th>
                                <th>Bill Type</th>
                                <th>Bill</th>
                                <th>Paid(Discount)</th>
                                <th>Balance</th>
                                <th>Entry Time</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php 
                            $total_monthly_billed = 0;
                            $total_paid = 0;
                            $total_discount = 0;
                            $total_balance = 0;
                            //print_r($payment_info);exit;
                            foreach ($payment_info as $key => $value) { ?>
                            <?php 
                                $total_monthly_billed += $value->monthly_bill;
                                $total_paid += $value->amount;
                                $total_discount += $value->discount;
                                $total_balance = ($total_paid + $total_discount)-$total_monthly_billed;
                            ?>
                            
                            <tr class="">
                                <td><?php echo date('F', strtotime($value->billing_date));?>,
                                     <?php echo $value->billing_year;?>
                                </td>
                                <td><?php echo $value->monthly_bill; ?></td>
                                <td>&nbsp;</td>
                                <td><?php echo date('d-m-Y', strtotime($value->collection_date==null?$value->billing_date:$value->collection_date)); ?></td>
                                <td><?php echo $value->collector; ?></td>
                                <td><?php echo $value->book_no; ?></td>
                                <td><?php echo $this->payment->get_payment_type($value->billing_type); ?></td>
                                <td><?php echo $value->monthly_bill; ?></td>
                                <td><?php echo $value->amount; ?> <?php echo $value->discount>0?'('.$value->discount.')':''; ?></td>                           
                                <td>
                                    <?php                                
                                echo $this->payment->currencyFormat($value->amount + $value->discount - $value->monthly_bill);
                                    ?>
                                </td>
                                <td><?php echo date('Y-m-d h:s A', strtotime($value->created));?></td>
                                
                            </tr>
                            <?php } ?>  
                        </tbody>
                        <tfoot>
                            <tr>                                
                                <th></th>
                                <th><?php echo $this->payment->currencyFormat($total_monthly_billed);?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo $this->payment->currencyFormat($total_monthly_billed);?></th>
                                <th><?php echo $this->payment->currencyFormat($total_paid + $total_discount);?></th>                                
                                <th><?php echo $this->payment->currencyFormat($total_balance);?></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="11">
                                <p>Total Billed= <?php echo $this->payment->currencyFormat($total_monthly_billed);?></p>
                                <p>Total Paid= <?php echo $this->payment->currencyFormat($total_paid+$total_discount);?></p>

                            <?php echo $total_balance>0?'Total Advance= ':'Total Due= '; echo $this->payment->currencyFormat(abs($total_balance));?>
                                </th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </section>

    <?php } // if payment info ?>
</div>
<?php } // if client id ?>

<?php setGrid(); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#client_id').select2();
        $('#from_date,#to_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>