<?php 
$users = $this->master->get_all($this->master->user_table);
$user_arr = array();
foreach($users as $obj){
    $user_arr[$obj->id] = $obj->name.' '.$obj->surname;
}
$drafts = $this->master->get_all($this->master->income_table, array('where'=>array('status'=>0)) );
?>
<table class="table">
    <tr>
        <th>Added By</th>
        <th>Payment From</th>
        <th>Amount</th>
        <th>Time</th>
        <th>Edit</th>
    </tr>
    <?php 
    if ( !empty($drafts) ) {
    foreach($drafts as $row) { 
    ?>
    <tr>
        <td><?php echo $user_arr[$row->user_id];?></td>
        <td><?php echo $row->payment_from;?></td>
        <td><?php echo $row->amount;?></td>
        <td><?php echo date( $settings['date_format'], strtotime($row->updated) );?></td>
        <td>
            <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path) ?>/common/edit/<?php echo $action;?>/<?php echo $row->id ?>">Edit</a>
            <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path) ?>/common/delete/<?php echo $action;?>/<?php echo $row->id ?>?redirect=<?php echo base_url($admin_path) ?>/common/add/<?php echo $action;?>">Delete</a>
        </td>
    </tr>
    <?php } 

    }else { ?>
        <tr>
            <td colspan="5" align="center">No Draft/Save records</td>
        </tr>
    <?php 
    }
    ?>
</table>