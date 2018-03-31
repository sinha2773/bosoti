<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">

<form name="form" method="get" action="" enctype="multipart/form-data">
    <div class="col-sm-12">
        <div class="row">
<!--             <div class="col-sm-3">
                <div class="form-group">
                    <label>Member ID</label>
                    <select name="client_id" id="client_id" class="" onchange="clientDetails(this.value)" style="width: 100%;" required>
                        <option value="">Select Member</option>
                        <?php foreach($clients as $client){?>
                        <option <?php echo $client_id==$client->id?'selected':'';?> value="<?php echo $client->id;?>"><?php echo $client->client_id;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div> -->
            <div class="col-sm-3">
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
            <div class="col-sm-3">
                <div class="form-group">
                    <label>From Date</label>
                    <input type="text" name="from_date" id="from_date" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : $settings['default_date'];?>" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>To Date</label>
                    <input type="text" name="to_date" id="to_date" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : date('Y-m-d');?>" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-eye" aria-hidden="true"></i> Show</button>
                </div>
            </div>     
        </div>        
    </div>   
</form>


<?php if( isset($client_id) && (int)$client_id>0 ){ ?>

<?php //include(dirname(__dir__).'/common/page_part/all_status_title.php');?>

<div class="client_statement">
    <?php if( !empty($client_info)){ ?>
    <?php $this->load->view('backend/common/page_part/client_details'); ?>
    <?php } //if client info ?>

    <?php if( !empty($payment_info)){ ?>
    <section class="content">
        <div class="box">
            <div class="box-body">

                <table id="listTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Payment Date</th>
                            <th>Added By</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th width="160">Entry Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $total_balance = 0;
                        foreach ($payment_info as $key => $value) { ?>
                        <?php 
                        if($value->payment_type != $this->payment_model->ADJUSTMENT_DEBIT){
                            $total_balance = $total_balance + $value->amount;
                        }
                        if($value->payment_type == $this->payment_model->ADJUSTMENT_DEBIT){
                            $total_balance -= $value->amount;
                        }
                        ?>

                        <tr class="">
                            <td><?php echo date('d-m-Y', strtotime($value->payment_date)); ?></td>
                            <td><?php echo $value->added_user; ?></td>
                            <td><?php echo $this->payment_model->getPaymentType($value->payment_type);?></td>
                            
                            <td>
                                <?php echo ($value->payment_type == $this->payment_model->ADJUSTMENT_DEBIT) ? '-':'';?>
                                <?php echo $this->payment_model->currencyFormat($value->amount); ?>
                            </td>
                            <td><?php echo date('Y-m-d h:s A', strtotime($value->created));?></td>                             
                        </tr>
                        <?php } ?>  
                    </tbody>
                    <tfoot>
                        <tr>                                
                            <th></th>                                
                            <th></th>   
                            <th></th>                             
                            <th><?php echo $this->payment_model->currencyFormat($total_balance);?></th>
                            <th></th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </section>

    <?php } // if payment info ?>
</div>
<?php } // if client id ?>

<?php setGrid(); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#client_id').select2();
        $('#from_date,#to_date').datepicker({dateFormat: 'yy-mm-dd'});
    });

    var timer;
    $("#member_select").keyup(function(event) {
    // $(document).on('keyup', '.#member_select', function(event)
    // {
        $("#memberacc_select_result").show();
        $("#memberacc_select_result").html('');
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
        }, 500);
    });
    $("#member_select_result").on('click', 'td', function(event) {
        $('input[name="member_name"]').val($(this).text());
        $('input[name="client_id"]').val($(this).attr('data'));
        $("#member_select_result").hide();
    });
</script>