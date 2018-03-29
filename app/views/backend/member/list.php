<a class="btn btn-primary pull-right" href="<?php echo base_url($admin_path);?>/member/addMember">Add New</a>

<style type="text/css">
    .Deactive td {
        background-color: #F1DA91!important;
    }
</style>
<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Image</th>
                        <th width="40px">Action</th>
                    </tr>
                </thead>               
                <tbody>
                   <?php foreach ($lists as $key => $value) { ?>
                   <tr class="<?php echo $value->status==0?'Deactive':'Active'; ?>">
                    <td><?php echo $value->client_id ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->fathername; ?></td>
                    <td><?php echo $value->present_address; ?></td>
                    <td><?php echo $value->mobile; ?></td> 
                    <td>
                        <?php $media = $this->master->get_image($value->media_id,"member"); ?>
                        <img src="<?php echo $media->src;?>" width="60" height="60"/>
                    </td> 

                    <td style="text-align: center">
                        <div class="dropdown">
                          <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i>
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu pull-right" style="min-width: auto;">
                                <!-- <li><a class="" href="<?php echo base_url($admin_path) ?>/payment/bill/details/<?php echo $value->id ?>">Details</a> </li> -->
                                <li> <a class="" href="<?php echo base_url()?>admin/member/member_details/<?php echo $value->id ?>">Details</a> </li>
                                <li><a class="" href="<?php echo base_url($admin_path) ?>/common/edit/<?php echo $action;?>/<?php echo $value->id ?>">Edit</a> </li>
                                <li> <a class="" onclick="return confirm('Are you sure to Deactive?')" href="<?php echo base_url($admin_path) ?>/member/memberDeactive/<?php echo $value->id ?>/<?php echo $value->status ?>"><?php echo $value->status==1?'Deactive':'Active'; ?></a> </li>
                            </ul>
                        </div>                           

                    </td>
                </tr>
                <?php } ?>
            </tbody>


        </table>
    </div>
</div>
</section>

<?php setGrid();?>

<!-- <script type="text/javascript">
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
</script> -->