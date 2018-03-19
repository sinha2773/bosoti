
<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="checkAll"/></th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Order</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
               
                    <tbody>
                         <?php foreach ($lists as $key => $row) { ?>
                        <tr>
                            <td><input type="checkbox" values="<?php echo $row->id;?>" /></td>
                            <td><?php echo $row->title; ?></td>
                            <td><?php echo $row->gallery_type; ?></td>
                            <td><?php echo $row->order_id; ?></td>
                            <td><?php echo $row->created; ?></td>
                            <td><?php echo $row->updated; ?></td>
                            <td style="text-align: center">
                                <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path);?>/edit/gallery/<?php echo $row->id;?>">Edit</a> 
                                <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path);?>/delete/gallery/<?php echo $row->id ?>">Delete</a>
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