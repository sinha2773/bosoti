<form name="news_form" id="news_form" method="post" action="<?php echo base_url($admin_path);?>/update/gallery" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
    <div class="col-md-9">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-9">
                            <input type="text" value="<?php echo isset($data) ? $data->title : ''; ?>" id="title" name="title" placeholder="Enter title"  class="form-control">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-control">
                                <option <?php echo (isset($data) && $data->status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                <option <?php echo (isset($data) && $data->status == 0) ? 'selected' : ''; ?> value="0">In active</option>
                            </select>
                        </div> 
                    </div>                    
                </div>
                
            </div>
            <div class="col-sm-12 col-md-12 ">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-9">
                            <input type="text" value="<?php echo isset($data) ? $data->permalink : ''; ?>" name="permalink" placeholder="Enter link" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <select name="gallery_type" class="form-control">
                                <option <?php echo (isset($data) && $data->gallery_type == "image") ? 'selected' : ''; ?> value="image">Image Gallery</option>
                                <option <?php echo (isset($data) && $data->gallery_type == "video") ? 'selected' : ''; ?> value="video">Video Gallery</option>
                            </select>
                        </div>                        
                    </div>                    
                </div>
            </div>
            <div class="col-sm-12 col-md-12 ">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-9">
                            <input type="text" value="<?php echo $data->video_id; ?>" name="video_id" placeholder="Enter youtube video ID" class="form-control" />
                        </div>
                        <div class="col-md-3">
                            <input type="text" value="<?php echo $data->order_id; ?>" name="order_id" placeholder="Enter order" class="form-control" />
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" style="width: 100% " value="Save">
                </div>
            </div>
        </div>
    </div>

    <div id="widget-grid" class="col-md-3">

        <div class="section">
            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Image</h2>
                </header>
                <div class="widget-body section_content">
                    <p>
                        <input type="file" style="width:80px; margin-right:5px;float:left;padding:0;border:0; height:32px; " name="image" accept="image/*" onchange="read_image(event, this.value)"/>
                        <?php $atts = array('width'=> '880','height'=> '450','scrollbars' => 'yes','status' => 'no','resizable' => 'yes','screenx' => '50','screeny' => '10');?>
                        <?php echo anchor_popup($admin_path.'media/', '<button type="button" class="btn btn-sm btn-danger">Browse Media</button>', $atts);?>
                    </p>
                    <?php $media = $this->master->get_image($data->media_id,"gallery"); ?>
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