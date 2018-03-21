<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">

<?php $form_attrib = array('id' => 'bank_action_form');
echo form_open('',  $form_attrib, '');?>

<div class="col-sm-8">
	<div class="row">
        <div class="alert alert-success" id="success" style="display:none" role="alert">Transaction Completed Successfully.</div>
        <div class="alert alert-danger" id="no_bank_acc_id" style="display:none" role="alert">Select A Bank Account</div>
        <div class="alert alert-danger" id="no_amount" style="display:none" role="alert">Enter Valid Amount</div>
        <div class="alert alert-danger" id="no_payment_date" style="display:none" role="alert">Enter Payment Date</div>
        <div class="alert alert-danger" id="insufficient_amount_in_cashbook" style="display:none" role="alert">Insufficient Amount in Cashbook</div>
        <div class="alert alert-danger" id="db_failed" style="display:none" role="alert">Query Failed.Please Try Again</div>

        <div class="alert alert-danger" id="db_insert_failed" style="display:none" role="alert">Insert Failed. Try Again</div>
        <div class="alert alert-danger" id="db_update_failed" style="display:none" role="alert">nsert Failed. Try Again</div>
        <div class="alert alert-danger" id="error transection" style="display:none" role="alert">Transaction Error.Please Try Again</div>
        <div class="col-sm-12">
            <div class="form-group">
                <label >Select Bank Account <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup>
                </label>
                <input type="text" autocomplete="off" name="acc_number" placeholder="Select Bank Account" id="acc_select" class="form-control">
                <span class="help-block" id="acc_help_block" ></span>
                <input type="hidden" autocomplete="off" name="bank_acc_id"  class="form-control">
                <table class="table table-condensed table-hover table-bordered clickable" id="acc_select_result" style="position: absolute;z-index: 10;background-color: #fff;width: 92%">
                </table>
            </div>
        </div>
        <div class="col-sm-12">
         <div class="form-group">
            <label class="amount_label">Amount <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
            <input type="number" name="amount" id="amount" class="form-control" step="any" required>
        </div>
    </div>
    <div class="col-sm-12">
     <div class="form-group">
        <label>Payment Date <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
        <input type="text" name="payment_date" id="payment_date" placeholder="Enter payment date" class="form-control" value="<?php echo isset($_GET['payment_date'])?$_GET['payment_date']:date('Y-m-d');?>" required>
    </div>                
</div> 
<div class="col-sm-12">
    <div class="form-group">
        <label>Note</label>
        <textarea name="summary" class="form-control"></textarea>
    </div>
</div> 


</div>
<div class="row">
  <div class="form-group text-right">
    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    <button type="reset" class="btn btn-danger btn-lg">Cancel</button>
</div>
</div>
</div>

<?php echo form_close();?>
<script type="text/javascript">
    jQuery(document).ready(function(){
    	// $('#client_id').select2();
        $('#payment_date').datepicker({
        	dateFormat: 'yy-mm-dd',
        	minDate: '<?php echo date('Y-m'); ?>-01',
        	maxDate: '<?php echo date('Y-m-d'); ?>'
        });

    });

    var timer;
    $("#acc_select").keyup(function(event) 
    {
        $("#acc_select_result").show();
        $("#acc_select_result").html('');
        clearTimeout(timer);
        timer = setTimeout(function() 
        {
            var search_acc = $("#acc_select").val();
            var html = '';
            $.post('<?php echo site_url(); ?>admin/Bank_transfer/search_bank_acc_by_name',{q: search_acc}, function(data, textStatus, xhr) {
                data = JSON.parse(data);
                $.each(data, function(index, val) {
                    html+= '<tr><td data="'+val.bank_acc_id+'">'+val.bank_account+'</td></tr>';
                });
                $("#acc_select_result").html(html);
            });
        }, 500);
    });
    $("#acc_select_result").on('click', 'td', function(event) {
        $('input[name="acc_number"]').val($(this).text());
        $('input[name="bank_acc_id"]').val($(this).attr('data'));
        $("#acc_select_result").hide();
    });


    $(document).on('submit', '#bank_action_form', function(event) {
        event.preventDefault();
        var post_data = {};
        post_data.bank_acc_id = $('input[name=bank_acc_id]').val();
        post_data.amount = $('input[name=amount]').val();
        post_data.payment_date = $('input[name=payment_date]').val();
        post_data.summary = $('textarea[name=summary]').val();

        $.post('<?php echo base_url() ?>admin/Bank_transfer/save_bank_transaction_info', post_data).done(function(data, textStatus, xhr) {
            var response_data = $.parseJSON(data);
            if(response_data=="success"){
                $('#success').slideDown();
                setTimeout( function(){$('#success').slideUp()}, 5000 );
                $('#bank_action_form')[0].reset();
                $('input[name=bank_acc_id]').val('');
            }
            else if (response_data=="no_bank_acc_id"){
                $('#no_bank_acc_id').slideDown();
                setTimeout( function(){$('#no_bank_acc_id').slideUp()}, 5000 );
            }
            else if (response_data=="no_amount"){
                $('#no_amount').slideDown();
                setTimeout( function(){$('#no_amount').slideUp()}, 5000 );
            }   
            else if (response_data=="no_acc_name"){
                $('#no_acc_name').slideDown();
                setTimeout( function(){$('#no_acc_name').slideUp()}, 5000 );
            }           
            else if (response_data=="payment_date"){
                $('#payment_date').slideDown();
                setTimeout( function(){$('#payment_date').slideUp()}, 5000 );
            }
            else if (response_data=="insufficient_amount_in_cashbook"){
                $('#insufficient_amount_in_cashbook').slideDown();
                setTimeout( function(){$('#insufficient_amount_in_cashbook').slideUp()}, 5000 );
            }
            else if (response_data=="db_insert_failed"){
                $('#db_insert_failed').slideDown();
                setTimeout( function(){$('#db_insert_failed').slideUp()}, 5000 );
            }
            else if (response_data=="db_update_failed"){
                $('#db_update_failed').slideDown();
                setTimeout( function(){$('#db_update_failed').slideUp()}, 5000 );
            }
            else if (response_data=="error transection"){
                $('#error transection').slideDown();
                setTimeout( function(){$('#error transection').slideUp()}, 5000 );
            }
            
        }).error(function() {
            $('#db_failed').slideDown();
            setTimeout( function(){$('#db_failed').slideUp()}, 5000 );
        });  
    });
</script>
<style type="text/css">

.payment_summary { width: 100%; height: 100%; background-color: #fff; color: #000; min-height: 200px; padding:10px; }
.payment_summary h3 { margin: 0 0 5px 0; padding-top: 0; }
.payment_details h5 { margin:1px; }

</style>