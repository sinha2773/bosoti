<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<?php //include(dirname(__dir__).'/common/page_part/all_status_title.php');?>
<table class="table">
    <div class="info">All Clients List</div>
    <!-- <thead> -->
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Zone</th>
            <th>Floor</th>
            <th>House No</th>
            <th>Package</th>
            <th>Status</th>
        </tr>
    <!-- </thead> -->
   
        <!-- <tbody> -->
             <?php foreach ($lists as $keay => $values) { ?>
            <tr class="<?php echo $this->client->get_status($values->status)['text']; ?>">
                <td><?php echo $values->client_id ?></td>
                <td><?php echo $values->full_name; ?></td>
                <td><?php echo $values->mobile; ?></td>
                <td><?php echo $values->address; ?></td>
                <td><?php echo $values->zone; ?></td>
                <td><?php echo $values->floor; ?></td>
                <td><?php echo $values->house_no; ?></td>
                <td><?php echo implode(',',$values->packages),'(',$values->total,')'; ?></td>
                <td><?php echo $this->client->get_status($values->status)['text']; ?></td>
                
            </tr>
             <?php } ?>
        <!-- </tbody> -->
   

</table>