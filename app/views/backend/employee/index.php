
    <div class="col-sm-9 desc">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Full Name:</label> <?php echo $data->full_name;?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email:</label> <?php echo $data->email;?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Mobile:</label> <?php echo $data->mobile;?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Home Phone:</label> <?php echo $data->home_phone;?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Gender: </label> <?php echo ucfirst($data->gender);?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Marital Status: </label> <?php echo ucfirst($data->marital_status);?> 
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Joining Date:</label> <?php echo $data->joining_date;?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Job Title:</label> <?php echo $data->job_title;?>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Basic Salary: </label> <b><?php echo $data->basic_salary; echo ' '.$settings['currency'];?></b>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>House Rent: </label> <b><?php echo $data->house_rent; echo ' '.$settings['currency'];?></b>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Medical Allownce:</label> <b><?php echo $data->medical_allownce; echo ' '.$settings['currency'];?> </b>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Others Allownce:</label> <b><?php echo $data->other_allownce; echo ' '.$settings['currency'];?></b>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Gross Total Salary:</label> <b><?php echo ($data->basic_salary + $data->house_rent + $data->medical_allownce + $data->other_allownce); echo ' '.$settings['currency'];?></b>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Address:</label> <?php echo $data->address;?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Qualification:</label> <?php echo $data->qualification;?>
                </div>
            </div>
        </div>


        

    </div>
    <div id="widget-grid" class="col-sm-3">       

        <div class="section">
            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Profile Image</h2>
                </header>
                <div class="widget-body section_content">

                    <?php $media = $this->master->get_image($data->media_id,"employee"); ?>
                    <p><?php echo $media->name;?></p>
                    <p>
                        <input type="hidden" name="media_id" id="media_id" value="<?php echo $data->media_id;?>">
                        <img id="reader_image" src="<?php echo $media->src;?>" width="100%" height="100"/>
                    </p>
                </div>
            </div>
        
        </div>

    </div>


    <div class="form-group">
        <a href="<?php echo base_url($admin_path);?>/common/get_all/<?php echo $action;?>"><input type="button" class="btn btn-danger pull-left" style="width: 49% " value="Back"></a>
    </div>
<style type="text/css">
    .desc label { font-weight: bold; }
</style>