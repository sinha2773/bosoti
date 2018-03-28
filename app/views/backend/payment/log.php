<section class="content">
    <div class="alert alert-info">


        <form method="get" action="<?php echo base_url();?>admin/payment/log" style="margin-bottom: 10px;">
        <div id="BillinMonthSelect">
            <input type="text" value="<?php echo $from_date;?>" class="" id="from_date" name="from_date" style="width:80px;" />
            <input type="text" value="<?php echo $to_date;?>" class="" id="to_date" name="to_date" style="width:80px;" />
            <select name="collector">
                <?php if ($this->master->isPermission('super_admin_power') || $this->master->isPermission('manager_power')){ ?>
                <option value="">All Collector</option>
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
        <strong>Payment Log of :</strong> From <span class="billing_month_text"><?php echo $from_date_alise;?></span> to <span class="billing_month_text"><?php echo $to_date_alise;?></span>
        

        <!-- <strong>Payment Log of :</strong> <span class="billing_month_text"><?php echo $date_alise;?></span> -->
        <!-- <script type="text/javascript">
            function showEditableMonth(){
                if ($('#BillingMonthEditBtn').text()=='OK'){
                    $('#BillinMonthSelect').css('display','none');
                    $('#BillingMonthEditBtn').text('Edit');
                    window.location.href = base_url + 'admin/payment/log?date='+$('#date').val();
                }
                else{
                    $('#BillinMonthSelect').css('display','inline');
                    $('#BillingMonthEditBtn').text('OK');
                }
            }
        </script>

        <div id="BillinMonthSelect" style="display: none;">
            <input type="text" value="<?php echo $date;?>" class="" id="date" name="date" style="width:80px;" />
        </div> 
        <button style="margin-top:-3px;" id="BillingMonthEditBtn" onclick="showEditableMonth()" type="button" class="btn btn-default btn-xs">Edit</button>
        -->
        <script type="text/javascript">
            jQuery(document).ready(function($){
                // $('#date').datepicker({
                //     dateFormat: 'yy-mm-dd'
                // });
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
                        <th>Name</th>
                        <th>Payment Type</th>
                        <th>Entry By</th>
                        <th>Collector</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        <th>Created</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php 
                    $total_paid = 0;

                    foreach ($lists as $key => $value) { ?>
                    <?php                              
                        $total_paid += $value->amount;             
                    ?>
                    <tr class="">
                        <td><?php echo $value->client_id ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->payment_type; ?></td>
                        <td><?php echo $value->added_by; ?></td>
                        <td><?php echo $value->collector; ?></td>
                        <td><?php echo $this->payment->currencyFormat($value->amount); ?></td>
                        <td><?php echo date('l, d F Y', strtotime($value->payment_date)); ?></td>
                        <td><?php echo date('l, d F Y h:s A', strtotime($value->created)); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><?php echo $this->payment->currencyFormat($total_paid);?></th>
                        <th></th>
                        <th></th>
                    </tr>
                    
                </tfoot>

            </table>
        </div>
    </div>
</section>

<?php setGrid();?>