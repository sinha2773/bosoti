<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<h4 class="login-title">Log In</h4>
		<div class="row">
			<div class="col-md-5">
				<div class="form-singin-container">
					<form role="form">
						<div class="form-group">
							<input type="email" class="form-control input-form" placeholder="Email">
							<div class="singin-aksen"></div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-form" placeholder="Password">
							<div class="singin-aksen" style="margin-bottom:20px"></div>
							
						</div>
						<div class="form-group" style="color:#fff;">
							<input type="radio" name="loginType" checked value="jobSeeker" class="input-form"> Job Seeker
							<input type="radio" name="loginType" value="employe" class="input-form"> Employer
						</div>
						<div class="form-group">
							<button class="btn btn-default btn-green">LOGIN</button>
						</div>
					</form>
				</div>
			</div>

			<div class="col-md-7 singin-page">
				<h5>Not A Member? Register Now</h5>
				<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum </p>
				<button class="btn btn-default btn-blue">REGISTER</button>
				<div class="row">
					<div class="col-md-6">
						<ul class="style-list-2">
							<li>On the other hand, we denounce with </li>
							<li>Dislike men who are so beguiled and</li>
							<li>Charms of pleasure of the moment</li>
							<li>Duty through weakness of will, which is</li>
						</ul>
					</div>

					<div class="col-md-6">
						<ul class="style-list-2">
							<li>On the other hand, we denounce with </li>
							<li>Dislike men who are so beguiled and</li>
							<li>Charms of pleasure of the moment</li>
							<li>Duty through weakness of will, which is</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- end main page title -->

<div id="page-content"><!-- start content -->
	<div class="content-about">
	<div class="spacer-2">&nbsp;</div>
		<div class="container">
		<?php $this->load->view('helper/register'); ?>
		</div>
		<div class="spacer-2">&nbsp;</div>

		<?php $this->load->view("helper/callus");?>

	</div><!-- end content -->
</div><!-- end page content -->