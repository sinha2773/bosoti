<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- PAGE FOOTER -->
		<div class="page-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="txt-color-white">Coded by <a href="http://sinhabd.com">sinhabd.com</a></span>
				</div>
				<div class="col-xs-12 col-sm-6 text-right">
					<span class="txt-color-white"> <?php echo isset($settings['app_title'])?$settings['app_title']:'Cable Network App';?> © <?php echo date('Y');?></span>
				</div>
			</div>
		</div>
		<!-- END PAGE FOOTER -->


		<!--================================================== -->
		<?php $base_url = base_url()."assets/_back/";?>
		

		<!-- IMPORTANT: APP CONFIG -->
		<script src="<?php echo $base_url;?>js/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="<?php echo $base_url;?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo $base_url;?>js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?php echo $base_url;?>js/notification/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?php echo $base_url;?>js/smartwidgets/jarvis.widget.min.js"></script>

		<!-- SPARKLINES -->
		<script src="<?php echo $base_url;?>js/plugin/sparkline/jquery.sparkline.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="<?php echo $base_url;?>js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

		<!-- FastClick: For mobile devices -->
		<script src="<?php echo $base_url;?>js/plugin/fastclick/fastclick.min.js"></script>

		<!-- FastClick: For mobile devices -->
		<script src="<?php echo $base_url;?>js/plugin/fastclick/fastclick.min.js"></script>

		<!--[if IE 8]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<!-- Demo purpose only -->
		<script src="<?php echo $base_url;?>js/demo.min.js"></script>

		<!-- MAIN APP JS FILE -->
		<script src="<?php echo $base_url;?>js/app.min.js"></script>

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
		<!-- <script src="js/speech/voicecommand.min.js"></script> -->
		
		<!-- PAGE RELATED PLUGIN(S) -->
		
		<script src="<?php echo $base_url;?>js/plugin/delete-table-row/delete-table-row.min.js"></script>
		
		<script src="<?php echo $base_url;?>js/plugin/summernote/summernote.min.js"></script>
		
		<script src="<?php echo $base_url;?>js/plugin/select2/select2.min.js"></script>

		

		<!-- JARVIS WIDGETS -->
		<script src="<?php echo $base_url;?>js/smartwidgets/jarvis.widget.min.js"></script>

		


		<script src="<?php echo $base_url;?>js/custom.js"></script>

		

		<script type="text/javascript">
		
		$(document).ready(function() {
		
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			pageSetUp();
		
			// PAGE RELATED SCRIPTS

			$('#title_color').colorpicker({ format: "hex" });
		    $('#sub_title_color').colorpicker({ format: "hex" });
			
			/*
			 * Fixed table height
			 */
			
			//tableHeightSize()
			
			$(window).resize(function() {
				//tableHeightSize()
			})
			
			function tableHeightSize() {
	
				if ($('body').hasClass('menu-on-top')) {
					var menuHeight = 68;
					// nav height
	
					var tableHeight = ($(window).height() - 224) - menuHeight;
					if (tableHeight < (320 - menuHeight)) {
						$('.table-wrap').css('height', (320 - menuHeight) + 'px');
					} else {
						$('.table-wrap').css('height', tableHeight + 'px');
					}
	
				} else {
					var tableHeight = $(window).height() - 224;
					if (tableHeight < 320) {
						$('.table-wrap').css('height', 320 + 'px');
					} else {
						$('.table-wrap').css('height', tableHeight + 'px');
					}
	
				}
	
			}
			
		
		});	
			
		
		</script>

	</body>

</html>