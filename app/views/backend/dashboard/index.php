
<div class="quick_report">
	<div class="panel panel-ingo">
		<div class="panel-heading">
			<span style="font-size: 20px">Quick Report</span>
		</div>
		<div class="panel-body">
			Year: 
			<select name="year" id="year">
				<option>2017</option>
				<option>2018</option>
				<option>2019</option>
			</select>
			<table class="table">
				<?php 
				for($i=1; $i<=33; $i++)
				{
				?>
				<tr>
					<td>
						<?php 
						if($i==1)
						{
							// nothing
						}
						elseif($i==33)
						{
							echo 'Total';
						}
						else
						{
							echo $i-1;
						}
						?>			
					</td>
					<td>January</td>
					<td>February</td>
					<td>March</td>
					<td>April</td>
					<td>May</td>
					<td>June</td>
					<td>July</td>
					<td>August</td>
					<td>September</td>
					<td>October</td>
					<td>November</td>
					<td>December</td>
					<td>Total</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>