<?php $form_attrib = array('id' => 'bank_acc_form');
echo form_open('',  $form_attrib, '');?>
<div class="col-sm-9">
	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Bank Name</label>
				<input type="text" name="bank_name" placeholder="Enter Bank Name" class="form-control"  required>
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Branch Name</label>
				<input type="text" name="branch_name" placeholder="Enter Branch Name" class="form-control" required>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Bank Account Name</label>
				<input type="text" name="acc_name" placeholder="Enter Bank Account Name" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="form-group">
				<label>Account Number</label>
				<input type="text" name="acc_number" placeholder="Enter Bank Account Number" class="form-control">
			</div>
		</div>
	</div>
</div>

<div class="form-group text-center" style="float: left; width: 100%;">
	<button type="submit" class="btn btn-primary btn-lg">Submit</button>
	<button type="reset" class="btn btn-danger btn-lg">Cancel</button>
</div>

<?php echo form_close();?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#admission_date, .dateofbirth, .nominee_dateofbirth').datepicker({
			dateFormat: 'yy-mm-dd', 
			changeMonth: true,
			changeYear: true,
		});
	});

	$(document).on('submit', '#bank_acc_form', function(event) {
		event.preventDefault();
		var post_data = {};
		post_data.bank_name = $('input[name=bank_name]').val();
		post_data.branch_name = $('input[name=branch_name]').val();
		post_data.acc_name = $('input[name=acc_name]').val();
		post_data.acc_number = $('input[name=acc_number]').val();

		$.post('<?php echo base_url() ?>Bank_acc_create/create_bank_account', post_data).done(function(data, textStatus, xhr) {
			var response_data = $.parseJSON(data);
			console.log(response_data);
			
		}).error(function() {
			alert("Error. Please Try Again");
		});  
	});
</script>




