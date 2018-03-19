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
    <tr>
        <th>Member ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Balance</th>
    </tr>

    <?php 
    $total_balance = 0;
    foreach ($lists as $key => $value) { ?>
    <?php 
        $total_balance =  $total_balance + $value->total_amount;                        
    ?>
    <tr class="">
        <td><?php echo $value->client_id ?></td>
        <td><?php echo $value->name; ?></td>
        <td><?php echo $value->mobile; ?></td>
        <td><?php echo $value->total_amount; ?></td>     
        
    </tr>
        
    <?php } ?>
    <tr>
        
        <th></th>        
        <th></th>
        <th></th>
        <th><?php echo $this->payment->currencyFormat($total_balance);   
        ?></th>
    </tr>

</table>