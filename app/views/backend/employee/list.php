<a class="btn btn-primary pull-right" href="<?php echo base_url($admin_path);?>/common/add/<?php echo $action;?>">Add New</a>

<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Job Title</th>
                        <th>Joining Date</th>
                        <th>Salary</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
               
                    <tbody>
                         <?php foreach ($lists as $keay => $values) { ?>
                        <tr>
                            <td><?php echo $values->id ?></td>
                            <td><?php echo $values->full_name; ?></td>
                            <td><?php echo $values->job_title; ?></td>
                            <td><?php echo $values->joining_date; ?></td>
                            <td><?php echo $values->basic_salary + $values->house_rent + $values->medical_allownce + $values->other_allownce; ?></td>
                            <td style="text-align: center">
                                <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path) ?>/common/detail/<?php echo $action;?>/<?php echo $values->id ?>">Details</a> 
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