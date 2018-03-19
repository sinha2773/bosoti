<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Disconnect</th>
                        <th>Active</th>
                        <th>Inactive</th>
                        <th>Hold</th>
                        <th>Free</th>
                        <th>Prepaid</th>
                        <th>Postpaid</th>
                        <th>Total</th>
                    </tr>
                </thead>
               
                    <tbody>
                         <?php foreach ($lists as $key => $value) { 
                            $c_info = (array)json_decode($value['client_history']);
                        ?>
                        <tr>
                            <td><?php echo date('F', strtotime($value['g_year'].'-'.$value['g_month'].'-01')), ', ', $value['g_year'];?></td>
                            <td><?php echo $c_info['total_disconnect'];?></td>
                            <td><?php echo $c_info['total_active'];?></td>
                            <td><?php echo $c_info['total_inactive'];?></td>
                            <td><?php echo $c_info['total_hold'];?></td>
                            <td><?php echo $c_info['total_free'];?></td>
                            <td><?php echo $c_info['total_prepaid'];?></td>
                            <td><?php echo $c_info['total_postpaid'];?></td>
                            <td><?php echo $c_info['total_client'];?></td>
                        </tr>
                         <?php } ?>
                    </tbody>
               

            </table>
        </div>
    </div>
</section>

<?php setGrid(); ?>