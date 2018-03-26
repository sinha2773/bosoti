<!--  <div id="widget-grid" class="col-sm-12">       
    <div class="section">
        <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
            <header>
                <h2>Advance Filter</h2>
            </header>
            <div class="widget-body section_content">
                <form method="get" action="<?php echo base_url($admin_path);?>/payment/bill/list">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Text(name,mobile,summary)</label>
                            <input type="text" name="txtInput" value="<?php echo isset($data['txtInput'])?$data['txtInput']:'';?>" class="form-control" placeholder="Enter name,mobile,summary">
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="FromDate">From Date: </label>
                                <input type="text" class="form-control" id="FromDate" name="from_date" placeholder="From Date" value="<?php echo isset($data['from_date'])?$data['from_date'] : $settings['default_date'];?>">
                            </div>                            
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="ToDate">To Date: </label>
                                <input type="text" class="form-control" id="ToDate" name="to_date" placeholder="To Date" value="<?php echo isset($data['to_date'])?$data['to_date'] : date('Y-m-d'); ?>">
                            </div>
                        </div>                        
                    </div>

                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Search</button>
                </form>                
            </div>
        </div>    
    </div>
</div>  -->

<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php 
                    $total_balance = 0;
                    foreach ($lists as $key => $value) { ?>
                    <?php          	
                    
                    $total_balance = $total_balance + $value->total_amount;                        
                    ?>
                    <tr class="">
                        <td><?php echo $value->client_id ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->mobile; ?></td>
                        <td><?php echo $value->total_amount; ?></td>
                        
                        <td style="text-align: center">
                            
                            <div class="dropdown">
                              <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i>
                                  <span class="caret"></span></button>
                                  <ul class="dropdown-menu pull-right" style="min-width: auto;">
                                    <!-- <li><a class="" href="<?php echo base_url($admin_path) ?>/payment/bill/details/<?php echo $value->id ?>">Details</a> </li> -->
                                    <li><a class="" href="<?php echo base_url($admin_path) ?>/payment/statement?client_id=<?php echo $value->id ?>">Details</a> </li>
                                </ul>
                            </div>                           
                            
                        </td>
                    </tr>
                    
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        
                        <th></th>
                        <th></th>
                        <th></th>                      
                        <th><?php echo $this->payment_model->currencyFormat($total_balance);   
                        ?></th>
                        <th></th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</section>

<?php setGrid();?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#FromDate, #ToDate').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear:true});
    });
</script>
<style type="text/css">
.Deleted td { background-color: #ce9696!important; }
.option_checkbox { float: right; }
</style>