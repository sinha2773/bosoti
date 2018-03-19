
<button class="exit" onclick="window.close()">Exit</button>
<button class="print" onclick="window.print()">Print</button>
<style type="text/css">
    body { text-align: center; }
    .slip_item { margin-bottom: 40px; }
    button.exit, button.print {
        display: initial;
        margin-bottom: 10px;
    }
    @media print{
        button.exit { display: none; }
        button.print { display: none; }
        .print_hide { display: none; }
        a[href]:after {
            content: none !important;
        }
        table th, table td { font-size: 11px;}
        /*to hide url and date from header and footer*/
        @page { margin: 10px; }
        /*body { margin: 1cm .6cm; }*/

        h2 { 
            page-break-before: always;
        }
        h3, h4 {
            page-break-after: avoid;
        }
        pre, blockquote, div, td, th {
            page-break-inside: avoid;
        }
        .page_break {
            page-break-inside: avoid;
        }
        
    }
</style>
<style type="text/css">
        .slip_item_container { width: 800px; margin:0 auto; border: 1px solid #ccc; margin-bottom: 40px; }
        .table_slip { width: 100%; font-size: 11px;  }
        p { margin:0; }
        .table_slip td {
            padding: 0px 5px;
            font-family: arial;
        }
        .left_slide { padding-right: 10px; border-right: 1px solid #ddd; }
        .table_slip td tr td{
            overflow: hidden;
            max-width: 100%;
            line-height: 14px;
        }
        .vouger_div{}
        .vouger_div h3{
            margin-top: 0px;
            font-size: 16px;
            color: #292936;
            margin-bottom: 0px;
            font-weight: normal;
        }
        .vouger_div p{
            font-size: 12px;
            color: #000;
        }
        .table_slip_border td{
            border:1px solid #777;
        }
        .details_cell td {
            height: 80px;
            text-align: left;
            vertical-align: top;
        }
        .details_cell_bottom td{
            height: 30px;
            text-align: left;
            
        }
        .empty_doted {
            background: url(<?php echo base_url('assets/_back/img');?>/dot.png) repeat-x;
            background-position: 0 12px;
        }
        .empty_doted span {
            background-color: #fff;
            padding:0 6px 0 0;
            display: inline-block;
        }
        .money_receipt {
            border: 1px solid;
            text-align: center;
            padding: 6px 0px;
            border-radius: 20px;
        }
        .table_slip_border .details_cell .details_right{}
        .total_taka_table_slip{
            margin-top: -10px;
        }
        .total_taka{
            border:1px solid #777;
        }
        .underscore_class .underscore{
            white-space: nowrap;
        }
        .table_slip .no-padding { padding: 0; }
        .signation_table { margin-top: -15px; margin-bottom: 10px; }
    </style>

</head>
<body>

<div class="container">
    

    <div class="info print_hide">Payment Slip of <br><?php echo $due_month['alias'];?></div>


        <?php 
        $total_bill = 0;
        $total_paid = 0;
        $total_previous_advance = 0;
        $total_previous_due = 0;
        $total_present_due = 0;
        $receipt_no = $settings['payment_slip_no'];
        foreach ($lists as $key => $value) { ?>
        <?php
        $total_bill += $value->monthly_bill  + $value->adj_bill;
        $total_paid += $value->paid;
        $total_previous_advance += $value->previous_advance;
        $total_previous_due += $value->previous_due;
        $total_present_due += $value->present_due;
        $receipt_no++;
        ?>
        <div class="slip_item_container">
            <table>
                <tr>
                    <td class="left_slide" width="200">
                        <table class="table_slip">
                            <tr>
                                <td class="vouger_div">
                                    <h4><?php echo $settings['app_title'];?></h4>
                                    <p>Date: </p>
                                    <p>Receipt No: <?php echo $receipt_no;?></p>
                                    <p>Billing Month: <?php echo $due_month['alias'];?></p>
                                    <p>Total: <?php echo $value->present_due;?></p>
                                    <p>ClientID: <?php echo $value->client_id_alias;?></p>
                                    <p>Name: <?php echo $value->full_name;?></p>
                                    <p>Mobile: <?php echo $value->mobile;?></p>
                                    <p>Package: <?php echo implode(', ',$value->packages);?></p>
                                    <p>Zone: <?php echo $value->zone;?></p>
                                    <p>Address: <?php echo $value->address;?></p>
                                    <p>Floor: <?php echo $value->floor;?></p>
                                    <p>House No: <?php echo $value->house_no;?></p> 
                                    <br>                               
                                    <br>                               
                                    <br>                               
                                    <p style="text-align: right;">Signature</p>                                
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="600">
                       <table class="table_slip">
                            <tr>
                                <td class="vouger_div" align="center">
                                    <h3><?php echo $settings['app_title'];?></h3>
                                    <p><?php echo $settings['full_address'];?></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="no-padding">
                                    <table class="table_slip">
                                        <tr>
                                            <td class="no-padding" width="35%">&nbsp;</td>
                                            <td class="no-padding" align="center"><div class="money_receipt">Money Receipt</div></td>
                                            <td class="no-padding" width="35%">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table_slip">
                                        <tr>
                                            <td width="33%"><div class="empty_doted"><span>Receipt No:</span> <?php echo $receipt_no;?></div></td>
                                            <td><div class="empty_doted"><span>Billing Month:</span> <?php echo $due_month['alias'];?></div></td>
                                            <td width="33%"><div class="empty_doted"><span>Date:</span></div></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table_slip">
                                        <tr>
                                            <td colspan="2">
                                                <div class="empty_doted">
                                                    <span>ClientID:</span> <?php echo $value->client_id_alias;?>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <span>Name:</span> <?php echo $value->full_name;?>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <span>Mobile:</span> <?php echo $value->mobile;?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div class="empty_doted"><span>Zone:</span> <?php echo $value->zone;?></div></td>
                                            <td><div class="empty_doted"><span>Package:</span> <?php echo implode(', ',$value->packages);?></div></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><div class="empty_doted"><span>Address:</span> <?php echo $value->address;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Floor:</span> <?php echo $value->floor;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>House No:</span> <?php echo $value->house_no;?></div></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table_slip table_slip_border">
                                        <tr class="details_cell">
                                            <td width="80%">Details: <div style="text-align: right;">
                                            Billed<br>
                                            Previous Due<br>
                                            Previous Advance<br>
                                            Paid<br></div></td>
                                            <td class="details_right"><br>
                                            <?php echo $value->monthly_bill; echo $value->adj_bill>0?'('.$value->adj_bill.')':'';?><br>
                                            <?php echo $value->previous_due; ?><br>                                  
                                            <?php echo $value->previous_advance; ?><br>                                    
                                            <?php echo $value->paid; ?>                                    
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table_slip total_taka_table_slip">
                                        <tr class="details_cell_bottom">
                                            <td width="60%"></td>
                                            <td class="total_taka" width="20%">Total Taka =</td>
                                            <td  class="total_taka"><?php echo $value->present_due;?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table_slip">
                                        <tr>
                                            <td width="80%"><div class="empty_doted"><span>Taka in word:</span></div></td>
                                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table_slip">
                                        <tr class="underscore_class">
                                            <td width="75%" style="font-size:11px;"><b>NB:</b> <?php echo $settings['payment_slip_text'];?></td>
                                            <td class="underscore"><div class="empty_doted">&nbsp;</div></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="no-padding">
                                    <table class="table_slip signation_table">
                                        <tr class="">
                                            <td width="75%"></td>                            
                                            <td class="no-padding" align="center">Signature</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table> 
                    </td>
                </tr>
            </table>
            
        </div>
        <?php if ( ($key+1) % 3 == 0 ){
        echo '<div class="page_break"></div>';
        } ?>
        <?php } ?>
</div>
   
