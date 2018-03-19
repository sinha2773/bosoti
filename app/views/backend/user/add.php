<form name="user_form" id="user_form" method="post" action="<?php echo base_url($admin_path);?>/user/save_user" enctype="multipart/form-data">
    
    <div class="col-md-9">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="fname" name="fname" value="<?php echo set_value('fname'); ?>" placeholder="Enter first name"  class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="surname" id="surname" value="<?php echo set_value('surname'); ?>" placeholder="Enter surname"  class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter email"  class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="mobile" id="mobile" value="<?php echo set_value('mobile'); ?>" placeholder="Enter mobile"  class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <select id="user_role_id" name="user_role_id" class="form-control">
                                <?php 
                                if( !empty($user_roles) )
                                foreach($user_roles as $ur){ ?>
                                    <option <?php echo set_select('user_role_id', $ur->user_role_id); ?> value="<?php echo $ur->user_role_id;?>"><?php echo $ur->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id="gender" name="gender" class="form-control">
                                <option <?php echo set_select('gender', 'male', TRUE); ?> value="male">Male</option>
                                <option <?php echo set_select('gender', 'female'); ?> value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id="status" name="status" class="form-control">
                                <option <?php echo set_select('status', '1', TRUE); ?> value="1">Active</option>
                                <option <?php echo set_select('status', '0'); ?> value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Enter username"  class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" placeholder="Enter password"  class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="re_password" id="re_password" value="<?php echo set_value('re_password'); ?>" placeholder="Enter re-password"  class="form-control">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" style="width: 100% " value="Add">
                </div>
            </div>
        </div>
    </div>

    <div id="widget-grid" class="col-md-3">       

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
</form>