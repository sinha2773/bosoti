<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<?php $packages = $this->master->get_all('tbl_packages');
$package_arr = array();
foreach($packages as $k=>$v)
    $package_arr[$v->id] = $v->title;
?>
<table class="table">
    <div class="info"><strong>History Log of :</strong> From <span class="billing_month_text"><?php echo $from_date_alise;?></span> to <span class="billing_month_text"><?php echo $to_date_alise;?></span></div>
        <tr>
            <th>#ID</th>
            <th>Client</th>
            <th>Added By</th>
            <th>His Title</th>
            <th>Status</th>
            <th>Comment</th>
            <th>Date</th>
        </tr>
   
        <?php 
        foreach ($lists as $key => $value) { ?>
        <tr class="">
            <td><?php echo $value->client_id ?></td>
            <td><?php echo $value->full_name; ?></td>
            <td><?php echo $value->added_by; ?></td>
            <td>
                <?php 
                if($value->meta_key == 'ctype')
                    echo 'Client Type'; 
                elseif($value->meta_key == 'ptype')
                    echo 'Payment Type';
                else
                    echo ucfirst($value->meta_key);
                ?>                            
            </td>
            <td>
                <?php 
                if($value->meta_key == 'ctype')
                    echo $this->client->get_client_type($value->status_id)['text']; 
                elseif($value->meta_key == 'ptype')
                    echo $this->client->get_payment_type($value->status_id)['text']; 
                elseif($value->meta_key == 'package')
                    echo $package_arr[$value->status_id];
                elseif($value->meta_key == 'status')
                    echo $this->client->get_status($value->status_id)['text'];
                else echo $value->status_id;
                ?>
            </td>
            <td><?php echo $value->comment; ?></td>
            <td><?php echo date('d-m-Y h:m:s A', strtotime($value->added_time)); ?></td>
        </tr>
        <?php } ?>   

</table>