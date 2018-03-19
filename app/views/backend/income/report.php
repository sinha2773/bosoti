
<section class="content">
    <div class="box">
        <div class="box-body">
            
            <form class="form-inline pull-right date_search">
              <div class="form-group">
                <label for="FromDate">Income Type: </label>
                <select class="form-control" name="income_type" id="IncomeType">
                    <option value="all">All</option>
                    <?php treeOption($income_types,$selected_income);?>       
                </select>
              </div>
              <div class="form-group">
                <label for="FromDate">From Date: </label>
                <input type="text" class="form-control" id="FromDate" placeholder="From Date" value="<?php echo $from_date==''?'2017-01-01':$from_date;?>">
              </div>
              <div class="form-group">
                <label for="ToDate">To Date: </label>
                <input type="text" class="form-control" id="ToDate" placeholder="To Date" value="<?php echo $to_date==''?date('Y-m-d'):$to_date;?>">
              </div>
              <button type="button" id="SearchDateRange" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            </form>

            <?php 
            $gross_total = 0;
            if( empty($incomes) ){
                echo '<h3>No any income.</h3>';
            }else {

            foreach($incomes as $key=>$income){
            if( !empty($income['list']) ){
            ?>
            <div class="row">
                <div class="col-sm-12 income_item">
                <h3 class="title alert alert-warning"><?php echo $income['name'];?></h3>
                <table id="listTable<?php echo $key;?>" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>From</th>
                            <th>Invoice</th>
                            <th>Invoice Date</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Remark</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                         <?php 
                         $total = 0;
                         foreach ($income['list'] as $keay => $values) { ?>
                        <tr>
                            <td><?php echo $keay+1; ?></td>
                            <td><?php echo $values->payment_from; ?></td>
                            <td><?php echo $values->invoice; ?></td>
                            <td><?php echo $values->income_date; ?></td>
                            <td><?php echo $values->amount; ?></td>
                            <td><?php echo $values->payment_method; ?></td>
                            <td><?php echo $values->remark; ?></td>
                            <td><?php echo date($settings['date_format'], strtotime($values->updated) ); ?></td>
                        </tr>
                         <?php 
                         $total += $values->amount;
                         $gross_total += $values->amount;
                         } ?>
                    </tbody>  

                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total= <?php echo $this->payment->currencyFormat($total);?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>            

                </table>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#listTable<?php echo $key;?>').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false
                    });
                });
            </script>
            <?php }else{ ?>
                <div class="row">
                    <div class="col-sm-12 income_item">
                        <h3 class="title alert alert-warning"><?php echo $income['name'];?></h3>
                        <div class="alert alert-danger">No any income.</div>
                    </div>
                </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="col-sm-12 alert alert-success">
     Gross Total= <?php echo $this->payment->currencyFormat($gross_total);?>
    </div>
</section>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#FromDate, #ToDate').datepicker({dateFormat: 'yy-mm-dd'});
        $('#SearchDateRange').on('click', function(){
            var inc_type = $('#IncomeType').val();
            var from_date = $('#FromDate').val();
            var to_date = $('#ToDate').val();
            var url = '<?php echo $search_url;?>';
            window.location = url +'/'+inc_type+'/'+from_date+'/'+to_date;
        });
    });
</script>
<style type="text/css">
    .income_item .title { margin-bottom: 0px; padding:5px 10px; /*background-color: #ddd;*/ }
</style>