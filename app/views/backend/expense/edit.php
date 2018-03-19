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
                        <?php $this->load->view('backend/expense/draft_list');?>
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
                    <h2>Edit Payment Invoice</h2>
                </header>

                <!-- widget div-->
                <div class="padding">
                    <div class="widget-body">
                    <form id="InvoiceForm" name="form" method="post" action="<?php echo base_url($admin_path)?>/common/update/<?php echo $action;?>">
                        <input type="hidden" name="id" value="<?php echo $data->id;?>">
                        <input type="hidden" id="status" name="status" value="0">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Invoice To</label>
                                <input type="text" name="payment_to" placeholder="Enter invoice from name" class="form-control" value="<?php echo $data->payment_to;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Expense Type</label>
                                <select type="text" name="extype_id" class="form-control" required>
                                    <?php $pages = $this->master->get_all($this->master->expense_type_table, array('output'=>'result_array'));
                                    $pages = $this->master->buildTree($pages, 'parent_id', 'id');
                                    treeOption($pages, $data->extype_id);
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
                                <select type="text" name="payment_method" class="form-control">
                                    <option <?php echo $data->payment_method=='cash'?'selected':'';?> value="cash">Cash</option>
                                    <option <?php echo $data->payment_method=='cheque'?'selected':'';?> value="cheque">Cheque</option>
                                    <option <?php echo $data->payment_method=='bkash'?'selected':'';?> value="bkash">bKash</option>
                                    <option <?php echo $data->payment_method=='online'?'selected':'';?> value="online">Online</option>
                                    <option <?php echo $data->payment_method=='other'?'selected':'';?> value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Invoice Date</label>
                                <input type="text" name="expense_date" id="expense_date" placeholder="Enter expense date" class="form-control" value="<?php echo $data->expense_date;?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Remark</label>
                            <textarea class="form-control" name="remark" required><?php echo $data->remark;?></textarea>
                        </div>


                        <div class="form-group">
                            <a href="<?php echo base_url($admin_path);?>/common/get_all/<?php echo $action;?>"><input type="button" class="btn btn-danger" value="Cancel"></a>

                            <?php if( $this->master->isPermission('save_expense') ){ ?>
                            <input type="button" onclick="submitForm(0)" class="btn btn-info" value="Update as Save">
                            <?php } ?>

                            <?php if( $this->master->isPermission('add_expense') ){ ?>
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
        $('#expense_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>