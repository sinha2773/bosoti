<section class="content">
    <div class="box">
        <div class="box-body">
            
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Send From</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php 
                    foreach ($histories as $key => $value) { ?>
                    <tr class="">
                        <td><?php echo $key+1; ?></td>          
                        <td><?php echo $value->m_from; ?></td>
                        <td><?php echo $value->message; ?></td>
                        <td><?php echo date('d-m-Y h:m:s A', strtotime($value->added)); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</section>


<?php setGrid(); ?>

<style type="text/css">
    .client_info p { margin-bottom: 0; }
    .client_info label { width: 80px; display: inline-block; }
    .client_info .col2 label { width: 120px; }
</style>