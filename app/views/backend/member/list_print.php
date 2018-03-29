<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<table class="table">
    <div class="info">
        <h3 style="margin:4px;">All Members</h3>
    </div>

    <tr>
        <th>Client ID</th>
        <th>Name</th>
        <th>Father Name</th>
        <th>Address</th>
        <th>Mobile</th>
        <th>Image</th>
    </tr>

   <?php foreach ($lists as $key => $value) { ?>
   <tr>
    <td><?php echo $value->client_id ?></td>
    <td><?php echo $value->name; ?></td>
    <td><?php echo $value->fathername; ?></td>
    <td><?php echo $value->present_address; ?></td>
    <td><?php echo $value->mobile; ?></td> 
    <td>
        <?php $media = $this->master->get_image($value->media_id,"member"); ?>
        <img src="<?php echo $media->src;?>" width="60" height="60"/>
    </td> 
</tr>
<?php } ?>

</table>