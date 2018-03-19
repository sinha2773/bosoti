<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<table id="listTable" class="table table-bordered table-striped">
    <div class="info">
        <h3 style="margin:4px;">Billing Report</h3>
        <?php if(isset($_REQUEST['from_date']) && isset($_REQUEST['to_date'])){ ?>
        <p><?php echo 'From '.date('d-m-Y', strtotime($_REQUEST['from_date'])).' To '. date('d-m-Y', strtotime($_REQUEST['to_date']));?></p>
        <?php } ?>
    </div>

    <tr>
        <th>Client ID</th>
        <th>Name</th>
        <th>Monthly Billed</th>
        <th>Con/Re-Con/Adj Billed(+)</th>
        <th>Previous Due(+)</th>
        <th>Total Pre Advance</th>
        <th>Cutted Pre Adv(-)</th>
        <th>Balance Pre Adv</th>
        <th>Discount(-)</th>
        <th>Total</th>
        <th>Paid</th>
        <th>Present Due</th>
        <th>Present Advance</th>
    </tr>

               

    <?php 
    if ( !empty($lists) ) :
    foreach ($lists as $key => $value) { ?>
    <?php 
        
        if ( isset($data['due_paid_only']) && $data['due_paid_only']==1 ){
            // show only paid
            if ( $value->paid + $value->discount < 1)
                continue; 
        }
        if ( isset($data['due_paid_only']) && $data['due_paid_only']==2 ){
            // show only due
            if ( $value->paid + $value->discount > 0)
                continue; 
        }

        
    ?>
    <tr class="">
        <td><?php echo $value->client_id_alias; ?></td>
        <td><?php echo $value->client_name; ?></td>
        <td><?php echo $value->monthly_bill; ?></td>
        <td><?php echo $value->adj_bill; ?></td>
        <td><?php echo $value->previous_due; ?></td>
        <td><?php echo $value->previous_advance; ?></td>                        
        <td><?php echo $value->cuted_previous_advance; ?></td>                        
        <td><?php echo $value->previous_advance_after_cuted; ?></td>                        
        <td><?php echo $value->discount; ?></td>                        
        <td><?php echo $value->total_billed; ?></td>
        <td><?php echo $value->paid; ?></td>
        <td><?php echo $value->present_due; ?></td>
        <td><?php echo $value->present_advance; ?></td>

    </tr>
        
    <?php } ?>

    <tr>
        <th>Client ID</th>
        <th>Name</th>
        <th>Monthly Billed</th>
        <th>Con/Re-Con/Adj Billed(+)</th>
        <th>Previous Due(+)</th>
        <th>Total Pre Advance</th>
        <th>Cutted Pre Adv(-)</th>
        <th>Balance Pre Adv</th>
        <th>Discount(-)</th>
        <th>Total</th>
        <th>Paid</th>
        <th>Present Due</th>
        <th>Present Advance</th>
        <th>Action</th>
    </tr>
    <tr>
        <th><?php //echo $this->payment->currencyFormat($total_monthly_billed);?></th>
        <th><?php //echo $this->payment->currencyFormat($total_paid);?></th>                        
        <th><?php echo $list_total->total_monthly_billed;?></th>
        <th><?php echo $list_total->total_monthly_other_billed;?></th>
        <th><?php echo $list_total->total_previous_due;?></th>
        <th><?php echo $list_total->total_previous_advance;?></th>
        <th><?php echo $list_total->total_cuted_previous_advance;?></th>
        <th><?php echo $list_total->total_previous_advance_after_cuted;?></th>
        <th><?php echo $list_total->total_monthly_discount;?></th>
        <th><?php echo $list_total->total_all_monthly_billed;?></th>
        <th><?php $p_adv = $list_total->total_present_advance - $list_total->total_previous_advance_after_cuted; echo $list_total->total_all_paid-$p_adv;?></th>
        <th><?php echo $list_total->total_present_due;?></th>
        <th><?php echo $p_adv;?></th>
        <th></th>
    </tr>
    <?php endif;?>
</table>