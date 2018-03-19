
<section class="content">
    <div class="box">
        <div class="box-body">
            
            <div class="" style="margin:10px 0;">
                <form name="get_client" class="form-inline" action="" method="post">
                    <input class="form-control" type="text" name="client_id_alias" value="<?php echo $client_id_alias;?>" placeholder="Enter Client ID">
                    <button class="btn btn-sm btn-primary" type="submit" name="get_client">Get Client</button>
                </form>
            </div>

            <?php if ( !empty($lists) ) : ?>
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
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
                        <th width="200">Action</th>
                    </tr>
                </thead>
               
                    <tbody>
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
                            <td>
                                <form method="post" action="" class="form-inline">
                                    <input type="hidden" name="client_id" value="<?php echo $values->id;?>">
                                    <input type="hidden" name="client_id_alias" value="<?php echo $values->client_id;?>">
                                    <select name="status" required="">
                                        
                                            <option value="">Select Status</option>
                                            <?php

                                            if( $this->master->isPermission('update_client_status_active') ) {
                                                echo '<option value="2">Active</option>';
                                            }

                                            if( $this->master->isPermission('update_client_status_inactive') ) {
                                                echo '<option value="3">Inactive</option>';
                                            }  

                                            if( $this->master->isPermission('update_client_status_hold') ) {
                                                echo '<option value="4">Hold</option>';
                                            }  

                                            if( $this->master->isPermission('update_client_status_disconnect') ) {
                                                echo '<option value="1">Disconnect</option>';
                                            } 

                                            if( $this->master->isPermission('update_client_status_free') ) {
                                                echo '<option value="5">Free</option>';
                                            }  

                                            ?>

                                        
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-xs btn-primary">Update</button>
                                </form>
                            </td>
                        </tr>
                         <?php } ?>
                    </tbody>
               

            </table>
            <?php endif;?>
        </div>
    </div>
</section>