<form name="form" method="post" action="<?php echo base_url($admin_path)?>/common/update/<?php echo $action;?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data->id;?>">
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo $data->name;?>" placeholder="Enter name" class="form-control"  required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Mobile number</label>
                    <input type="text" name="mobile" value="<?php echo $data->mobile;?>" placeholder="Enter Mobile number" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Father Name</label>
                    <input type="text" name="fathername" value="<?php echo $data->fathername;?>" placeholder="Enter your Father Name" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Mother Name</label>
                    <input type="text" name="mothername" value="<?php echo $data->mothername;?>" placeholder="Enter your Mother Name" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Husband/Wife Name</label>
                    <input type="text" name="spousename" value="<?php echo $data->spousename;?>" placeholder="Enter your Husband/Wife Name" class="form-control" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="text" name="date_of_birth" value="<?php echo $data->date_of_birth;?>" placeholder="Enter your Date of Birth" class="form-control dateofbirth" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>National ID Card Number</label>
                    <input type="text" name="nid" value="<?php echo $data->nid;?>" placeholder="Enter your National ID Card Number" class="form-control">
                </div>
            </div>
            <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                    <option <?php echo $data->gender=='male'?'selected':'';?> value="male">Male</option>
                    <option <?php echo $data->gender=='female'?'selected':'';?> value="female">Female</option>
                    </select>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Occupation</label>
                    <input type="text" name="occupation" value="<?php echo $data->occupation;?>" placeholder="Enter your occupation" class="form-control" >
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Educational Qualification</label>
                    <input type="text" name="education" value="<?php echo $data->education;?>" placeholder="Enter your Educational Qualification" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Religion</label>
                    <input type="text" name="religion" value="<?php echo $data->religion;?>" placeholder="Enter your Relizon" class="form-control" >
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="nationality" value="<?php echo $data->nationality;?>" placeholder="Enter your nationality" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Member ID</label>
                    <input type="text" readonly value="<?php echo $data->client_id;?>" placeholder="Enter your member No" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Admission Date</label>
                    <input type="text" id="admission_date" name="admission_date" value="<?php echo $data->admission_date;?>" placeholder="Enter your Admission Date" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Blood Group</label>
                    <input type="text" name="blood_group" value="<?php echo $data->blood_group;?>" placeholder="Enter your Blood Group" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Permanent Address</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Village</label>
                    <input type="text" name="village" value="<?php echo $data->village;?>" placeholder="Enter your Village" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Post Office</label>
                    <input type="text" name="post_office" value="<?php echo $data->post_office;?>" placeholder="Enter your Post office" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Police station</label>
                    <input type="text" name="police_station" value="<?php echo $data->police_station;?>" placeholder="Enter your Police station" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District</label>
                    <input type="text" name="district" value="<?php echo $data->district;?>" placeholder="Enter your District" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Present Address</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Village</label>
                    <input type="text" name="p_village" value="<?php echo $data->p_village;?>" placeholder="Enter your Village" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Post Office</label>
                    <input type="text" name="p_post_office" value="<?php echo $data->p_post_office;?>" placeholder="Enter your Post office" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Police station</label>
                    <input type="text" name="p_police_station" value="<?php echo $data->p_police_station;?>" placeholder="Enter your Police station" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District</label>
                    <input type="text" name="p_district" value="<?php echo $data->p_district;?>" placeholder="Enter your District" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Nominee Identity</h3>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="n_name" value="<?php echo $data->n_name;?>" placeholder="Enter Nominee Name" class="form-control" >
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Father Name</label>
                    <input type="text" name="n_fathername" value="<?php echo $data->n_fathername;?>" placeholder="Enter Nominee Father Name" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Mother Name</label>
                    <input type="text" name="n_mothername" value="<?php echo $data->n_mothername;?>" placeholder="Enter Nominee Mother Name" class="form-control" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="text" name="n_date_of_birth" value="<?php echo $data->n_date_of_birth;?>" placeholder="Enter Date of Birth" class="form-control nominee_dateofbirth" >
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label>National ID Card Number</label>
                    <input type="text" name="n_nid" value="<?php echo $data->n_nid;?>" placeholder="Enter National ID Card Number" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Permanent Address</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Village</label>
                    <input type="text" name="n_village" value="<?php echo $data->n_village;?>" placeholder="Enter Village" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Post Office</label>
                    <input type="text" name="n_post_office" value="<?php echo $data->n_post_office;?>" placeholder="Enter Post office" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Police station</label>
                    <input type="text" name="n_police_station" value="<?php echo $data->n_police_station;?>" placeholder="Enter Police station" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District</label>
                    <input type="text" name="n_district" value="<?php echo $data->n_district;?>" placeholder="Enter District" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Present Address</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Village</label>
                    <input type="text" name="np_village" value="<?php echo $data->np_village;?>" placeholder="Enter Village" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Post Office</label>
                    <input type="text" name="np_post_office" value="<?php echo $data->np_post_office;?>" placeholder="Enter Post office" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Police station</label>
                    <input type="text" name="np_police_station" value="<?php echo $data->np_police_station;?>" placeholder="Enter Police station" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District</label>
                    <input type="text" name="np_district" value="<?php echo $data->np_district;?>" placeholder="Enter District" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-sm-12">
                <div class="form-group">
                    <h3>Nominee relationship</h3>
                    <input type="text" name="nominee_relationship" value="<?php echo $data->nominee_relationship;?>" placeholder="Enter Nominee relationship" class="form-control">
                </div>
        </div>

        <div class="form-group">
            <input <?php echo $data->status==1?'checked':'';?> type="radio" name="status" value="1"> Enable  
            <input <?php echo $data->status==0?'checked':'';?> type="radio" name="status" value="0">  Disable
        </div>
    </div>
    <div id="widget-grid" class="col-sm-3">       

        <div class="section">
            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Profile Image</h2>
                </header>
                <div class="widget-body section_content">
                    <p>
                        <input type="file" class="file_upload" name="image" accept="image/*" onchange="read_image(event, this.value)"/>
                        <?php // $atts = array('width'=> '880','height'=> '450','scrollbars' => 'yes','status' => 'no','resizable' => 'yes','screenx' => '50','screeny' => '10');?>
                        <?php //echo anchor_popup($admin_path.'media/', '<button type="button" class="btn btn-sm btn-danger browse_file">Browse Media</button>', $atts);?>
                    </p>
                    <?php $media = $this->master->get_image($data->media_id,"member"); ?>
                    <!-- <p><input type="text" value="<?php echo $media->name;?>" id="image_name" name="image_name" class="form-control" placeholder="Enter image name"></p> -->
                    <p>
                        <input type="hidden" name="media_id" id="media_id" value="<?php echo $data->media_id;?>">
                        <img id="reader_image" src="<?php echo $media->src;?>" height="100"/>
                    </p>
                </div>
            </div>
        
        </div>

    </div>

    <div id="widget-grid" class="col-sm-3">       

        <div class="section">
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Nominee Image</h2>
                </header>
                <div class="widget-body section_content">
                    <p>
                        <input type="file" class="file_upload" name="image2" accept="image/*" onchange="read_image(event, this.value, 'reader_image2')"/>
                        <?php // $atts = array('width'=> '880','height'=> '450','scrollbars' => 'yes','status' => 'no','resizable' => 'yes','screenx' => '50','screeny' => '10');?>
                        <?php //echo anchor_popup($admin_path.'media/', '<button type="button" class="btn btn-sm btn-danger browse_file">Browse Media</button>', $atts);?>
                    </p>
                    <?php $media = $this->master->get_image($data->media_id2,"member"); ?>
                    <p><!-- <input type="text" value="<?php echo $media->name;?>" id="image_name2" name="image_name2" class="form-control" placeholder="Enter image name"> --></p>
                    <p>
                        <input type="hidden" name="media_id2" id="media_id2" value="<?php echo $data->media_id2;?>">
                        <img id="reader_image2" src="<?php echo $media->src;?>" height="100"/>
                    </p>
                </div>
            </div>
        
        </div>

    </div>


    <div class="form-group text-center" style="width: 100%; float: left;">
        <a href="<?php echo base_url($admin_path);?>/common/get_all/<?php echo $action;?>"><input type="button" class="btn btn-danger btn-lg"  value="Cancel"></a>
        <input type="submit" class="btn btn-primary btn-lg" value="Update">
    </div>
</form>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#admission_date, .dateofbirth, .nominee_dateofbirth').datepicker({
            dateFormat: 'yy-mm-dd', 
            changeMonth: true,
            changeYear: true,
        });
    });
</script>