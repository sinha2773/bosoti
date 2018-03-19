<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php 
$is_job_availale = false;
foreach($jobList as $job): 
	if($job->job_nature_id==$job_nature || $job_nature=='all'){
	$is_job_availale = true;
?>
	<div class="recent-job-list"><!-- Tabs content -->
		<div class="col-md-1 job-list-logo">
			<img src="<?php echo image_src('employer','thumb', $job->company_image);?>" class="img-responsive" alt="Logo" />
		</div>

		<div class="col-md-6 job-list-desc">
			<h6><?php echo $job->company;?></h6>
			<h5><?php echo $job->title;?></h5>
			<div class="row"><label class='col-sm-4 col-md-3'>Education:</label><div class="col-sm-8 col-md-9 pl"> <?php echo $job->education_requirement;?></div></div>
			<div class="row"><label class='col-sm-4 col-md-3'>Experience:</label><div class="col-sm-8 col-md-9 pl">At least <?php echo $job->experience_min;?> year(s)</div></div>
		</div>
		<div class="col-md-2 job-list-location">
			<h6><i class="fa fa-map-marker"></i><?php echo $job->job_location;?></h6>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-7 job-list-type">
					<h6><i class="fa fa-user"></i><?php echo $job->job_nature;?></h6>
				</div>
				<div class="col-md-5 job-list-button">
					<a href="<?php echo base_url("page/jobDetails/{$job->id}");?>"><button class="btn-view-job" >View Job</button></a>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div><!-- Tabs content -->

<?php  
	}
endforeach; 
if(!$is_job_availale){
	echo '<div class="alert alert-info">Sorry, No available any job for this criteria</div>';
}
?>