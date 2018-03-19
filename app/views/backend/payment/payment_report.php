
<section class="col-sm-12">
    <div class="row">
        <div class="alert alert-info">
            <form method="get" action="<?php echo base_url($admin_path);?>/payment/billingReport" style="margin-bottom: 10px;">
            <div id="BillinMonthSelect">
                <input type="text" value="<?php echo isset($data['from_date'])?$data['from_date'] : $settings['default_date'];?>" class="" id="from_date" name="from_date" style="width:80px;" />
                <input type="text" value="<?php echo isset($data['to_date'])?$data['to_date'] : date('Y-m-d'); ?>" class="" id="to_date" name="to_date" style="width:80px;" />
                <button style="margin-top:-3px;" type="submit" class="btn btn-primary btn-xs">Show</button>
                <span>From <?php echo $data['from_date'],' to ', $data['to_date'];?></span>
            </div> 
            </form>
            
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    $('#from_date, #to_date').datepicker({
                        dateFormat: 'yy-mm-dd'
                    });
                });
            </script>            
        </div>

    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Monthly Billed</th>
                        <th>Con/Re-Con/Adj Billed(+)</th>
                        <th>Previous Due(+)</th>
                        <th>Total Pre Advance</th>
                        <th>Cutted Pre Adv(-)</th>
                        <th>Balance Pre Adv</th>
                        <th>Discount(-)</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Present Due</th>
                        <th>Present Advance</th>
                        <th>Action</th>
                    </tr>
                </thead>
               
               <?php if( !empty($lists) ) :?>
                <tbody>

                    <?php 

                    foreach ($lists as $key => $value) { ?>
                    <?php 
                    	
                    	if ( isset($data['due_paid_only']) && $data['due_paid_only']==1 ){
                    		// show only paid
                    		if ( $value->paid + $value->discount < 1)
                    			continue; 
                    	}
                    	if ( isset($data['due_paid_only']) && $data['due_paid_only']==2 ){
                    		// show only due
                    		if ( $value->paid + $value->discount > 0)
                    			continue; 
                    	}

                        
                    ?>
                    <tr class="">
                        <td><?php echo $value->client_id_alias; ?></td>
                        <td><?php echo $value->client_name; ?></td>
                        <td><?php echo $value->monthly_bill; ?></td>
                        <td><?php echo $value->adj_bill; ?></td>
                        <td><?php echo $value->previous_due; ?></td>
                        <td><?php echo $value->previous_advance; ?></td>                        
                        <td><?php echo $value->cuted_previous_advance; ?></td>                        
                        <td><?php echo $value->previous_advance_after_cuted; ?></td>                        
                        <td><?php echo $value->discount; ?></td>                        
                        <td><?php echo $value->total_billed; ?></td>
                        <td><?php echo $value->paid; ?></td>
                        <td><?php echo $value->present_due; ?></td>
                        <td><?php echo $value->present_advance; ?></td>

                        <td style="text-align: center">
                            
                            <div class="dropdown">
                              <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i>
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu pull-right" style="min-width: auto;">
                                <li><a target="_blank" class="" href="<?php echo base_url($admin_path) ?>/client/statement?client_id=<?php echo $value->client_id; ?>">Client Statement</a> </li>
                                <li><a target="_blank" class="" href="<?php echo base_url($admin_path) ?>/payment/bill/details/<?php echo $value->client_id; ?>">Details</a> </li>
                              </ul>
                            </div>                            
                            
                        </td>
                    </tr>
                        
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Monthly Billed</th>
                        <th>Con/Re-Con/Adj Billed(+)</th>
                        <th>Previous Due(+)</th>
                        <th>Total Pre Advance</th>
                        <th>Cutted Pre Adv(-)</th>
                        <th>Balance Pre Adv</th>
                        <th>Discount(-)</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Present Due</th>
                        <th>Present Advance</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <th><?php //echo $this->payment->currencyFormat($total_monthly_billed);?></th>
                        <th><?php //echo $this->payment->currencyFormat($total_paid);?></th>                        
                        <th><?php echo $list_total->total_monthly_billed;?></th>
                        <th><?php echo $list_total->total_monthly_other_billed;?></th>
                        <th><?php echo $list_total->total_previous_due;?></th>
                        <th><?php echo $list_total->total_previous_advance;?></th>
                        <th><?php echo $list_total->total_cuted_previous_advance;?></th>
                        <th><?php echo $list_total->total_previous_advance_after_cuted;?></th>
                        <th><?php echo $list_total->total_monthly_discount;?></th>
                        <th><?php echo $list_total->total_all_monthly_billed;?></th>
                        <th><?php $p_adv = $list_total->total_present_advance - $list_total->total_previous_advance_after_cuted; echo $list_total->total_all_paid-$p_adv;?></th>
                        <th><?php echo $list_total->total_present_due;?></th>
                        <th><?php echo $p_adv;?></th>
                        <th></th>
                    </tr>

                    <tr>
                        <th class="total_part" colspan="14">
                        <p>Balance Previous Adv = <?php $balance_pre_adv = $list_total->total_previous_advance - $list_total->total_cuted_previous_advance; echo '<b>'.$this->payment->currencyFormat($balance_pre_adv).'</b>';?> <span>(Total Pre Advance - Cutted Pre Adv)</span></p>
                        <p>Balance Present Adv = <?php $balance_present_adv = $list_total->total_present_advance - $balance_pre_adv; echo '<b>'.$this->payment->currencyFormat($balance_present_adv).'</b>';?> <span>(Present Advance - Balance Previous Adv)</span></p>
                        <p>Total Present Advance = <?php echo '<b>'.$this->payment->currencyFormat($list_total->total_present_advance).'</b>';?> <span>(Balance Pre Adv + Present Advance)</span></p>
                        <p>Total Billed = <?php echo '<b>'.$this->payment->currencyFormat($list_total->total_all_monthly_billed).'</b>';?> <span>(Monthly Billed + Con/Re-Con/Adj Billed + Previous Due - Cutted Pre Adv - Discount)</span></p>
                        <p>Total Paid = <?php echo '<b>'.$this->payment->currencyFormat($list_total->total_all_paid).'</b>';?> <span>(Paid + Balance Present Adv)</span></p>
                        <p>Present Due = <?php echo '<b>'.$this->payment->currencyFormat($list_total->total_present_due).'</b>';?> <span>(Total Billed - Paid)</span></p>
                        
                        <?php //echo $total_present_due-$total_present_advance>0?'Total Due= ':'Total Advance= '; echo $this->payment->currencyFormat(abs($total_present_due-$total_present_advance));?>
                        </th>
                    </tr>
                </tfoot>
                <?php endif;?>
            </table>
        </div>
    </div>
</section>

<?php setGrid();?>


<style type="text/css">
    .total_part p b { color: green; font-weight: bold; }
    .total_part p span { color: red; }
    /*tr td:nth-child(3),
    tr td:nth-child(4),
    tr td:nth-child(5),
    tr td:nth-child(7),
    tr td:nth-child(9) {
        background: #8ae2b6;
    }

    tr td:nth-child(8),
    tr td:nth-child(10) {
        background: #efacac;
    }*/
</style>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#FromDate, #ToDate').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
<style type="text/css">
	.Deleted td { background-color: #ce9696!important; }
    .option_checkbox { float: right; }
</style>