<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo $header; ?>

<?php echo $menu; ?>

<!-- MAIN PANEL -->
<div id="main" role="main">

	<!-- RIBBON -->
	<div id="ribbon">

		<span class="ribbon-button-alignment"> 
			<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
				<i class="fa fa-refresh"></i>
			</span> 
		</span>

		<!-- breadcrumb -->
		<ol class="breadcrumb">
			<li>Home</li><li><?php echo $breadcrumb; ?></li>
		</ol>
		<!-- end breadcrumb -->

	</div>
	<!-- END RIBBON -->

	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="msg_box">
			<?php
		    // Custom form submission message will be populated here
		    if ($this->session->flashdata('flashMessage') == TRUE):
		        $msgArray = $this->session->flashdata('flashMessage');
		        ?>
		        <div class="alert alert-<?php echo $msgArray[0]; ?>">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		            <?php echo $msgArray[1]; ?>
		        </div>
		        <?php
		    endif;

		    // Custom form submission message end here
		    if (validation_errors() != false) { // Codeigniter form validation errors will be populated here
		        echo "<div class='alert alert-danger'>";
		        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		        echo validation_errors();
		        echo "</div>";
		    }// Codeigniter form validation errors end here
		    ?>
		</div>

		<?php echo $content;?>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->
<?php echo $footer;?>