<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">

<?php $form_attrib = array('id' => 'transfer_form');
echo form_open('',  $form_attrib, '');?>

<div class="col-sm-8">
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
				<label>Select Bank Account</label>
				<select name="client_id" id="client_id" class="" onchange="clientDetails()" style="width: 100%;" required>
					<option value="">Select Member</option>
					<?php foreach($bank_accounts as $v_bank_acc){?>
					<option value="<?php echo $v_bank_acc->;?>"><?php echo $v_bank_acc->client_id;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="amount_label">Amount</label>
				<input type="number" name="amount" id="amount" class="form-control" step="any" required>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Payment Date</label>
				<input type="text" name="payment_date" id="payment_date" placeholder="Enter payment date" class="form-control" value="<?php echo isset($_GET['payment_date'])?$_GET['payment_date']:date('Y-m-d');?>" required>
			</div>                
		</div> 


	</div>
	<div class="row">

		<div class="col-sm-12">
			<div class="form-group">
				<label>Note</label>
				<textarea name="summary" class="form-control"></textarea>
			</div>
		</div> 

	</div>

	<div class="row">
		<div class="form-group text-right">
			<a href="<?php echo base_url($admin_path);?>/payment/bill">
				<button type="button" class="btn btn-danger btn-lg"><i class="fa fa-reply" aria-hidden="true"></i> Cancel</button>
			</a>
			<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Save</button>
		</div>
	</div>
</div>

<div class="col-sm-4">
	<div class="payment_summary">
		<h3>User Payment Details</h3>
		<div class="payment_details"></div>
	</div>
</div>

</form>
<div class="billing_table"></div>
<script type="text/javascript">
    // To check payment is already paid this month or not
    var isAnyPaidThisMonth = 0;
    function checkPayment(){
    	if(isAnyPaidThisMonth == '1'){
    		if (confirm('You have paid once. Do you want to pay again in this date??')){
    			return true;
    		}
    		else
    			return false;
    	}
    	else
    		return true;
    }


    function clientDetails(){
    	var client_id = $('#client_id').val();
    	var payment_date = $('#payment_date').val();

    	if ( client_id == null || client_id == '' || client_id == undefined )
    		return false;

    	$.ajax({
    		'url':'<?php echo base_url('admin/payment/userPaymentDetails');?>',
    		'method': 'POST',
    		'data':{'client_id':client_id, 'payment_date':payment_date},
    		'dataType': 'html',
    		success: function(html){
    			$('.payment_details').html(html);
    		}
    	});

        // getting status of current month paid or not
        $.ajax({
        	url: '<?php echo base_url('admin/payment/isPaidAnyBillThisMonth');?>',
        	data: {client_id: client_id, payment_date: payment_date},
        	dataType: 'json',
        	method: 'POST',
        	success: function(json){
        		isAnyPaidThisMonth = json.status;
        	}
        });
    }

    

    jQuery(document).ready(function(){
    	$('#client_id').select2();
        // var datepickerObj = {};
        // datepickerObj.dateFormat = 'yy-mm';
        // datepickerObj.changeMonth = true;
        // datepickerObj.changeYear = true;
        // datepickerObj.showButtonPanel = true;
        // datepickerObj.onClose = function(dateText, inst) { 
        //     $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        // };
        // datepickerObj.onChangeMonthYear = function(year, month, widget) {
        //     setTimeout(function() {
        //        $('.ui-datepicker-calendar').hide();
        //     });
        // };

        $('#payment_date').datepicker({
        	dateFormat: 'yy-mm-dd',
        	minDate: '<?php echo date('Y-m'); ?>-01',
        	maxDate: '<?php echo date('Y-m-d'); ?>'
        });

    });
</script>
<style type="text/css">

	.payment_summary { width: 100%; height: 100%; background-color: #fff; color: #000; min-height: 200px; padding:10px; }
	.payment_summary h3 { margin: 0 0 5px 0; padding-top: 0; }
	.payment_details h5 { margin:1px; }

</style>