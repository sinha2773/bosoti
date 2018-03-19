<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<?php //include(dirname(__dir__).'/common/page_part/all_status_title.php');?>

<table class="table">
    <div class="info">
        <h3 style="margin:4px;">Total Billing Informations</h3>
        <?php if(isset($_REQUEST['from_date']) && isset($_REQUEST['to_date'])){ ?>
        <p><?php echo 'From '.date('d-m-Y', strtotime($_REQUEST['from_date'])).' To '. date('d-m-Y', strtotime($_REQUEST['to_date']));?></p>
        <?php } ?>
    </div>
    <!-- <thead> -->
    <tr>
        <th>Client ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Zone</th>
        <th>House No</th>
        <th>Floor</th>
        <th>Billed</th>
        <th>Paid</th>
        <th>Balance</th>
    </tr>
<!-- </thead> -->

<!-- <tbody> -->
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
        $total_paid += $value->amount + $value->discount;
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
        <!-- <td><?php //echo $this->payment->get_payment_type($value->billing_type); ?></td> -->
        <td><?php echo $value->monthly_bill; ?></td>
        <td><?php echo $value->amount; ?></td>        
        <td><?php 
           
        echo $this->payment->currencyFormat($value->amount - $value->monthly_bill);   
        ?>        
        </td>
        <!-- <td><?php //echo date('d-m-Y h:m:s A', strtotime($value->created)); ?></td> -->
        
    </tr>
        
    <?php } ?>
<!-- </tbody> -->
<!-- <tfoot> -->
    <tr>
        <th>Client ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Zone</th>
        <th>House No</th>
        <th>Floor</th>
        <th>Billed</th>
        <th>Paid</th>
        <th>Balance</th>
    </tr>
    <tr>
        
        <th></th>        
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><?php echo $this->payment->currencyFormat($total_monthly_billed);?></th>
        <th><?php echo $this->payment->currencyFormat($total_paid);?></th>
        <th><?php echo $this->payment->currencyFormat($total_balance);   
        ?></th>
    </tr>
<!-- </tfoot> -->

</table>