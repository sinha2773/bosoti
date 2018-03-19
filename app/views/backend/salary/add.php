<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">

<form name="form" method="post" action="<?php echo base_url($admin_path);?>/employee/salary/insert" enctype="multipart/form-data">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Employee ID</label>
                    <select name="employee_id" id="employee_id" class="" onchange="empDetails(this.value)" style="width: 100%;" required>
                    <option value="">Select Employee</option>
                    <?php foreach($employees as $obj){?>
                    <option value="<?php echo $obj->id;?>"><?php echo $obj->full_name;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
 
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Check No</label>
                    <input type="text" name="book_no" placeholder="Enter Check No" class="form-control">
                </div>
            </div> 

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="DateLevel">Salary Date</label>
                    <input type="text" name="billing_date" id="billing_date" placeholder="Enter salary/advance salary date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                    <input type="hidden" id="AdDate"  value="<?php echo date('Y-m-d', strtotime('+1 month ', time()));?>">
                </div>                
            </div>

        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" id="payment_type" class="form-control" required>
                    <?php foreach($payment_types as $arr){?>
                    <option <?php echo isset($arr['selected'])?'selected':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" step="any" required>
                </div>
            </div> 

            <div class="col-sm-4">
                <div id="paytype_2" class="form-group">
                    <label>Adjustment/Bonus</label>
                    <input type="number" name="adjustment" id="adjustment" class="form-control" step="any">
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
                <a href="<?php echo base_url($admin_path);?>/employee/salaryStatement">
                    <button type="button" class="btn btn-danger btn-lg"><i class="fa fa-reply" aria-hidden="true"></i> Cancel</button>
                </a>
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Save</button>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="payment_summary">
            <h3>Employee Details</h3>
            <div class="payment_details"></div>
        </div>
    </div>

    
</form>
<script type="text/javascript">
    function empDetails(employee_id){
        $.ajax({
            'url':'<?php echo base_url('admin/employee/employeeSalaryDetails');?>',
            'method': 'POST',
            'data':{'employee_id':employee_id},
            'dataType': 'json',
            success: function(json){
                console.log(json);
            	$('#amount').val(parseFloat(json.employee_info._monthly_bill));
                var html = "";
                html += '<div>';                

            	html += '<h3><span class="green">Paid: '+ json.employee_info.paid_cur_month +'</span></h3>';
            	html += '<h3><span class="red">Due: '+ json.employee_info.due_amount +'</span></h3>';

                html += '<h3>Monthly Salary: ' +json.employee_info.monthly_bill + '</h3>';
          
                html += '<h5>Name: ' + json.employee_info.name + '</h5>';
                html += '<h5>Designation: ' + json.employee_info.job_title + '</h5>';
                html += '<h5>Basic Salary: ' + json.employee_info.basic_salary + '</h5>';
                html += '<h5>House Rent: ' + json.employee_info.house_rent + '</h5>';
                html += '<h5>Medical allownce: ' + json.employee_info.medical_allownce + '</h5>';
                html += '<h5>Other allownce: ' + json.employee_info.other_allownce + '</h5>';
                html += '<h5>Gross Total: ' + json.employee_info.total + '</h5>';

                html += '</div>';

                $('.payment_details').html(html);
            }
        });
    }
    jQuery(document).ready(function(){
        $('#employee_id').select2();
        $('#billing_date').datepicker({dateFormat: 'yy-mm-dd'});
        var salDate = $('#billing_date').val();
        var advDate = $('#AdDate').val();
        $('#payment_type').on('change',function(){
            var value = $(this).val();
            if(value==2){
                $('#paytype_2').hide();
                $('.DateLevel').html('Date of Advance Month');
                $('#billing_date').val(advDate);
            }else{
                $('#paytype_2').show();
                $('.DateLevel').html('Salary Date');
                $('#billing_date').val(salDate);
            }
        });
    });
</script>
<style type="text/css">
    .payment_summary { width: 100%; height: 100%; background-color: #fff; color: #000; min-height: 200px; padding:10px; }
    .payment_summary h3 { margin: 0 0 5px 0; padding-top: 0; }
    .payment_details h5 { margin:1px; }
</style>