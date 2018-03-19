<?php 
$per_cols = 10;
?>
<div class="col-md-4 col-lg-4 category-col-1 pl">
    <ul>
      <?php foreach($categories as $key => $data) { if($key < $per_cols){ ?>
        <li>
            <a title="<?php echo $data->title; ?>" href="<?php echo base_url("page/jobList");?>?cat=<?php echo $data->id?>" target="_blank"><i class="fa fa-location-arrow"></i> <?php echo $data->title; ?> <span>(0)</span></a>
        </li>
      <?php }} ?>
    </ul>
</div>

<div class="col-md-4 col-lg-4 category-col-2 m-active pl">
    <ul>
      <?php foreach($categories as $key => $data) { if( $key >= $per_cols && $key < ($per_cols*2)){ ?>
        <li>
            <a title="<?php echo $data->title; ?>" href="<?php echo base_url("page/jobList");?>?cat=<?php echo $data->id?>" target="_blank"><i class="fa fa-location-arrow"></i> <?php echo $data->title; ?> <span>(0)</span></a>
        </li>
      <?php }} ?>
    </ul>
</div>

<div class="col-md-4 col-lg-4 category-col-3 m-active pl pr">
    <ul>
      <?php foreach($categories as $key => $data) { if( $key >= ($per_cols*2)){ ?>
        <li>
            <a title="<?php echo $data->title; ?>" href="<?php echo base_url("page/jobList");?>?cat=<?php echo $data->id?>" target="_blank"><i class="fa fa-location-arrow"></i> <?php echo $data->title; ?> <span>(0)</span></a>
        </li>
      <?php }} ?>
    </ul>
</div>         