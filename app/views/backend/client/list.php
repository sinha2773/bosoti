<div id="widget-grid" class="col-sm-12">       
    <div class="section">
        <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
            <header>
                <h2>Advance Filter</h2>
            </header>
            <div class="widget-body section_content">
                <form method="get" action="<?php echo base_url($admin_path);?>/client">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Client Type</label>
                                <select name="client_type" class="form-control">
                                <option value="">All</option>
                                <?php foreach($client_types as $arr){?>
                                <option <?php echo isset($data['client_type'])?$data['client_type']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Payment Type</label>
                                <select name="payment_type" class="form-control">
                                <option value="">All</option>
                                <?php foreach($payment_types as $arr){?>
                                <option <?php echo isset($data['payment_type'])?$data['payment_type']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Package (monthly bill)</label>
                                <select name="package_id" class="form-control" >
                                <option value="">All</option>
                                <?php foreach($packages as $obj){?>
                                <option <?php echo isset($data['package_id'])?$data['package_id']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?> (Monthly Bill: <?php echo $obj->price;?>) (VAT: <?php echo $obj->vat;?>%) (Total: <?php echo $obj->total;?>)</option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All</option>
                                <?php foreach($statuses as $arr){?>
                                    <option <?php echo isset($data['status'])?$data['status']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Address</label>
                                <select name="address" class="form-control" >
                                <option value="">All</option>
                                <?php foreach($address as $obj){?>
                                <option <?php echo isset($data['address'])?$data['address']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Zone</label>
                                <select name="zone" class="form-control" >
                                <option value="">All</option>
                                <?php foreach($zones as $obj){?>
                                <option <?php echo isset($data['zone'])?$data['zone']==$obj->id?'selected':'':'';?> value="<?php echo $obj->id;?>"><?php echo $obj->title;?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">                   
                            <div class="form-group">
                                <label>House No</label>
                                <input type="text" name="house_no" class="form-control" value="<?php echo isset($data['house_no'])?$data['house_no']:'';?>" placeholder="Enter house no">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Text(name,mobile,summary)</label>
                            <input type="text" name="txtInput" value="<?php echo isset($data['txtInput'])?$data['txtInput']:'';?>" class="form-control" placeholder="Enter name,mobile,summary">
                        </div>
                    </div>

                    <div class="row">
                        <div id="dueTypeContainer" class="col-sm-3">
                            <label>Due Type</label>
                            <span class="option_checkbox">
                            <input <?php echo isset($_GET['dueAbove']) && $_GET['dueAbove']==1?'checked':'';?> type="checkbox" id="dueAbove" onclick="$('#dueBelow').prop('checked', false)" name="dueAbove" value="1"> Above
                            <input <?php echo isset($_GET['dueBelow']) && $_GET['dueBelow']==1?'checked':'';?> type="checkbox" id="dueBelow" onclick="$('#dueAbove').prop('checked', false)" name="dueBelow" value="1"> Below
                            </span>
                            <select class="form-control" id="dueType" name="dueType">
                                <option value="">Select Due Type</option>
                                <?php foreach($dueTypes as $arr){?>
                                <option <?php echo isset($data['dueType'])?$data['dueType']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="advTypeContainer" class="col-sm-3">
                            <label>Advance</label>
                            <span class="option_checkbox">
                            <input <?php echo isset($_GET['advAbove']) && $_GET['advAbove']==1?'checked':'';?> type="checkbox" id="advAbove" onclick="$('#advBelow').prop('checked', false)" name="advAbove" value="1"> Above
                            <input <?php echo isset($_GET['advBelow']) && $_GET['advBelow']==1?'checked':'';?> type="checkbox" id="advBelow" onclick="$('#advAbove').prop('checked', false)" name="advBelow" value="1"> Below
                            </span>
                            <select class="form-control" id="advType" name="advType">
                                <option value="">Select Advance Type</option>
                                <?php foreach($advanceTypes as $arr){?>
                                <option <?php echo isset($data['advType'])?$data['advType']==$arr['value']?'selected':'':'';?> value="<?php echo $arr['value'];?>"><?php echo $arr['text'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="FromDate">From Date: </label>
                                <input type="text" class="form-control" id="FromDate" name="from_date" placeholder="From Date" value="<?php echo isset($data['from_date'])?$data['from_date'] : $settings['default_date'];?>">
                            </div>                            
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="ToDate">To Date: </label>
                                <input type="text" class="form-control" id="ToDate" name="to_date" placeholder="To Date" value="<?php echo isset($data['to_date'])?$data['to_date'] : date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Search</button>
                </form>                
            </div>
        </div>    
    </div>
</div>

<?php //include(dirname(__dir__).'/common/page_part/all_status_title.php');?>

<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="listTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Zone</th>
                        <th>Floor</th>
                        <th>House No</th>
                        <th>Package</th>
                        <th>Status</th>
                        <?php if( $this->master->isPermission('client_history') || $this->master->isPermission('update_client') ){?>
                        <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
               
                    <tbody>
                         <?php foreach ($lists as $keay => $values) { ?>
                        <tr class="<?php echo $this->client->get_status($values->status)['text']; ?>">
                            <td><?php echo $values->client_id ?></td>
                            <td><?php echo $values->full_name; ?></td>
                            <td><?php echo $values->mobile; ?></td>
                            <td><?php echo $values->address; ?></td>
                            <td><?php echo $values->zone; ?></td>
                            <td><?php echo $values->floor; ?></td>
                            <td><?php echo $values->house_no; ?></td>
                            <td><?php echo implode(',',$values->packages),'(',$values->total,')'; ?></td>
                            <td><?php echo $this->client->get_status($values->status)['text']; ?></td>
                            <?php if( $this->master->isPermission('client_history') || $this->master->isPermission('update_client') ){?>
                            <td style="text-align: center">
                                
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i>
                                    <span class="caret"></span></button>
                                  <ul class="dropdown-menu pull-right" style="min-width: auto;">
                                    <?php if( $this->master->isPermission('client_history') ){ ?>
                                    <li><a class="" href="<?php echo base_url($admin_path) ?>/client/history/<?php echo $values->id ?>">History</a></li>
                                    <?php } ?>
                                    <?php if( $this->master->isPermission('update_client') ){ ?>
                                    <li><a class="" href="<?php echo base_url($admin_path) ?>/client/editClient/<?php echo $values->id ?>">Edit</a></li>
                                    <li><a class="" onclick="return confirm('Are you sure to Disconnect?')" href="<?php echo base_url($admin_path) ?>/client/deleteClient/<?php echo $values->id ?>">Disconnect</a></li>
                                    <?php } ?>
                                  </ul>
                                </div>

                                
                            </td>
                            <?php } ?>
                        </tr>
                         <?php } ?>
                    </tbody>
               

            </table>
        </div>
    </div>
</section>

<?php setGrid(); ?>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#FromDate, #ToDate').datepicker({dateFormat: 'yy-mm-dd'});

        $("#dueType").on('change', function(){
            if ( $(this).val()!="" ){
                $("#advType").val('');
                $("#advTypeContainer").hide();
            }else{
                $("#advType").val('');
                $("#advTypeContainer").show(); 
            }
        });
        $("#advType").on('change', function(){
            if ( $(this).val()!="" ){
                $("#dueType").val('');
                $("#dueTypeContainer").hide();
            }else{
                $("#dueType").val('');
                $("#dueTypeContainer").show();
            }
        })

    });
</script>
<style type="text/css">
    .Disconnect td { background-color: #ce9696!important; }
    .Hold td { background-color: #f7ed94!important; }
    .Inactive td { background-color: #f2922b!important; }
	.Free td { background-color: #ede1e1!important; }
    .option_checkbox { float: right; }
</style>