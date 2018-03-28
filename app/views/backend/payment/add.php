<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;    
    }
</style>
<form id="PaymentForm" name="form" method="post" action="<?php echo base_url($admin_path);?>/payment/bill/insert" enctype="multipart/form-data" onsubmit='return checkPayment()'>


    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label >Select Member <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup>
                    </label>
                    <input type="text" autocomplete="off" name="member_name" placeholder="Select Member" id="member_select" class="form-control" required>
                    <span class="help-block" id="member_help_block" ></span>
                    <input type="hidden" autocomplete="off" name="client_id"  class="form-control">
                    <table class="table table-condensed table-hover table-bordered clickable" id="member_select_result" style="position: absolute;z-index: 10;background-color: #fff;width: 92%">
                    </table>
                </div>
            </div>
        </div>
        <?php if ($this->session->userdata("user_role") != 4) { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label >Select Collector <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup>
                    </label>
                    <?php if($this->session->userdata('collector_id')) { ?>
                    <input type="text" autocomplete="off" name="collector_name" placeholder="Select Collector" id="collector_select" class="form-control" value="<?php echo $this->session->userdata('collector_name')?>" >
                    <span class="help-block" id="collector_help_block" ></span>
                    <input type="hidden" autocomplete="off" name="collector_id" value="<?php echo $this->session->userdata('collector_id')?>"  class="form-control">
                    <table class="table table-condensed table-hover table-bordered clickable" id="collector_select_result" style="position: absolute;z-index: 10;background-color: #fff;width: 92%">
                    </table>
                    <?php  } else{ ?>
                    <input type="text" autocomplete="off" name="collector_name" placeholder="Select Collector" id="collector_select" class="form-control" >
                    <span class="help-block" id="collector_help_block" ></span>
                    <input type="hidden" autocomplete="off" name="collector_id"  class="form-control">
                    <table class="table table-condensed table-hover table-bordered clickable" id="collector_select_result" style="position: absolute;z-index: 10;background-color: #fff;width: 92%">
                    </table>
                    <?php }?>

                </div>
            </div>
        </div>
        <?php }?>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label >Payment Type <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
                    <select name="payment_type"  class="form-control" style="width: 100%;" required>
                        <!-- <option value="">Select Typr</option> -->
                        <?php if( $this->master->isPermission('save_deposit') ){?>
                        <option value="Deposit">Deposit</option>
                        <?php } ?>
                        <?php if( $this->master->isPermission('save_profit_distribution') ){?>
                        <option value="Profit Distribution">Profit Distribution</option>
                        <?php } ?>
                        <?php if( $this->master->isPermission('save_credit_adjust') ){?>
                        <option value="Credit Adjust">Adjust (Credit)</option>
                        <?php } ?>
                        <?php if( $this->master->isPermission('save_debit_adjust') ){?>
                        <option value="Debit Adjust">Adjust (Debit)</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" id="regular_amt">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="amount_label">Amount <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
                    <input type="number" name="amount" id="amount" class="form-control" step="any" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Payment Date <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup></label>
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

    <div class="col-sm-4" id="details_div" style="display: none">
        <div class="payment_summary">
            <h3>Member Details</h3>
            <div class="member_details_info">
              <table>
                  <tr>
                    <th>Name</th>
                    <td id="name"></td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td id="father_name"></td>
                </tr>
                <tr>
                  <th>Mother Name</th>
                  <td id="mother_name"></td>
              </tr>
              <tr>
                  <th>Mobile</th>
                  <td id="mobile"></td>
              </tr>
              <tr>
               <th>Present Address</th>
               <td id="present_add"></td>
           </tr>
       </table>
   </div>
</div>
</div>

</form>
<div class="billing_table"></div>
<script type="text/javascript">
    var timer;
    var is_paid_today = false;
    $("#member_select").keyup(function(event) 
    {
        $("#member_select_result").show();
        $("#member_select_result").html('');
        clearTimeout(timer);
        timer = setTimeout(function() 
        {
            var search_member = $("#member_select").val();
            var html = '';
            $.post('<?php echo site_url(); ?>admin/Payment/search_member_by_name',{q: search_member}, function(data, textStatus, xhr) {
                data = JSON.parse(data);
                $.each(data, function(index, val) {
                    html+= '<tr><td data="'+val.id+'">'+val.client_id+'</td></tr>';
                });
                $("#member_select_result").html(html);
            });
        }, 200);
    });
    $("#member_select_result").on('click', 'td', function(event) {
        $('input[name="member_name"]').val($(this).text());
        $('input[name="client_id"]').val($(this).attr('data'));
        $("#member_select_result").hide();
        var member_id = $('input[name="client_id"]').val(); 
        $.post('<?php echo site_url(); ?>admin/Payment/get_member_info',{id: member_id}, function(data, textStatus, xhr) {
            member_data = JSON.parse(data);
            $('#details_div').show();
            $('#name').text(member_data['member_info']['name']);
            $('#father_name').text(member_data['member_info']['fathername']);
            $('#mother_name').text(member_data['member_info']['mothername']);
            $('#mobile').text(member_data['member_info']['mobile']);
            $('#present_add').text(member_data['member_info']['present_address']);
            if(member_data['payment_info']['count_id'] > 0 ){
                alert("This Member Already Paid Once Today");
            }

        });
    });

    $("#collector_select").keyup(function(event) 
    {
        $("#collector_select_result").show();
        $("#collector_select_result").html('');
        clearTimeout(timer);
        timer = setTimeout(function() 
        {
            var search_collector = $("#collector_select").val();
            var html = '';
            $.post('<?php echo site_url(); ?>admin/Payment/search_collector_by_name',{q: search_collector}, function(data, textStatus, xhr) {
                data = JSON.parse(data);
                $.each(data, function(index, val) {
                    html+= '<tr><td data="'+val.id+'">'+val.name+'</td></tr>';
                });
                $("#collector_select_result").html(html);
            });
        }, 200);
    });
    $("#collector_select_result").on('click', 'td', function(event) {
        $('input[name="collector_name"]').val($(this).text());
        $('input[name="collector_id"]').val($(this).attr('data'));
        $("#collector_select_result").hide();
    });
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