
    <ul class="nav nav-pills nav-justified">
      <?php foreach($job_types as $key => $data){ ?>
      <li class="active"><a target="_blank" href="<?php echo base_url('page/jobList');?>?jobType=<?php echo $data->slug?>"><?php echo $data->title;?></a></li>
      <?php } ?>
    </ul>
