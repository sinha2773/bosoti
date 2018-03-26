      <div class="row">
        <div class="col-xl-3 col-sm-3 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">Cashbook Balance
              <div class="card-body-icon">
               <i class="fa fa-fw fa-list"></i>
             </div>
             <div class="mr-5"><?php echo number_format($total_cashbook->cashbook_amount)?></div>
           </div>

         </div>
       </div>
       <div class="col-xl-3 col-sm-3 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
          <div class="card-body">Bank Account Balance
            <div class="card-body-icon">
              <i class="fa fa-fw fa-list"></i>
            </div>
            <div class="mr-5"><?php echo number_format($total_bank_acc->balance)?></div>
          </div>

        </div>
      </div>
      <div class="col-xl-3 col-sm-3 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
          <div class="card-body">Total Expense
            <div class="card-body-icon">
              <i class="fa fa-fw fa-list"></i>
            </div>
            <div class="mr-5"><?php echo number_format($total_expense->amount)?></div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-3 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">Total Balance
            <div class="card-body-icon">
             <i class="fa fa-fw fa-list"></i>
           </div>
           <div class="mr-5"><?php echo number_format($total_cashbook->cashbook_amount+ $total_bank_acc->balance - $total_expense->amount)  ?></div>
         </div>

       </div>
     </div>
   </div>