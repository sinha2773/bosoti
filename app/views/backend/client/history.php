
<?php $packages = $this->master->get_all('tbl_packages');
$package_arr = array();
foreach($packages as $k=>$v)
    $package_arr[$v->id] = $v->title;
?>

<?php if( !empty($client_info)){ ?>
    <?php $this->load->view('backend/common/page_part/client_details'); ?>
<?php } //if client info ?>


<section class="content">
    <div class="box">
        <div class="box-body">
            
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php 
                    foreach ($histories as $key => $value) { ?>
                    <tr class="">
                        <td><?php echo $key+1; ?></td>
                        <td>
                            <?php 
                            if($value->meta_key == 'ctype')
                                echo 'Client Type'; 
                            elseif($value->meta_key == 'ptype')
                                echo 'Payment Type';
                            else
                                echo ucfirst($value->meta_key);
                            ?>                            
                        </td>
                        <td>
                            <?php 
                            if($value->meta_key == 'ctype')
                                echo $this->client->get_client_type($value->status_id)['text']; 
                            elseif($value->meta_key == 'ptype')
                                echo $this->client->get_payment_type($value->status_id)['text']; 
                            elseif($value->meta_key == 'package')
                                echo $package_arr[$value->status_id];
                            elseif($value->meta_key == 'status')
                                echo $this->client->get_status($value->status_id)['text'];
                            else echo $value->status_id;
                            ?>
                        </td>
                        <td><?php echo $value->comment; ?></td>
                        <td><?php echo date('d-m-Y h:m:s A', strtotime($value->added_time)); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</section>

<div class="form-group">
    <a href="<?php echo base_url($admin_path);?>/client"><input type="button" class="btn btn-danger pull-left" value="Back"></a>
</div>

<?php setGrid(); ?>

<style type="text/css">
    .client_info p { margin-bottom: 0; }
    .client_info label { width: 80px; display: inline-block; }
    .client_info .col2 label { width: 120px; }
</style>