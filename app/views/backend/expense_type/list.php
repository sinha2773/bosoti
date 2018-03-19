<a class="btn btn-primary pull-right" href="<?php echo base_url($admin_path);?>/common/add/<?php echo $action;?>">Add New</a>

<?php 
$_all = $this->master->get_all('tbl_expense_types');
$list_arr = array(0=>'Main Category'); 
foreach($_all as $row)
    $list_arr[$row->id] = $row->title;

?>

<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Parent Category</th>
                        <th>Order</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
               
                    <tbody>
                         <?php foreach ($lists as $keay => $values) { ?>
                        <tr>
                            <td><?php echo $values->id ?></td>
                            <td><?php echo $values->title; ?></td>
                            <td><?php echo $list_arr[$values->parent_id]; ?></td>
                            <td><?php echo $values->order_id; ?></td>
                            <td><?php echo $values->created; ?></td>
                            <td><?php echo $values->updated; ?></td>
                            <td><?php echo $values->status; ?></td>
                            <td style="text-align: center">
                                <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path) ?>/common/edit/<?php echo $action;?>/<?php echo $values->id ?>">Edit</a> 
                                <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path) ?>/common/delete/<?php echo $action;?>/<?php echo $values->id ?>">Delete</a>
                            </td>
                        </tr>
                         <?php } ?>
                    </tbody>
               

            </table>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(function() {
        $('#listTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>