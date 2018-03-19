<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<?php // include(dirname(__dir__).'/common/page_part/all_status_title.php');?>

<table class="table">
    <div class="info">
        <div><label>Client Statement: </label> <?php if(isset($_REQUEST['from_date']) && isset($_REQUEST['to_date'])){ ?>
                        <?php echo 'From '.date('d-m-Y', strtotime($_REQUEST['from_date'])).' To '. date('d-m-Y', strtotime($_REQUEST['to_date']));?>
                        <?php } ?></div>
        <div><label>Name: </label><?php echo $client_info->full_name;?></div>
        <div><label>Client ID: </label><?php echo $client_info->client_id;?></div>
        <div><label>Connection Date: </label> <?php echo date('l, d M Y', strtotime($client_info->connection_date));?></div>

    </div>
    <!-- <thead> -->
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
    <!-- </thead> -->
   
    <!-- <tbody> -->
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
    <!-- </tbody> -->
    <!-- <tfoot> -->
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
    <!-- </tfoot> -->

</table>