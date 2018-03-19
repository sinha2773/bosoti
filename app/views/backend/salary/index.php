<?php $status_arr = array('', 'Disconnect', 'Active', 'Inactive', 'Hold'); ?>
<?php $ptype_arr = array('', 'Free', 'Prepaid', 'Postpaid'); ?>
<?php $ctype_arr = array('', 'Analog', 'Digital', 'D.T.S', 'Internet'); ?>
<?php $packages = $this->master->get_all('tbl_packages');
$package_arr = array();
foreach($packages as $k=>$v)
    $package_arr[$v->id] = $v->title;
?>
<div class="row">
<div id="widget-grid" class="col-sm-12">       
    <div class="section">
        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
            <header>
                <h2>Client Details</h2>
            </header>
            <div class="widget-body section_content client_info">
                <div class="col-sm-4 col1">
                    <p>
                        <label>Name: </label> <?php echo $client_info->full_name;?>
                    </p>
                    <p>
                        <label>Client ID: </label> <?php echo $client_info->client_id;?>
                    </p>
                    <p>
                        <label>Gender: </label> <?php echo $this->master->genderArray()[$client_info->gender];?>
                    </p>
                    <p>
                        <label>Mobile: </label> <?php echo $client_info->mobile;?>
                    </p>
                    <p>
                        <label>Email: </label> <?php echo $client_info->email;?>
                    </p>
                    
                </div>
                
                <div class="col-sm-4 col3">
                    <p>
                        <label>Address: </label> <?php echo $client_info->address;?>
                    </p>
                    <p>
                        <label>Zone: </label> <?php echo $client_info->zone;?>
                    </p>
                    <p>
                        <label>Floor: </label> <?php echo $client_info->floor;?>
                    </p>
                    <p>
                        <label>House No: </label> <?php echo $client_info->house_no;?>
                    </p>
                    <p>
                        <label>Apartment: </label> <?php echo $client_info->apartment;?>
                    </p>
                    <p>
                        <label>Summary: </label> <?php echo $client_info->summary;?>
                    </p>
                </div>

                <div class="col-sm-4 col2">
                    <p>
                        <label>Package: </label> <?php echo $client_info->package;?>
                        (<?php echo $client_info->price;?> + <?php echo $client_info->vat;?>(%) = 
                        <?php echo number_format($client_info->total, 2, '.', ',');?> TK)
                    </p>
                    <p>
                        <label>Client Type: </label> <?php echo $ctype_arr[$client_info->client_type];?>
                    </p>
                    <p>
                        <label>Payment Type: </label> <?php echo $ptype_arr[$client_info->payment_type];?>
                    </p>
                    <p>
                        <label>Connection Date: </label> <?php echo date('l, d M Y', strtotime($client_info->connection_date));?>
                    </p>
                    <p>
                        <label>Status: </label> <?php echo $status_arr[$client_info->status];?>
                    </p>
                </div>
            </div>
        </div>    
    </div>
</div>
</div>

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
                        <th>Bill Paid</th>
                        <th>Collector</th>
                        <th>Book</th>
                        <th>Note</th>
                        <!-- <th>Advance</th> -->
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
                        <td><?php echo $values->amount; ?></td>
                        <td><?php echo $values->collector; ?></td>
                        <td><?php echo $values->book_no; ?></td>
                        <td><?php echo $values->summary; ?></td>
                        <!-- <td><?php echo $values->advance_amount>0 ?$values->advance_amount.' ('.$values->advance_count.')':'No'; ?></td> -->
                    </tr>
                    <?php $total_monthly_billed += $values->monthly_bill;
                     $total_paid += $values->amount;?>
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
                        <!-- <th></th> -->
                    </tr>
                </tfoot>
               

            </table>
        </div>
    </div>
</section>

<div class="form-group">
    <a href="<?php echo base_url($admin_path);?>/payment/list"><input type="button" class="btn btn-danger pull-left" value="Back"></a>
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