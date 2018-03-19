<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/_back/css/print.css">
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>

<style type="text/css">
    .inner_table { width: 100%; border: none; }
    .inner_table tr td { border: none; }
    .inner_table tr td { padding-top: 2px; padding-bottom: 2px; border-bottom: 1px solid #ddd!important; }
    .inner_table tr td:first-child { width: 70%; }
    .inner_table tr:last-child td { border-bottom: none!important; }


    .balance_table{
        /*width:100%;*/
    }
    .balance_table tr{
        /*width:100%;*/
    }
    .balance_table th{
        color: #4C61A0;
        font-weight: bold;
        padding: 0 5px;
    }
    .balance_table td{
        border:1px solid #000;
        padding: 0 5px;                
    }


    .twel{
        background:#B8CCE4;
    }
    .left-side td:first-child{
        padding-left:10px;
    }
    .left-middle td:first-child{
        padding-left:25px;
    }

    .blue{
      background: #0000FF;
      color: #fff;
    } 
    .blueviolet{
      background:#b781ea;
      color: #fff;
    } 
    .brown{
      background:#c16c6c;
      color: #fff;
    }
    .burlywood{
      background:#DEB887;
      color: #fff;
    }
    .chartreuse{
      background:#7FFF00;
      color: #fff;

    }
    .cadetblue{
      background:#5F9EA0;
      color: #fff;
    }
    .cornflowerBlue{
      background:#6495ED;
      color: #fff;
    }
    .chocolate{
      background:#D2691E;
      color: #fff;
    }
    .crimson{
      background:#DC143C;
      color: #fff;
    }
    .darkmagenta{
      background:#8B008B;
      color: #fff;
    }
    .darkorchid{
      background:#9932CC;
      color: #fff;
    }
    .forestgreen{
      background:#228B22;
      color: #fff;
    }
    .fuchsia{
      background:#FF00FF;
      color: #fff;
    }
</style>

<?php
$year = $data['year'];
$months = $data['months'];
$calculateCellVal = function($key, $options=array()) use ($balancesheet, $year, $months)
{
    $output = '';
    foreach($months as $month){
        if ( empty($balancesheet['billing'][$year.$month]) ){
            if ( !empty($options) && isset($options['bold']) )
                $output .= "<td><strong>0</strong></td>";
            else
                $output .= "<td>0</td>";
        }
        else{

            $copy_array = $balancesheet['billing'][$year.$month];
            end($copy_array);// move the internal pointer to the end of the array
            $last_key = key($copy_array);

            // echo count($balancesheet['billing'][$year.$month]);exit;
            if ( !empty($options) && isset($options['bold']) )
                $output .= "<td><strong>{$balancesheet['billing'][$year.$month][$last_key]->$key}</strong></td>";
            else
                $output .= "<td>{$balancesheet['billing'][$year.$month][$last_key]->$key}</td>";
        }
    }
    return $output;
};

$voucherCalculation = function($key, $vouther_type='receiv_billing', $options=array()) use ($balancesheet, $year, $months){
    $output = '';
    foreach($months as $month){
        if ( empty($balancesheet['voucher'][$vouther_type][$year.$month]) ){
            if ( !empty($options) && isset($options['bold']) )
                $output .= "<td><strong>0</strong></td>";
            else
                $output .= "<td>0</td>";
        }
        else{
            if ( !empty($options) && isset($options['bold']) )
                $output .= "<td><strong>{$balancesheet['voucher'][$vouther_type][$year.$month][0]->$key}</strong></td>";
            else
                $output .= "<td>{$balancesheet['voucher'][$vouther_type][$year.$month][0]->$key}</td>";
        }
    }
    return $output;
};
?>

<div class="client_statement">

    <table class="balance_table">
        <thead>
            <tr>
                <th>Balance Sheet</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td class="twel"><?php echo $data['year'];?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="color:#8092C6; font-weight:bold;"></td>
            </tr>
            <tr class="left-side">
                <td style=" color:red;">&nbsp;</td>
                <td class="twel">January</td>
                <td class="twel">February</td>
                <td class="twel">March</td>
                <td class="twel">April</td>
                <td class="twel">May</td>
                <td class="twel">June</td>
                <td class="twel">July</td>
                <td class="twel">August</td>
                <td class="twel">September</td>
                <td class="twel">October</td>
                <td class="twel">November</td>
                <td class="twel">December</td>
            </tr>
            <tr class="left-side">
                <td class="blueviolet">Billing Details</td> 
                <td colspan="12"></td>               
            </tr>
            <tr class="left-middle blueviolet">
                <td>Monthly Billed</td>
                <?php echo $calculateCellVal('total_monthly_billed'); ?>                
            </tr>
            <tr class="left-middle blueviolet">
                <td>Con/Re-con/Adj Billed</td>
                <?php echo $calculateCellVal('total_monthly_other_billed'); ?>
            </tr>
            <tr class="left-middle blueviolet crimson">
                <td>Previous Due</td>
                <?php echo $calculateCellVal('total_previous_due'); ?>
            </tr>
            <!-- <tr class="left-middle blueviolet">
                <td>Monthly Discount</td>
                <?php //echo $calculateCellVal('total_monthly_discount'); ?>
            </tr> -->
            <tr class="left-side blueviolet">
                <td><strong>Total Billed</strong></td>
                <?php echo $calculateCellVal('total_all_monthly_billed',array('bold'=>true)); ?>             
            </tr>
            <tr>
            
            </tr>
            <tr class="left-side ">
                <td class="brown">Paid Details</td> 
                <td colspan="12"></td>               
            </tr>
            <tr class="left-middle brown fuchsia">
                <td>Total Previous Adv</td>
                <?php echo $calculateCellVal('total_previous_advance'); ?>
            </tr>
            <tr class="left-middle brown">
                <td>Cutted Previous Adv</td>
                <?php echo $calculateCellVal('total_cuted_previous_advance'); ?>             
            </tr>
            <tr class="left-middle brown">
                <td>Present Adv from Previous Adv</td>
                <?php echo $calculateCellVal('total_previous_advance_after_cuted'); ?>               
            </tr>
            <tr class="left-middle brown">
                <td>Discount</td>
                <?php echo $calculateCellVal('total_monthly_discount'); ?>             
            </tr>
            <tr class="left-middle brown">
                <td>Monthly Paid</td>
                <?php echo $calculateCellVal('total_monthly_paid'); ?>             
            </tr>
            <tr class="left-middle brown">
                <td>Adj/Adv Paid</td>
                <?php echo $calculateCellVal('total_adj_paid'); ?>             
            </tr>
            <tr class="left-side brown">
                <td><strong>Total Paid</strong></td>
                <?php echo $calculateCellVal('total_all_paid',array('bold'=>true)); ?>                
            </tr>
            <tr class="left-side crimson">
                <td><strong>Present Due</strong></td>
                <?php echo $calculateCellVal('total_present_due',array('bold'=>true)); ?>                
            </tr>
            <!-- <tr class="left-side darkorchid">
                <td><strong>Present Month Advance</strong></td>                
                <?php //echo $calculateCellVal('total_present_advance',array('bold'=>true)); ?>                  
            </tr> -->
            <tr class="left-side fuchsia">
                <td><strong>Total Present Advance</strong></td>                
                <?php echo $calculateCellVal('total_present_advance',array('bold'=>true)); ?>                  
            </tr>
            <tr class="left-side burlywood">
                <td><strong>Due/Adv of Hold/Inac/Deactive Clients</strong></td>                
                <?php //echo $calculateCellVal('due_adv_none_active_user_till_todate',array('bold'=>true)); ?>
                <?php 
                foreach($months as $month){
                    $datearr = $this->master->rangeMonth($year.'-'.$month.'-01');
                    // dd($datearr);
                    $filter_data = [
                        'to_date'=> $datearr['end']
                    ];
                    $objData = $this->payment->getHoldAmount($filter_data);
                    // dd($objData, false);
                    $d_a_amount = $objData->billed_none_active_user_till_todate - $objData->paid_none_active_user_till_todate;
                    echo "<td>".$d_a_amount."</td>";
                }
                ?>                   
            </tr>
            <!-- <tr class="left-side burlywood">
                <td><strong>Total (H/A/I) till To-Date</strong></td>                
                <?php //echo $calculateCellVal('total_due_adv_none_active_user',array('bold'=>true)); ?>                 
            </tr> -->
            <tr class="left-side">
                <td class="cadetblue">Voucher</td>
                <td colspan="12"></td>                
            </tr>
            <tr class="left-middle cadetblue">
                <td>Received from collection</td>
                <?php echo $voucherCalculation('total_amount', 'receive_billing'); ?>
            </tr>
            <tr class="left-middle cadetblue">
                <td>Received from voucher</td>
                <?php echo $voucherCalculation('total_amount', 'receive_other'); ?>
            </tr>
            <tr class="left-middle cadetblue">
                <td>Total Received Amount</td>
                <?php
                    $voucher = array('received'=>[], 'payment'=>[]);
                    foreach($months as $month){
                        $total = 0;
                        if ( !empty($balancesheet['voucher']['receive_billing'][$year.$month]) ){
                            $total += $balancesheet['voucher']['receive_billing'][$year.$month][0]->total_amount;
                        }
                        if ( !empty($balancesheet['voucher']['receive_other'][$year.$month]) ){
                            $total += $balancesheet['voucher']['receive_other'][$year.$month][0]->total_amount;
                        }
                        $voucher['received'][$month] = $total;
                        echo "<td><strong>{$total}</strong></td>";
                    }
                ?>
            </tr>
            <tr class="left-middle cornflowerBlue ">
                <td>Payment from Salary</td>
                <?php echo $voucherCalculation('total_amount', 'payment_salary'); ?>
            </tr>
            <tr class="left-middle cornflowerBlue ">
                <td>Payment from Voucher</td>
                <?php echo $voucherCalculation('total_amount', 'payment_other'); ?>
            </tr>
            <tr class="left-middle cornflowerBlue ">
                <td>Total Payment Amount</td>
                <?php
                    foreach($months as $month){
                        $total = 0;
                        if ( !empty($balancesheet['voucher']['payment_salary'][$year.$month]) ){
                            $total += $balancesheet['voucher']['payment_salary'][$year.$month][0]->total_amount;
                        }
                        if ( !empty($balancesheet['voucher']['payment_other'][$year.$month]) ){
                            $total += $balancesheet['voucher']['payment_other'][$year.$month][0]->total_amount;
                        }
                        $voucher['payment'][$month] = $total;
                        echo "<td><strong>{$total}</strong></td>";
                    }
                ?>
            </tr>
            
            <tr>
            
            </tr>
            <tr class="left-side forestgreen">
                <td><strong>Voucher Balance</strong></td>
                <?php
                    foreach($months as $month){
                        $total = $voucher['received'][$month] - $voucher['payment'][$month];
                        echo "<td><strong>{$total}</strong></td>";
                    }
                ?>                
            </tr>
        </tbody>
    </table>

</div>