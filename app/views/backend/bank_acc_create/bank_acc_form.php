<?php $form_attrib = array('id' => 'bank_acc_form');
echo form_open('',  $form_attrib, '');?>
<div class="col-sm-9">
	<div class="alert alert-success" id="save_success" style="display:none" role="alert">Bank Account Created Successfully.</div>
	<div class="alert alert-danger" id="no_bank_name" style="display:none" role="alert">Enter Bank Name</div>
	<div class="alert alert-danger" id="no_branch_name" style="display:none" role="alert">Enter Branch Name.</div>
	<div class="alert alert-danger" id="no_acc_name" style="display:none" role="alert">Enter Account Name.</div>
	<div class="alert alert-danger" id="no_acc_number" style="display:none" role="alert">Enter Account Number.</div>
	<div class="alert alert-danger" id="db_failed" style="display:none" role="alert">Query Failed.Please Try Again</div>


	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Bank Name <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
				<input type="text" name="bank_name" placeholder="Enter Bank Name" class="form-control" required >
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Branch Name <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
				<input type="text" name="branch_name" placeholder="Enter Branch Name" class="form-control" required>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Bank Account Name <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
				<input type="text" name="acc_name" placeholder="Enter Bank Account Name" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="form-group">
				<label>Account Number <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
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

		$.post('<?php echo base_url() ?>admin/Bank_acc_create/create_bank_account', post_data).done(function(data, textStatus, xhr) {
			var response_data = $.parseJSON(data);
			console.log(response_data);
			if(response_data=="success"){
				$('#save_success').slideDown();
				setTimeout( function(){$('#save_success').slideUp()}, 5000 );
				$('#bank_acc_form')[0].reset();
			}
			else if (response_data=="no_bank_name"){
				$('#no_bank_name').slideDown();
				setTimeout( function(){$('#no_bank_name').slideUp()}, 5000 );
			}
			else if (response_data=="no_branch_name"){
				$('#no_branch_name').slideDown();
				setTimeout( function(){$('#no_branch_name').slideUp()}, 5000 );
			}	
			else if (response_data=="no_acc_name"){
				$('#no_acc_name').slideDown();
				setTimeout( function(){$('#no_acc_name').slideUp()}, 5000 );
			}			
			else if (response_data=="no_acc_number"){
				$('#no_acc_number').slideDown();
				setTimeout( function(){$('#no_acc_number').slideUp()}, 5000 );
			}
			else if (response_data=="db_failed"){
				$('#db_failed').slideDown();
				setTimeout( function(){$('#db_failed').slideUp()}, 5000 );
			}
			
		}).error(function() {
			$('#db_failed').slideDown();
			setTimeout( function(){$('#db_failed').slideUp()}, 5000 );
		});  
	});
</script>




