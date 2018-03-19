<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php 
$user_role = array();
if( !empty($user_roles) )
foreach($user_roles as $ur){
    $user_role[$ur->user_role_id] = $ur->name;
}
?>
<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="checkAll"/></th>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
               
                    <tbody>
                         <?php foreach ($lists as $key => $row) { ?>
                        <tr>
                            <td><input type="checkbox" values="<?php echo $row->id;?>" /></td>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->name, " ", $row->surname ; ?></td>
                            <td><?php echo $row->email; ?></td>
                            <td><?php echo $row->mobile; ?></td>
                            <td><?php echo $row->username; ?></td>
                            <td><?php echo $user_role[$row->user_role_id]; ?></td>
                            <td><?php echo $row->created; ?></td>
                            <td><?php echo $row->updated; ?></td>
                            <td style="text-align: center">
                                <a class="btn btn-xs btn-primary" href="<?php echo base_url($admin_path);?>/user/edit_user/<?php echo $row->id;?>">Edit</a> 
                                <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path);?>/user/delete_user/<?php echo $row->id ?>">Delete</a>
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