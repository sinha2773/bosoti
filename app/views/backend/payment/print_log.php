<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>


<table class="table">
    <div class="info"><strong>Payment Log of :</strong> From <span class="billing_month_text"><?php echo $from_date_alise;?></span> to <span class="billing_month_text"><?php echo $to_date_alise;?></span></div>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Payment Type</th>
                <th>Entry By</th>
                <th>Collector</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Created</th>
            </tr>

            <?php 
            $total_paid = 0;

            foreach ($lists as $key => $value) { ?>
            <?php                              
                $total_paid += $value->amount;             
            ?>
            <tr class="">
                <td><?php echo $value->client_id ?></td>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->payment_type; ?></td>
                <td><?php echo $value->added_by; ?></td>
                <td><?php echo $value->collector; ?></td>
                <td><?php echo $this->payment->currencyFormat($value->amount); ?></td>
                <td><?php echo date('l, d F Y', strtotime($value->payment_date)); ?></td>
                <td><?php echo date('l, d F Y h:s A', strtotime($value->created)); ?></td>
            </tr>
            <?php } ?>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?php echo $this->payment->currencyFormat($total_paid);?></th>
                <th></th>
                <th></th>
            </tr>
            

   

</table>