<?php if($this->master->isPermission('dashboard_info')){ ?>
<style type="text/css">
.card { padding: 10px; }
</style>
<div class="row">
  <?php if($this->session->userdata("user_role")== 5){ ?>
  <div class="col-xl-3 col-sm-3 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">Total Deposit
        <div class="card-body-icon">
         <i class="fa fa-fw fa-list"></i>
       </div>
       <div class="mr-5"><?php echo $this->payment_model->currencyFormat($deposit_by_member->total_amount)?></div>
     </div>
   </div>
 </div>
 <?php } else {?>
 <div class="col-xl-3 col-sm-3 mb-3">
  <div class="card text-white bg-primary o-hidden h-100">
    <div class="card-body">Cashbook Balance
      <div class="card-body-icon">
       <i class="fa fa-fw fa-list"></i>
     </div>
     <div class="mr-5"><?php echo $this->payment_model->currencyFormat($total_cashbook->cashbook_amount)?></div>
   </div>

 </div>
</div>
<div class="col-xl-3 col-sm-3 mb-3">
  <div class="card text-white bg-warning o-hidden h-100">
    <div class="card-body">Bank Account Balance
      <div class="card-body-icon">
        <i class="fa fa-fw fa-list"></i>
      </div>
      <div class="mr-5"><?php echo $this->payment_model->currencyFormat($total_bank_acc->balance)?></div>
    </div>

  </div>
</div>
<div class="col-xl-3 col-sm-3 mb-3">
  <div class="card text-white bg-danger o-hidden h-100">
    <div class="card-body">Total Expense
      <div class="card-body-icon">
        <i class="fa fa-fw fa-list"></i>
      </div>
      <div class="mr-5"><?php echo $this->payment_model->currencyFormat($total_expense->amount)?></div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-sm-3 mb-3">
  <div class="card text-white bg-success o-hidden h-100">
    <div class="card-body">Total Balance
      <div class="card-body-icon">
       <i class="fa fa-fw fa-list"></i>
     </div>
     <div class="mr-5"><?php echo $this->payment_model->currencyFormat($total_cashbook->cashbook_amount+ $total_bank_acc->balance)  ?></div>
   </div>

 </div>
</div>
<?php }?>
</div>


<div class="quick_report" style="margin-top: 40px;">
  <div class="panel panel-ingo">
    <div class="panel-heading">
      <span style="font-size: 20px">Quick Report</span>
    </div>
    <div class="panel-body">
      <form name="" action="" method="get" style="margin-bottom: 10px;">
        <div class="col-sm-2 col-md-1">
          <label>Year: </label>
          <select class="form-control" name="year" id="year">
            <!-- <option>2017</option> -->
            <option>2018</option>
            <option>2019</option>
            <option>2020</option>
          </select>
        </div>
        <div class="col-sm-2 col-md-2">
          <label>Member: </label>
          <?php if($this->session->userdata("user_role")== 5){ ?>
          <input type="text" autocomplete="off" name="member_name" value="<?php echo $this->session->userdata("user_full_name") ?>" disabled placeholder="All" id="member_select" class="form-control" required>
          <span class="help-block" id="member_help_block" ></span>
          <input type="hidden" autocomplete="off" name="client_id" value="<?php echo $this->session->userdata("member_id")?>" class="form-control">
          <table class="table table-condensed table-hover table-bordered clickable" id="member_select_result" style="position: absolute;z-index: 10;background-color: #fff;width: 92%">
          </table>
          <?php } else { ?>
          <input type="text" autocomplete="off" name="member_name" placeholder="All" id="member_select" class="form-control" required>
          <span class="help-block" id="member_help_block" ></span>
          <input type="hidden" autocomplete="off" name="client_id"  class="form-control">
          <table class="table table-condensed table-hover table-bordered clickable" id="member_select_result" style="position: absolute;z-index: 10;background-color: #fff;width: 92%">
          </table>
          <?php }?>
        </div>
        <div class="col-sm-2 col-md-1">
          <label style="width: 100%;">&nbsp;</label>
          <button class="btn btn-primary" id="get_calender_report" type="button">Go</button>
        </div>
      </form>

      <div id="calander_report"></div>
      
    </div>
  </div>
</div>

<script type="text/javascript">
  var timer;
  $("#member_select").keyup(function(event) 
  {
    $("#member_select_result").show();
    $("#member_select_result").html('');
    clearTimeout(timer);
    timer = setTimeout(function() 
    {
      var search_member = $("#member_select").val();
      var html = '';
      if(search_member!='')
      {
        $.post('<?php echo site_url(); ?>admin/Payment/search_member_by_name',{q: search_member}, function(data, textStatus, xhr) {
          data = JSON.parse(data);
          $.each(data, function(index, val) {
            html+= '<tr><td data="'+val.id+'">'+val.client_id+'</td></tr>';
          });
          $("#member_select_result").html(html);
        });
      }else{
        $('input[name="client_id"]').val('');
      }
    }, 200);
  });    
  $("#member_select_result").on('click', 'td', function(event) {
    $('input[name="member_name"]').val($(this).text());
    $('input[name="client_id"]').val($(this).attr('data'));
    $("#member_select_result").hide();
  });

  $("#get_calender_report").on('click', function(){
    var client_id = $('input[name="client_id"]').val();
    var year = $('#year').val();
    callHttp('dashboard/dashboard_calander', {client_id: client_id, year:year}, function(html){
      $('#calander_report').html(html);
    },'html');
  });

</script>
<?php } ?>