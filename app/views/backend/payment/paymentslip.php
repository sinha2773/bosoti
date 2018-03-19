<section class="content">
    <div class="alert alert-info">
        <strong>Month:</strong> <span class="billing_month_text"><?php echo $due_month['alias'];?></span>

        <script type="text/javascript">
            function showEditableMonth(){
                //if ($('#BillingMonthEditBtn').text()=='OK'){
                    // $('#BillinMonthSelect').css('display','none');
                    // $('#BillingMonthEditBtn').text('Filter');
                    var fullUrl = base_url + 'admin/payment/paymentSlip?billing_date='+$('#year').val()+'-'+$('#month').val();
                    fullUrl = fullUrl+'&zone='+$('#zone option:selected').val();
                    fullUrl = fullUrl+'&dueType='+$('#dueType option:selected').val();
                    if($('#dueAbove').is(':checked'))
                    fullUrl = fullUrl+'&dueAbove='+$('#dueAbove').val();
                    if($('#dueBelow').is(':checked'))
                    fullUrl = fullUrl+'&dueBelow='+$('#dueBelow').val();

                    window.location.href = fullUrl;
                // }
                // else{
                //     $('#BillinMonthSelect').css('display','inline');
                //     $('#BillingMonthEditBtn').text('OK');
                // }
            }
        </script>

        <div id="BillinMonthSelect" style="display: inline;">
            <select class="" id="month" name="month" style="width:80px;">
            <?php for($i=1; $i<=12; $i++):?>
                <option <?php echo $i==$month?'selected':'';?> value="<?php echo $i;?>" <?php echo ($last_billing->g_year==$year && $last_billing->g_month<$i) ? 'disabled' : '' ;?>>
                <?php 
                echo date('F', mktime(0, 0, 0, $i, 10));
                ?>                                      
                </option>
            <?php endfor;?>
            </select>
            <select class="" id="year" name="year"  style="width:80px;">
            <?php for($i=date('Y', strtotime($settings['default_date'])); $i<=date('Y'); $i++):?>
                <option <?php echo $i==$year?'selected':'';?> value="<?php echo $i;?>">
                <?php echo $i;?>
                </option>
            <?php endfor;?>
            </select>
            <select id="zone" name="zone" style="width:160px;">
                <option value="">All Zone</option>
                <?php foreach($zones as $obj){?>
                <option <?php echo isset($data['zone'])?$data['zone']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                <?php } ?>
            </select>
            <div id="dueTypeContainer" style="width:300px; display: inline-block;">
                <select id="dueType" name="dueType">
                    <option value="">Select due months</option>
                    <?php foreach($dueTypes as $arr){?>
                    <option <?php echo isset($data['dueType'])?$data['dueType']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                </select>
                <span class="option_checkbox">
                <input <?php echo isset($_GET['dueAbove']) && $_GET['dueAbove']==1?'checked':'';?> type="checkbox" id="dueAbove" onclick="$('#dueBelow').prop('checked', false)" name="dueAbove" value="1"> Above
                <input <?php echo isset($_GET['dueBelow']) && $_GET['dueBelow']==1?'checked':'';?> type="checkbox" id="dueBelow" onclick="$('#dueAbove').prop('checked', false)" name="dueBelow" value="1"> Below
                </span>
            </div>
            
        </div>
        <button style="margin-top:-3px;" id="BillingMonthEditBtn" onclick="showEditableMonth()" type="button" class="btn btn-default btn-xs">Filter</button>
    </div>

    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="nosort"><input type="checkbox" id="checkedAll"></th>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>House</th>
                        <th>Floor</th>
                        <th>Address</th>
                        <th>Zone</th>
                        <th>Payment Type</th>
                        <th>Resident</th>
                        <!-- <th>Billed(adj)</th>
                        <th>Pre Due</th>
                        <th>Paid</th>
                        <th>Pre Adv</th> -->
                        <th>Total Due</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php 
                    $total_bill = 0;
                    $total_paid = 0;
                    $total_previous_advance = 0;
                    $total_previous_due = 0;
                    $total_present_due = 0;
                    foreach ($lists as $key => $value) { ?>
                    <?php
                    $total_bill += $value->monthly_bill  + $value->adj_bill;
                    $total_paid += $value->paid;
                    $total_previous_advance += $value->previous_advance;
                    $total_previous_due += $value->previous_due;
                    $total_present_due += $value->present_due;
                    ?>
                    <tr class="">
                        <td><input type="checkbox" name="client_id[]" id="list_checkbox" value="<?php echo $value->client_id; ?>"></td>
                        <td><?php echo $value->client_id_alias; ?></td>
                        <td><?php echo $value->full_name; ?></td>
                        <td><?php echo $value->mobile; ?></td>
                        <td><?php echo $value->house_no; ?></td>
                        <td><?php echo $value->floor; ?></td>
                        <td><?php echo $value->address; ?></td>
                        <td><?php echo $value->zone; ?></td>
                        <td><?php echo $this->client->get_payment_type($value->payment_type)['text']; ?></td>
                        <td><?php echo $this->client->get_resident($value->resident)['text']; ?></td>
                        <!-- <td><?php echo $value->monthly_bill; echo $value->adj_bill>0?'('.$value->adj_bill.')':'';?></td>
                        <td><?php echo $value->previous_due; ?></td>
                        <td><?php echo $value->paid; ?></td>
                        <td><?php echo $value->previous_advance; ?></td> -->
                        <td><?php echo $value->present_due; ?></td>
                    </tr>

                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="checkbox" id="checkedAll"></th>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>House</th>
                        <th>Floor</th>
                        <th>Address</th>
                        <th>Zone</th>
                        <th>Payment Type</th>
                        <th>Resident</th>
                        <!-- <th>Billed</th>
                        <th>Pre Due</th>
                        <th>Paid</th>
                        <th>Pre Adv</th> -->
                        <th>Total Due</th>
                    </tr>
                    <tr>                        
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <!-- <th><?php echo $this->payment->currencyFormat($total_bill);?></th>
                        <th><?php echo $this->payment->currencyFormat($total_previous_due);?></th>
                        <th><?php echo $this->payment->currencyFormat($total_paid);?></th>
                        <th><?php echo $this->payment->currencyFormat($total_previous_advance);?></th> -->
                        <th><?php echo $this->payment->currencyFormat($total_present_due);?></th>
                    </tr>
                    
                </tfoot>

            </table>
        </div>
    </div>
</section>


<?php setGrid();?>

<!-- <script type="text/javascript">
    jQuery(document).ready(function(){
        $('#FromDate, #ToDate').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
<style type="text/css">
	.Deleted td { background-color: #ce9696!important; }
    .option_checkbox { float: right; }
</style> -->