<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<table class="table">
    <div class="info">
        <div><label>Client Statement: </label> <?php if(isset($_REQUEST['from_date']) && isset($_REQUEST['to_date'])){ ?>
                        <?php echo 'From '.date('d-m-Y', strtotime($_REQUEST['from_date'])).' To '. date('d-m-Y', strtotime($_REQUEST['to_date']));?>
                        <?php } ?></div>
        <div><label>Name: </label><?php echo $client_info->name;?></div>
        <div><label>Member ID: </label><?php echo $client_info->client_id;?></div>
        <div><label>Admission Date: </label> <?php echo date('l, d M Y', strtotime($client_info->admission_date));?></div>

    </div>
    <thead>
        <tr>
            <th>Payment Date</th>
            <th>Added By</th>
            <th>Amount</th>
            <th width="160">Entry Time</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        $total_balance = 0;
        foreach ($payment_info as $key => $value) { ?>
        <?php 
            $total_balance = $total_balance + $value->amount;
        ?>
        
        <tr class="">
            <td><?php echo date('d-m-Y', strtotime($value->payment_date)); ?></td>
            <td><?php echo $value->added_user; ?></td>
            <td><?php echo $value->amount; ?></td> 
            <td><?php echo date('Y-m-d h:s A', strtotime($value->created));?></td>                             
        </tr>
        <?php } ?>  
    </tbody>
    <tfoot>
        <tr>                                
            <th></th>                                
            <th></th>                                
            <th><?php echo $this->payment_model->currencyFormat($total_balance);?></th>
            <th></th>
        </tr>
    </tfoot>

</table>