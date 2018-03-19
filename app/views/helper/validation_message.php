<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="validation_error_message">
    <div class="container">
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
    </div>
</div>