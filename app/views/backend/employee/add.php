<form name="form" method="post" action="<?php echo base_url($admin_path);?>/common/save/<?php echo $action;?>" enctype="multipart/form-data">
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter name" class="form-control"  required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="Email" name="email" placeholder="Enter email" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" placeholder="Enter mobile" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Home Phone</label>
                    <input type="text" name="home_phone" placeholder="Enter home phobe" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Marital Status</label>
                    <select name="marital_status" class="form-control">
                    <option value="married">Married</option>
                    <option value="unmarried">Unmarried</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Joining Date</label>
                    <input type="text" name="joining_date" id="joining_date" placeholder="Enter joining date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" name="job_title" placeholder="Enter job title" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Basic Salary</label>
                    <input type="number" name="basic_salary" step="any" placeholder="Enter basic salary" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>House Rent</label>
                    <input type="number" name="house_rent" step="any" placeholder="Enter house rent" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Medical Allownce</label>
                    <input type="number"  name="medical_allownce" step="any" placeholder="Enter madical allownce" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Others Allownce</label>
                    <input type="number"  name="other_allownce" step="any" placeholder="Enter others allownce" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="address" required></textarea>
        </div>

        <div class="form-group">
            <label>Qualification</label>
            <textarea class="form-control" name="qualification" required></textarea>
        </div>

        <div class="form-group">
            <input checked="true" type="radio" name="status" value="1"> Enable  
            <input type="radio" name="status" value="0">  Disable
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
                        <?php $atts = array('width'=> '880','height'=> '450','scrollbars' => 'yes','status' => 'no','resizable' => 'yes','screenx' => '50','screeny' => '10');?>
                        <?php echo anchor_popup($admin_path.'media/', '<button type="button" class="btn btn-sm btn-danger browse_file">Browse Media</button>', $atts);?>
                    </p>
                    <p><input type="text" value="" id="image_name" name="image_name" class="form-control" placeholder="Enter image name"></p>
                    <p>
                        <input type="hidden" name="media_id" id="media_id" value="">
                        <img id="reader_image" width="100%" height="100"/>
                    </p>
                </div>
            </div>
        
        </div>

    </div>

    <div class="form-group">
        <a href="<?php echo base_url($admin_path);?>/common/get_all/<?php echo $action;?>"><input type="button" class="btn btn-danger pull-left" style="width: 49% " value="Cancel"></a>
        <input type="submit" class="btn btn-primary pull-right" style="width: 50% " value="Save">
    </div>
</form>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#joining_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>