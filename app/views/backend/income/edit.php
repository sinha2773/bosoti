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
                    <h2>Edit Receipt Invoice</h2>
                </header>

                <!-- widget div-->
                <div class="padding">
                    <div class="widget-body">
                        <form id="InvoiceForm" name="form" method="post" action="<?php echo base_url();?>admin/income/update_receipts_voucher/">
                            <input type="hidden" name="id" value="<?php echo $data->id;?>">
                            <input type="hidden" id="status" name="status" value="0">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Invoice From</label>
                                    <input type="text" name="payment_from" placeholder="Enter invoice from name" class="form-control" value="<?php echo $data->payment_from;?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Income Type</label>
                                    <select type="text" name="intype_id" class="form-control" required>
                                        <?php $pages = $this->master->get_all($this->master->income_type_table, array('output'=>'result_array'));
                                        $pages = $this->master->buildTree($pages, 'parent_id', 'id');
                                        treeOption($pages, $data->intype_id);
                                    // foreach ($pages as $key => $obj) {
                                    //     $selected = $obj->id == $data->intype_id ? "selected" : "";
                                    //     echo "<option {$selected} value='{$obj->id}'>{$obj->title}</option>";
                                    // }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Invoice</label>
                                    <input type="text" name="invoice" placeholder="Enter invoice" class="form-control disable" readonly="" value="<?php echo $data->invoice;?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" id="amount" name="amount" placeholder="Enter amount" step="any" class="form-control" value="<?php echo $data->amount;?>" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select type="text" disabled name="payment_method" class="form-control">
                                        <option <?php echo $data->payment_method=='cash'?'selected':'';?> value="cash">Cash</option>
                                        <option <?php echo $data->payment_method=='cheque'?'selected':'';?> value="cheque">Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Invoice Date</label>
                                    <input type="text" name="income_date" id="income_date" placeholder="Enter income date" class="form-control" value="<?php echo $data->income_date;?>" required>
                                </div>
                            </div>
                            <?php if ($data->payment_method=='cheque') 
                            {?>
                                <div class="row">
                                    <div class="col-sm-12"  id="bank_select_div">
                                        <div class="form-group">
                                            <label >Select Bank Account <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup>
                                            </label>
                                            <input type="text" autocomplete="off" name="acc_number" placeholder="Select Bank Account" id="acc_select" class="form-control" value="<?php echo $data->acc_number ?>">
                                            <span class="help-block" id="acc_help_block" ></span>
                                            <input type="hidden" autocomplete="off" name="bank_acc_id"  class="form-control" value="<?php echo $data->bank_acc_id ?>">
                                            <table class="table table-condensed table-hover table-bordered clickable" id="acc_select_result" style="position: absolute;z-index: 10;background-color: #fff;width: 92%">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                            }?>


                            <div class="form-group">
                                <label>Remark</label>
                                <textarea class="form-control" name="remark" required><?php echo $data->remark;?></textarea>
                            </div>


                            <div class="form-group">
                                <a href="<?php echo base_url($admin_path);?>/common/get_all/<?php echo $action;?>"><input type="button" class="btn btn-danger" value="Cancel"></a>

<!--                                 <?php if( $this->master->isPermission('save_income') ){ ?>
                                <input type="button" onclick="submitForm(0)" class="btn btn-info" value="Update as Save">
                                <?php } ?> -->

                                <?php if( $this->master->isPermission('add_income') ){ ?>
                                <input type="button" onclick="submitForm(1)" class="btn btn-primary" value="Update as Publish">
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