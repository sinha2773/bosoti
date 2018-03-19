
<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
               
                    <tbody>
                         <?php foreach ($lists as $keay => $values) { ?>
                        <tr>
                            <td><?php echo $values->id ?></td>
                            <td><?php echo $values->title; ?></td>
                            <td><?php echo $values->slug; ?></td>
                            <td><?php echo $values->created; ?></td>
                            <td><?php echo $values->updated; ?></td>
                            <td><?php echo $values->status; ?></td>
                            <td style="text-align: center">
                                <a class="btn btn-xs btn-warning" href="<?php echo base_url($admin_path) ?>/menu/assign/<?php echo $values->id ?>">Assign Page</a> 
                                <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path) ?>/edit/menu/<?php echo $values->id ?>">Edit</a> 
                                <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path) ?>/delete/menu/<?php echo $values->id ?>">Delete</a>
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