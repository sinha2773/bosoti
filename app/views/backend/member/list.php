<a class="btn btn-primary pull-right" href="<?php echo base_url($admin_path);?>/common/add/<?php echo $action;?>">Add New</a>

<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Admission Date</th>
                        <th>Total Amount</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>               
                <tbody>
                     <?php foreach ($lists as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value->id ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->fathername; ?></td>
                        <td><?php echo $value->admission_date; ?></td>
                        <td><?php //?> 300</td>
                        <td style="text-align: center">
                            <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path) ?>/common/detail/<?php echo $action;?>/<?php echo $value->id ?>">Details</a> 
                            <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path) ?>/common/edit/<?php echo $action;?>/<?php echo $value->id ?>">Edit</a> 
                            <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path) ?>/common/delete/<?php echo $action;?>/<?php echo $value->id ?>">Delete</a>
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