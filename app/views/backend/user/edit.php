<?php //print_r($data);?>
<form name="news_form" id="news_form" method="post" action="<?php echo base_url($admin_path);?>/user/update_user" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data->id;?>">
    <div class="col-md-9">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="fname" name="fname" value="<?php echo $data->name; ?>" placeholder="Enter first name"  class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="surname" id="surname" value="<?php echo $data->surname; ?>" placeholder="Enter surname"  class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="email" name="email" value="<?php echo $data->email; ?>" placeholder="Enter email"  class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="mobile" id="mobile" value="<?php echo $data->mobile; ?>" placeholder="Enter mobile"  class="form-control">
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
                                    <option <?php echo $data->user_role_id == $ur->user_role_id ? 'selected' : ''; ?> value="<?php echo $ur->user_role_id;?>"><?php echo $ur->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id="gender" name="gender" class="form-control">
                                <option <?php echo $data->gender=="male" ? "selected" : ""; ?> value="male">Male</option>
                                <option <?php echo $data->gender=="female" ? "selected" : ""; ?> value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id="status" name="status" class="form-control">
                                <option <?php echo $data->status=="1" ? "selected" : ""; ?> value="1">Active</option>
                                <option <?php echo $data->status=="0" ? "selected" : ""; ?> value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" id="username" name="username" value="<?php echo $data->username; ?>" placeholder="Enter username"  class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="password" id="password" value="" placeholder="Enter password"  class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="re_password" id="re_password" value="" placeholder="Enter re-password"  class="form-control">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" style="width: 100% " value="Update">
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
                    <?php $media = $this->master->get_image($data->media_id,"user"); ?>
                    <p><input type="text" value="<?php echo $media->name;?>" id="image_name" name="image_name" class="form-control" placeholder="Enter image name"></p>
                    <p>
                        <input type="hidden" name="media_id" id="media_id" value="<?php echo $data->media_id;?>">
                        <img id="reader_image" src="<?php echo $media->src;?>" width="100%" height="100"/>
                    </p>
                </div>
            </div>
        
        </div>

    </div>
</form>