<script type="text/javascript" src="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_back/js/plugin/select2');?>/select2.min.css">

<form name="form" method="get" action="" enctype="multipart/form-data">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Member ID</label>
                    <select name="client_id" id="client_id" class="" onchange="clientDetails(this.value)" style="width: 100%;" required>
                    <option value="">Select Member</option>
                    <?php foreach($clients as $client){?>
                    <option <?php echo $client_id==$client->id?'selected':'';?> value="<?php echo $client->id;?>"><?php echo $client->client_id;?></option>
                    <?php } ?>
                    </select>
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
                                <th>Amount</th>
                                <th width="160">Entry Time</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php 
                            $total_balance = 0;
                            foreach ($payment_info as $key => $value) { ?>
                            <?php 
                                $total_balance = $total_balance + $value->amount;
                            ?>
                            
                            <tr class="">
                                <td><?php echo date('d-m-Y', strtotime($value->payment_date)); ?></td>
                                <td><?php echo $value->added_user; ?></td>
                                <td><?php echo $value->amount; ?></td> 
                                <td><?php echo date('Y-m-d h:s A', strtotime($value->created));?></td>                             
                            </tr>
                            <?php } ?>  
                        </tbody>
                        <tfoot>
                            <tr>                                
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
</script>