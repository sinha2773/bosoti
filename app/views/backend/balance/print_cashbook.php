<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<style type="text/css">
    .inner_table { width: 100%; border: none; }
    .inner_table tr td { border: none; }
    .inner_table tr td { padding-top: 2px; padding-bottom: 2px; border-bottom: 1px solid #ddd!important; }
    .inner_table tr td:first-child { width: 70%; }
    .inner_table tr:last-child td { border-bottom: none!important; }
</style>

<div class="client_statement">

    <?php if( !empty($cashbook) ){ ?>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="text-center">
                        <h4>Cash Book: <?php echo $app_title;?></h4>
                        <?php if(isset($_REQUEST['from_date']) && !empty($_REQUEST['from_date']) && isset($_REQUEST['to_date']) && !empty($_REQUEST['to_date']) ){ ?>
                        <p><?php echo date('d-m-Y', strtotime($_REQUEST['from_date'])).' to '. date('d-m-Y', strtotime($_REQUEST['to_date']));?></p>
                        <?php } ?>
                    </div>
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