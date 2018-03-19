<?php $packages = $this->master->get_all('tbl_packages');
$package_arr = array();
foreach($packages as $k=>$v)
    $package_arr[$v->id] = $v->title;
?>
<section class="content">
    <div class="alert alert-info">


        <form method="get" action="<?php echo base_url();?>admin/history/log" style="margin-bottom: 10px;">
        <div id="BillinMonthSelect">
            <input type="text" value="<?php echo $from_date;?>" class="" id="from_date" name="from_date" style="width:80px;" />
            <input type="text" value="<?php echo $to_date;?>" class="" id="to_date" name="to_date" style="width:80px;" />
            <select name="collector">
                <?php if ($this->master->isPermission('super_admin_power') || $this->master->isPermission('manager_power')){ ?>
                <option value="">All</option>
                <?php } ?>
                <?php foreach($operators as $obj){?>

                    <?php if ($this->master->isPermission('super_admin_power') || $this->master->isPermission('manager_power')){ ?>
                        <option <?php echo isset($_GET['collector']) && $_GET['collector']==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->name;?></option>
                    <?php }elseif($this->session->userdata['user_id']==$obj->id) {?>
                            <option <?php echo isset($_GET['collector']) && $_GET['collector']==$obj->id?'selected':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->name;?></option>
                    <?php } ?>

                <?php } ?>
            </select>
            <button style="margin-top:-3px;" id="BillingMonthEditBtn" type="submit" class="btn btn-primary btn-xs">Show Logs</button>
        </div> 
        </form>
        <strong>History Log of :</strong> From <span class="billing_month_text"><?php echo $from_date_alise;?></span> to <span class="billing_month_text"><?php echo $to_date_alise;?></span>
        
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#from_date, #to_date').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
        </script>
        
    </div>

    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Client</th>
                        <th>Added By</th>
                        <th>His Title</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php 
                    foreach ($lists as $key => $value) { ?>
                    <tr class="">
                        <td><?php echo $value->client_id ?></td>
                        <td><?php echo $value->full_name; ?></td>
                        <td><?php echo $value->added_by; ?></td>
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
                <tfoot>                    
                    
                </tfoot>

            </table>
        </div>
    </div>
</section>

<?php setGrid();?>