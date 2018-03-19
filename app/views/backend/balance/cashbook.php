<style type="text/css">
    .inner_table { width: 100%; }
    .inner_table tr td { padding-top: 2px; padding-bottom: 2px; border-bottom: 1px solid #ddd!important; }
    .inner_table tr td:first-child { width: 70%; }
    .inner_table tr:last-child td { border-bottom: none!important; }
</style>
<form name="form" method="get" action="" enctype="multipart/form-data">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>From Date</label>
                    <input type="text" name="from_date" id="from_date" value="<?php echo $data['from_date'];?>" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>To Date</label>
                    <input type="text" name="to_date" id="to_date" value="<?php echo $data['to_date'];?>" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-eye" aria-hidden="true"></i> Show</button>
                </div>
            </div>  
            <div class="col-sm-3">
                <div class="form-group text-right">
                    <label style="width: 100%;">&nbsp;</label>
                    <a target="_blank" href="<?php echo current_url();?>?from_date=<?php echo isset($_GET['from_date'])?$_GET['from_date']:'';?>&to_date=<?php echo isset($_GET['from_date'])?$_GET['to_date']:'';?>&print=true" class="btn btn-warning"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                </div>
            </div>   
        </div>        
    </div>   
</form>




<div class="client_statement">

    <?php if( !empty($cashbook) ){ ?>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    
                    <table id="listTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="120">#Date</th>
                                <th>Description</th>
                                <th>Credit</th>
                                <th width="10">&nbsp;</th>
                                <th>Description</th>
                                <th>Debit</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php 
                            $total_debit = 0;
                            $total_credit = 0;
                            foreach ($cashbook as $date => $data) { ?>
                            <tr class="">
                                <td><?php echo $date;?></td>
                                <td colspan="2">
                                    <table class="inner_table">
                                    <?php 
                                        if( isset($data['monthly_income']) ){
                                            foreach($data['monthly_income'] as $obj){
                                                $total_credit += $obj->total_amount;
                                                echo '<tr>';
                                                echo '<td>';
                                                echo 'Collection: ';
                                                echo $obj->collector==''?'Unknown':$obj->collector;
                                                echo '</td>';
                                                echo '<td>';
                                                echo ' '.$obj->total_amount;
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                    <?php 
                                        if( isset($data['other_income']) ){
                                            foreach($data['other_income'] as $obj){
                                                $total_credit += $obj->total_amount;
                                                echo '<tr>';
                                                echo '<td>';
                                                echo 'Inv: '.$obj->invoice;
                                                echo $obj->payment_from!=''?'<br>From: '.$obj->payment_from."({$obj->payment_method})":'';
                                                echo $obj->remark==''?'':'<br>'.$obj->remark;
                                                echo '</td>';
                                                echo '<td>';
                                                echo ' '.$obj->total_amount;
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                    </table>                                  
                                </td>
                                <td>&nbsp;</td>
                                <td colspan="2">
                                    <table class="inner_table">
                                    <?php 
                                        if( isset($data['expense_salary']) ){
                                            foreach($data['expense_salary'] as $obj){
                                                $total_debit += $obj->total_amount;
                                                echo '<tr>';
                                                echo '<td>';
                                                echo 'Salary: ';
                                                echo $obj->employee==''?'Unknown':$obj->employee;
                                                echo '</td>';
                                                echo '<td>';
                                                echo ' '.$obj->total_amount;
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?> 
                                    <?php 
                                        if( isset($data['expense_other']) ){
                                            foreach($data['expense_other'] as $obj){
                                                $total_debit += $obj->total_amount;
                                                echo '<tr>';
                                                echo '<td>';
                                                echo 'Inv: '.$obj->invoice;
                                                echo $obj->payment_to!=''?'<br>To: '.$obj->payment_to."({$obj->payment_method})":'';
                                                echo $obj->remark==''?'':'<br>'.$obj->remark;
                                                echo '</td>';
                                                echo '<td>';
                                                echo ' '.$obj->total_amount;
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>   
                                    </table>                                  
                                </td>
                                
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th colspan="2">
                                    <table class="inner_table">
                                    <tr>
                                        <td class="text-right">Total:&nbsp;</td>
                                        <td>
                                        <?php echo $this->payment->currencyFormat($total_credit);?>
                                        </td>
                                    </tr>
                                    </table>
                                </th>
                                <th></th>
                                <th colspan="2">
                                    <table class="inner_table">
                                    <tr>
                                        <td class="text-right">Total:&nbsp;</td>
                                        <td>
                                        <?php echo $this->payment->currencyFormat($total_debit);?>
                                        </td>
                                    </tr>
                                    </table>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="6">Balance: <?php echo $this->payment->currencyFormat($total_credit - $total_debit);?> (Total Credit - Total Debit)</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </section>

    <?php }else{ echo '<h4 class="text-center">No Records</h4>';} ?>
</div>

<?php //setGrid(); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#from_date,#to_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>