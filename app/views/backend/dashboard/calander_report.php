<table class="table">
  <?php 
  for($i=0; $i<=32; $i++)
  {
  ?>
  <tr>
    <td>
      <?php 
      if($i==0)
      {
        // nothing
      }
      elseif($i==32)
      {
        echo 'Monthly Total';
      }
      else
      {
        echo $i;
      }
      ?>      
    </td>
  <?php
  if($i==0)
  {
  ?>
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
        <!-- <td>Total</td> -->
    <?php
  }
  elseif($i==32)
  {
      for($mon=1; $mon<=12; $mon++)
      {?>
          <td><?php echo isset($dashboard_report['monthly_total'][$mon]) ? $dashboard_report['monthly_total'][$mon] : 0;?></td>
      <?php 
      } 
  }
  else
  {
      for($mon=1; $mon<=12; $mon++)
      {?>
          <td>
            <?php 
            $key = $i.'_'.$mon; 
            echo isset($dashboard_report['calander'][$key]) ? $dashboard_report['calander'][$key] : 0;
            ?>                    
          </td>
      <?php 
      } 
  }
  ?>          
  </tr>
  <?php } ?>
  <tr>
    <td>Yearly Total</td>
    <td colspan="12"><?php echo $this->payment_model->currencyFormat($dashboard_report['total']);?></td>
  </tr>
</table>