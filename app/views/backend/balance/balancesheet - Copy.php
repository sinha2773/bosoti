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
                    <input type="text" name="from_date" id="from_date" value="<?php echo $settings['default_date'];?>" class="form-control" required>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
                    <label>To Date</label>
                    <input type="text" name="to_date" id="to_date" value="<?php echo date('Y-m-d');?>" class="form-control" required>
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

        <section class="content">
            <div class="box">
                <div class="box-body">
                    
<div class="balance-sheet-information">
    <style type="text/css">
            
            .balance_table{
                width:100%;
            }
            .balance_table tr{
                width:100%;
            }
            .balance_table th{
                color: #4C61A0;
                font-weight: bold;
            }
            .balance_table td{
                border:1px solid #000;
                
            }


            .twel{
                background:#B8CCE4;
            }
            .left-side td{
                padding-left:10px;
            }
            .left-middle td{
                padding-left:25px;
            }

        
        
        </style>
    <table class="balance_table">
        <thead>
            <tr>
                <th>Balance Sheet</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td class="twel">2016</td>
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
                <td style=" color:red;">Item Names</td>
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
                <td>Current Assets</td>
                
            </tr>
            <tr class="left-middle">
                <td>Cash</td>
                <td>1500</td>
                <td>3000</td>
                <td>4500</td>
                <td>6000</td>
                <td>7500</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
                
            </tr>
            <tr class="left-middle">
                <td>Account receivable</td>
                <td>3000</td>
                <td>3000</td>
                <td>3000</td>
                <td>3000</td>
                <td>3000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="left-middle">
                <td>Inventory</td>
                <td>10000</td>
                <td>12000</td>
                <td>10000</td>
                <td>10000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="left-middle">
                <td>Prepaid expenses</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
            <tr class="left-middle">
                <td>Other</td>
                <td>2000</td>
                <td>4000</td>
                <td>6000</td>
                <td>8000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
            <tr class="left-side">
                <td><strong>Total Current Assets</strong></td>
                <td><strong>18000</strong></td>
                <td><strong>23500</strong></td>
                <td><strong>25000</strong></td>
                <td><strong>28500</strong></td>
                <td><strong>37000</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                
            </tr>
            <tr>
            
            </tr>
            <tr class="left-side">
                <td>Fixed Assets</td>
                
            </tr>
            <tr class="left-middle">
                <td>Property, plant & Equipment</td>
                <td>10000</td>
                <td>12000</td>
                <td>10000</td>
                <td>10000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="left-middle">
                <td>Furniture & Fixtures</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
            <tr class="left-middle">
                <td>Other</td>
                <td>2000</td>
                <td>4000</td>
                <td>6000</td>
                <td>8000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
            <tr class="left-side">
                <td><strong>Total Fixed Assets</strong></td>
                <td><strong>18000</strong></td>
                <td><strong>23500</strong></td>
                <td><strong>25000</strong></td>
                <td><strong>28500</strong></td>
                <td><strong>37000</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                
            </tr>
            <tr class="left-side">
                <td><strong>Total Assets</strong></td>
                <td><strong>41000</strong></td>
                <td><strong>56500</strong></td>
                <td><strong>85000</strong></td>
                <td><strong>78500</strong></td>
                <td><strong>96000</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                
            </tr>
            <tr class="left-side">
                <td>Current Liabilities</td>
                
            </tr>
            <tr class="left-middle">
                <td>Account payable</td>
                <td>10000</td>
                <td>12000</td>
                <td>10000</td>
                <td>10000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="left-middle">
                <td>Short-term loans</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
            <tr class="left-middle">
                <td>Credit Card</td>
                <td>2000</td>
                <td>4000</td>
                <td>6000</td>
                <td>8000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
        
            <tr class="left-middle">
                <td>Other</td>
                <td>2000</td>
                <td>4000</td>
                <td>6000</td>
                <td>8000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
            <tr class="left-side">
                <td><strong>Total Current Liabilities</strong></td>
                <td><strong>41000</strong></td>
                <td><strong>56500</strong></td>
                <td><strong>85000</strong></td>
                <td><strong>78500</strong></td>
                <td><strong>96000</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                
            </tr>
            <tr>
            
            </tr>
            <tr class="left-side">
                <td><strong>Long-Term Liabilities</strong></td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td>500</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
            <tr class="left-middle">
                <td>Bank Loans Payable</td>
                <td>2000</td>
                <td>4000</td>
                <td>6000</td>
                <td>8000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
        
            <tr class="left-middle">
                <td>Other</td>
                <td>2000</td>
                <td>4000</td>
                <td>6000</td>
                <td>8000</td>
                <td>10000</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
            <tr class="left-side">
                <td>Total long-term Liabilities</td>
                <td>41000</td>
                <td>56500</td>
                <td>85000</td>
                <td>78500</td>
                <td>96000</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                
            </tr>
            <tr class="left-side">
                <td><strong>Total Liabilities</strong></td>
                <td><strong>41000</strong></td>
                <td><strong>56500</strong></td>
                <td><strong>85000</strong></td>
                <td><strong>78500</strong></td>
                <td><strong>96000</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                
            </tr>
            <tr>
            
            </tr>
            <tr class="left-side">
                <td><strong>Owner's Equity (Net Worth)</strong></td>
                <td><strong>41000</strong></td>
                <td><strong>56500</strong></td>
                <td><strong>85000</strong></td>
                <td><strong>78500</strong></td>
                <td><strong>96000</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                <td><strong>0</strong></td>
                
            </tr>
        </tbody>
    </table>
</div>                    

                </div>
            </div>
        </section>

    
</div>

<?php //setGrid(); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#from_date,#to_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>