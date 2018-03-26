<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
$class = $this->uri->segment(1);
$method = $this->uri->segment(2);
$param = $this->uri->segment(3);
$param2 = $this->uri->segment(4);

$fetch_method = $this->router->fetch_method();
$fetch_class = $this->router->fetch_class();
//echo $fetch_method, ' ', $fetch_class, ' ';
//echo $class, ' ', $method, ' ', $param;exit;
?>
<aside id="left-panel">

	<!-- User info -->
	<div class="login-info">
		<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
			
			<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
				<img src="<?php echo base_url();?>assets/img/avatar.png" alt="me" class="online" /> 
				<span>
					<?php echo $this->session->userdata("user_full_name");?>
				</span>
				<i class="fa fa-angle-down"></i>
			</a> 
			
		</span>
	</div>
	<!-- end user info -->

	<nav>
		<ul>

			<li class="<?php if($method == "dashboard") echo "active";?>">
				<a href="<?php echo base_url("admin/dashboard");?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
			</li>

			<?php 
			$payment_sub1 = '';
			$payment_sub2 = '';
			$payment_li   = '';
			if($fetch_class=='payment' || $param2=='payment'){
				$payment_sub1 = "style='display:block'";
				$payment_li = "active open";				
				$payment_sub2 = "style='display:block'";
			};
			?>

			<?php if( $this->master->isPermission('manage_payment') ){?>
			<li class="<?php echo $payment_li;?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Payment</span></a>
				<ul <?php echo $payment_sub1;?>>
					<li>
						<a href="<?php echo base_url("admin/payment/bill/add");?>">Pay Bill</a>
					</li>
					<li>
						<a href="<?php echo base_url("admin/payment/bill/list");?>">Payment Report</a>
					</li>
					<li>
						<a href="<?php echo base_url("admin/payment/statement");?>">Statement</a>
					</li>
					
				</ul>
			</li>
			<?php } ?>


			<?php 
			$payment_sub1 = '';
			$payment_sub2 = '';
			$payment_li   = '';
			if($fetch_class=='bank_acc_create' || $param2=='bank_acc_create'){
				$payment_sub1 = "style='display:block'";
				$payment_li = "active open";				
				$payment_sub2 = "style='display:block'";
			};
			if($fetch_class=='bank_transfer' || $param2=='bank_transfer'){
				$payment_sub1 = "style='display:block'";
				$payment_li = "active open";				
				$payment_sub2 = "style='display:block'";
			};
			?>

			<li class="<?php echo $payment_li;?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Bank Account</span></a>
				<ul <?php echo $payment_sub1;?>>
					<li>
						<a href="<?php echo base_url("admin/bank_acc_create");?>">Add Bank Account</a>
					</li>
					<li>
						<a href="<?php echo base_url("admin/bank_acc_create/bank_accc_list");?>">Bank Accounts List</a>
					</li>
					<li>
						<a href="<?php echo base_url("admin/bank_transfer");?>">Transfer To Bank</a>
					</li>
					
				</ul>
			</li>



			<?php 
			$employe_sub1 = '';
			$employe_sub2 = '';
			$employe_li   = '';
			if($fetch_class=='member' || $param2=='member'){
				$employe_sub1 = "style='display:block'";
				$employe_li = "active open";				
				$employe_sub2 = "style='display:block'";
			};
			?>

			<?php if( $this->master->isPermission('manage_member') ){?>
			<li class="<?php echo $employe_li;?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Members</span></a>
				<ul <?php echo $employe_sub1;?>>
					<li>
						<a href="<?php echo base_url("admin/common/add/member");?>">Add Member</a>
					</li>
					<li>
						<a href="<?php echo base_url("admin/common/get_all/member");?>">Member List</a>
					</li>
					
				</ul>
			</li>
			<?php } ?>


			<?php 
			$account_sub1 = '';
			$account_sub2 = '';
			$account_li   = '';
			if($fetch_class=='account' || $param2=='account'){
				$account_sub1 = "style='display:block'";
				$account_li = "active open";				
				$account_sub2 = "style='display:block'";
			};
			
			?>
			<?php if( $this->master->isPermission('account_access') ){?>
			<li class="<?php echo $account_li;?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-credit-card"></i> <span class="menu-item-parent">Account</span></a>
				<ul <?php echo $account_sub1;?>>

					<?php 
					$income_sub1 = '';
					$income_sub2 = '';
					$income_li   = '';
					if($fetch_class=='income' || $param2=='income' || $param2=='income_type'){
						$income_sub1 = "style='display:block'";
						$income_li = "active open";				
						$income_sub2 = "style='display:block'";
					};
					?>
					<?php if( $this->master->isPermission('save_income') || $this->master->isPermission('add_income') || $this->master->isPermission('add_income_type') || $this->master->isPermission('see_income_list') || $this->master->isPermission('see_income_report') ){?>
					<li class="<?php echo $income_li;?>">
						<a href="#" title="Creadit/Recepts Voucher">Recepts Voucher</a>
						<ul <?php echo $income_sub1;?>>
							<?php if( $this->master->isPermission('add_income') || $this->master->isPermission('save_income') ){?>
							<li>
								<a href="<?php echo base_url("admin/common/add/income");?>">Add/Post</a>
							</li>
							<?php } ?>
							<?php if( $this->master->isPermission('see_income_list') ){?>
							<li>
								<a href="<?php echo base_url("admin/common/get_all/income");?>">All Vouchers</a>
							</li>
							<?php } ?>
							<?php if( $this->master->isPermission('add_income_type') ){?>
							<li>
								<a href="<?php echo base_url("admin/common/get_all/income_type");?>">Voucher Types</a>
							</li>
							<?php } ?>

							<?php if( $this->master->isPermission('see_income_report') ){?>
							<li>
								<a href="<?php echo base_url("admin/income/incomeRepost");?>">Voucher Report</a>
							</li>
							<?php } ?>
						</ul>
					</li>
					<?php } ?>

					
					<?php 
					$expense_sub1 = '';
					$expense_sub2 = '';
					$expense_li   = '';
					if($fetch_class=='expense' || $param2=='expense' || $param2=='expense_type'){
						$expense_sub1 = "style='display:block'";
						$expense_li = "active open";				
						$expense_sub2 = "style='display:block'";
					};
					?>

					<?php if( $this->master->isPermission('save_expense') || $this->master->isPermission('add_expense') || $this->master->isPermission('add_expense_type') || $this->master->isPermission('see_expense_list') || $this->master->isPermission('see_expense_report') ){?>
					<li class="<?php echo $expense_li;?>">
						<a href="#" title="Debit/Payment Voucher">Payment Voucher</span></a>
						<ul <?php echo $expense_sub1;?>>
							<?php if( $this->master->isPermission('add_expense') || $this->master->isPermission('save_expense')){?>
							<li>
								<a href="<?php echo base_url("admin/common/add/expense");?>">Add/Post</a>
							</li>
							<?php } ?>
							<?php if( $this->master->isPermission('see_expense_list') ){?>
							<li>
								<a href="<?php echo base_url("admin/common/get_all/expense");?>">All Vouchers</a>
							</li>
							<?php } ?>
							<?php if( $this->master->isPermission('add_expense_type') ){?>
							<li>
								<a href="<?php echo base_url("admin/common/get_all/expense_type");?>">Voucher Types</a>
							</li>
							<?php } ?>
							<?php if( $this->master->isPermission('see_expense_report') ){?>
							<li>
								<a href="<?php echo base_url("admin/expense/expenseRepost");?>">Voucher Report</a>
							</li>
							<?php } ?>
						</ul>
					</li>	
					<?php } ?>
					
					<li><a href="<?php echo base_url("admin/balance/cashbook");?>">Cash Book</a></li> 
					<!-- <li><a href="<?php echo base_url("admin/balance/sheet");?>">Balance Sheet</a></li>  -->
				</ul>
			</li>
			<?php } ?>		


			<?php 
			$user_sub1 = '';
			$user_sub2 = '';
			$user_li   = '';
			if($fetch_class=='user' || $param2=='user'){
				$user_sub1 = "style='display:block'";
				$user_li = "active open";				
				$user_sub2 = "style='display:block'";
			};
			
			?>
			<?php if( $this->master->isPermission('add_user') || $this->master->isPermission('see_user_list') || $this->master->isPermission('access_user_role') ){?>
			<li class="<?php echo $user_li;?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Users</span></a>
				<ul <?php echo $user_sub1;?>>
					<?php if( $this->master->isPermission('add_user') ){?>
					<li>
						<a href="<?php echo base_url("admin/user/add_user");?>">Add New</a>
					</li>
					<?php } ?>
					<?php if( $this->master->isPermission('see_user_list') ){?>
					<li>
						<a href="<?php echo base_url("admin/user/users");?>">All Users</a>
					</li>
					<?php } ?>
					<?php if( $this->master->isPermission('access_user_role') ){?>
					<li>
						<a href="<?php echo base_url("admin/user/user_roles");?>">User Roles</a>
					</li>
					<?php } ?>
				</ul>
			</li>
			<?php } ?>

			<?php /*
			$note_sub1 = '';
			$note_sub2 = '';
			$note_li   = '';
			if($fetch_class=='note' || $param2=='note'){
				$note_sub1 = "style='display:block'";
				$note_li = "active open";				
				$note_sub2 = "style='display:block'";
			};
			?>

			<?php if( $this->master->isPermission('note_menu') ){?>
			<li class="<?php echo $note_li;?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent">Notes</span></a>
				<ul <?php echo $note_sub1;?>>
					<li>
						<a href="<?php echo base_url("admin/common/add/note");?>">Add Note</a>
					</li>
					<li>
						<a href="<?php echo base_url("admin/common/get_all/note");?>">All Notes</a>
					</li>
					
				</ul>
			</li>
			<?php } */?>

			<?php 
			$message_sub1 = '';
			$message_sub2 = '';
			$message_li   = '';
			if($fetch_class=='message' || $param2=='message'){
				$message_sub1 = "style='display:block'";
				$message_li = "active open";				
				$message_sub2 = "style='display:block'";
			};
			?>

			<?php if( $this->master->isPermission('send_message') || $this->master->isPermission('message_history') ){?>
			<li class="<?php echo $message_li;?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-envelope"></i> <span class="menu-item-parent">Messages</span></a>
				<ul <?php echo $message_sub1;?>>
					<?php if( $this->master->isPermission('send_message') ){?>
					<li>
						<a href="<?php echo base_url("admin/message");?>">Send Message</a>
					</li>
					<?php } ?>
					<?php if( $this->master->isPermission('message_history') ){?>
					<li>
						<a href="<?php echo base_url("admin/message/history");?>">Message History</a>
					</li>
					<?php } ?>
					
				</ul>
			</li>
			<?php }  ?>

			<?php 
			$setting_sub1 = '';
			$setting_sub2 = '';
			$setting_li   = '';
			if($fetch_class=='setting' || $param2=='setting'){
				$setting_sub1 = "style='display:block'";
				$setting_li = "active open";				
				$setting_sub2 = "style='display:block'";
			};
			?>

			<?php if( $this->master->isPermission('settings') ){?>
			<li class="<?php echo $setting_li;?>">
				<a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent">System Settings</span></a>
				<ul <?php echo $setting_sub1;?>>							
					<li>
						<a href="<?php echo base_url("admin/setting");?>">Settings</a>
					</li>
				</ul>
			</li>
			<?php } ?>

			
			
		</ul>
	</nav>
	<span class="minifyme" data-action="minifyMenu"> 
		<i class="fa fa-arrow-circle-left hit"></i> 
	</span>

</aside>
<!-- END NAVIGATION -->