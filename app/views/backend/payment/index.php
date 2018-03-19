
<?php if( !empty($client_info)){ ?>
	<?php $this->load->view('backend/common/page_part/client_details'); ?>
<?php } //if client info ?>

<section class="content">
    <div class="box">
        <div class="box-body">
            
            <form class="form-inline pull-right date_search">
              <div class="form-group">
                <label for="FromDate">From Date: </label>
                <input type="text" class="form-control" id="FromDate" placeholder="From Date" value="<?php echo $from_date==''?$client_info->connection_date:$from_date;?>">
              </div>
              <div class="form-group">
                <label for="ToDate">To Date: </label>
                <input type="text" class="form-control" id="ToDate" placeholder="To Date" value="<?php echo $to_date==''?date('Y-m-d'):$to_date;?>">
              </div>
              <button type="button" id="SearchDateRange" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            </form>

            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Bill Type</th>
                        <th>Payment Date</th>
                        <th>Monthly Bill</th>
                        <th>Bill Paid(Discount)</th>
                        <th>Collector</th>
                        <th>Book</th>
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php 
                    $total_monthly_billed = 0;
                    $total_paid = 0;
                    foreach ($lists as $key => $values) { ?>
                    <tr class="">
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $billing_types[$values->billing_type]['text']; ?></td>
                        <td><?php echo $values->billing_date; ?></td>
                        <td><?php echo $values->monthly_bill; ?></td>
                        <td><?php echo $values->amount; echo $values->discount>0?"({$values->discount})":''; ?></td>
                        <td><?php echo $values->collector; ?></td>
                        <td><?php echo $values->book_no; ?></td>
                        <td><?php echo $values->summary; ?></td>
                        <td>
                        	<div class="dropdown">
                              <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i>
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu pull-right" style="min-width: auto;">
                                <?php  if( $this->master->isPermission('super_admin_power') ){ ?> 
		                            <li><a class="" onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url($admin_path) ?>/payment/bill/delete/<?php echo $values->payment_id ?>">Delete</a></li>
		                            <?php }  ?>
                              </ul>
                            </div>
                        </td>
                    </tr>
                    <?php $total_monthly_billed += $values->monthly_bill;
                     $total_paid += $values->amount + $values->discount;?>
                     <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total Billed= <?php echo number_format($total_monthly_billed, 2, '.', ',');?> TK</th>
                        <th>Total Paid= <?php echo number_format($total_paid, 2, '.', ',');?> TK</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
               

            </table>
        </div>
    </div>
</section>

<div class="form-group">
    <a href="<?php echo base_url($admin_path);?>/payment/billingReport"><input type="button" class="btn btn-danger pull-left" value="Back"></a>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#FromDate, #ToDate').datepicker({dateFormat: 'yy-mm-dd'});
        $('#SearchDateRange').on('click', function(){
            var from_date = $('#FromDate').val();
            var to_date = $('#ToDate').val();
            var url = '<?php echo $search_url;?>';
            window.location = url +'/'+from_date+'/'+to_date;
        });
    });
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
<style type="text/css">
    .client_info p { margin-bottom: 0; }
    .client_info label { width: 80px; display: inline-block; }
    .client_info .col2 label { width: 120px; }
</style>