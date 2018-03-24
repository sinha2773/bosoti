<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">
        <article class="col-sm-6">
            <!-- new widget -->
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                    <h2>Post/Draft All</h2>
                </header>

                <!-- widget div-->
                <div class="padding">
                    <div class="widget-body">
                        <?php $this->load->view('backend/income/draft_list');?>
                    </div>
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>

        <article class="col-sm-6">
            <!-- new widget -->
            <div class="jarviswidget" id="wid-id-1" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                    <h2>Add New Receipt Invoice</h2>
                </header>

                <!-- widget div-->
                <div class="padding">
                    <div class="widget-body">
                        <form id="InvoiceForm" name="form" method="post" action="<?php echo base_url();?>admin/income/save_receipts_voucher/">
                            <input type="hidden" id="status" name="status" value="0">
                            <input type="hidden" name="user_id" value="true">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Invoice From</label>
                                    <input type="text" name="payment_from" placeholder="Enter invoice from name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Income Type</label>
                                    <select type="text" name="intype_id" class="form-control" required>
                                        <?php $pages = $this->master->get_all($this->master->income_type_table, array('output'=>'result_array'));
                                        $pages = $this->master->buildTree($pages, 'parent_id', 'id');
                                    //print_r($pages);exit;
                                    //foreach ($pages as $key => $obj) {
                                     //   echo "<option value='{$obj->id}'>{$obj->title}</option>";
                                    //}
                                        treeOption($pages);
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Invoice</label>
                                    <input type="text" name="invoice" placeholder="Enter invoice" class="form-control disable" readonly="" value="<?php echo $settings['invoice_prefix'].date('Ymd_his');?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" id="amount" name="amount" placeholder="Enter amount" step="any" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select type="text" name="payment_method" id="payment_type" class="form-control">
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Invoice Date</label>
                                    <input type="text" name="income_date" id="income_date" placeholder="Enter income date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12" style="display: none" id="bank_select_div">
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
                            </div>


                            <div class="row">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <textarea class="form-control" name="remark" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="<?php echo base_url($admin_path);?>/common/get_all/<?php echo $action;?>"><input type="button" class="btn btn-danger" value="Cancel"></a>

<!--                                 <?php if( $this->master->isPermission('save_income') ){ ?>
                                <input type="button" onclick="submitForm(0)" class="btn btn-info" value="Save">
                                <?php } ?> -->

                                <?php if( $this->master->isPermission('add_income') ){ ?>
                                <input type="button" onclick="submitForm(1)" class="btn btn-primary" value="Add">
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
    </div>
</section>

<script type="text/javascript">
    function submitForm(status){
        jQuery('#status').val(status); 

        if ( jQuery('#amount').val()>0 )       
            jQuery('#InvoiceForm').submit();
    }
    jQuery(document).ready(function(){
        $('#income_date').datepicker({dateFormat: 'yy-mm-dd'});
    });

    $(document).on('change', '#payment_type', function(event) {
        event.preventDefault();
        if(this.value == "cheque"){
            $('#bank_select_div').show();

        }
        else{
            $('#bank_select_div').hide();
        }
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
</script>