<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>


<table class="table">
    <div class="info"><strong>Payment Log of :</strong> From <span class="billing_month_text"><?php echo $from_date_alise;?></span> to <span class="billing_month_text"><?php echo $to_date_alise;?></span></div>
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Payment Type</th>
            <th>Resident</th>
            <th>Entry By</th>
            <th>Collector</th>
            <th>Billing Month</th>
            <th>Collection Date</th>
            <th>Billed</th>
            <th>Paid</th>
            <th>Created</th>
        </tr>
   
        <?php 
        $total_billed = 0;
        $total_paid = 0;

        foreach ($lists as $key => $value) { ?>
        <?php                              
            $total_billed += $value->monthly_bill;
            $total_paid += $value->amount;             
        ?>
        <tr class="">
            <td><?php echo $value->client_id ?></td>
            <td><?php echo $value->full_name; ?></td>
            <td><?php echo $this->client->get_payment_type($value->payment_type)['text']; ?></td>
            <td><?php echo $this->client->get_resident($value->resident)['text']; ?></td>
            <td><?php echo $value->added_by; ?></td>
            <td><?php echo $value->collector; ?></td>
            <td><?php echo date('F', strtotime($value->billing_year.'-'.$value->billing_month.'-01')), ', ', $value->billing_year; ?></td>
            <td><?php echo $value->collection_date; ?></td>
            <td><?php echo $this->payment->currencyFormat($value->monthly_bill); ?></td>
            <td><?php echo $this->payment->currencyFormat($value->amount); ?></td>
            <td><?php echo date('l, d F Y h:s A', strtotime($value->created)); ?></td>
        </tr>
        <?php } ?>

        <tr>                        
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><?php echo $this->payment->currencyFormat($total_billed);?></th>
            <th><?php echo $this->payment->currencyFormat($total_paid);?></th>
            <th></th>
        </tr>

   

</table>