<style type="text/css">
.img_box{ width:100px; margin:5px; float:left;}
.img_url { width:100%;}
img{border:1px solid #ddd; float:left; cursor:pointer; border:2px solid #fff; width:100%;}
</style>
<script type="text/javascript">
function setImage(e,id)
{
	window.opener.document.getElementById('image_name').value = e.title;
	window.opener.document.getElementById('media_id').value = id;
	window.opener.document.getElementById('reader_image').src = e.src;
	window.close();
}
</script>

<fieldset style="background:#ddd;">
    <label>
       <form style="margin:0; padding:0" method="post" action="<?php echo base_url("admin/media");?>">
            <input type="text" name="image_name" id="image_name" value="<?php echo isset($_POST['image_name']) ? $_POST['image_name'] : ''; ?>" placeholder="Enter image name">
            <input type="submit" value="Search" />
        </form>
    </label>
</fieldset>

<div id="container" style="background:#FFF;">
	<?php
	foreach($lists as $row)
	{ 
	?>  <div class="img_box">
			<input style="display:none;" class="img_url img_name" onClick="this.select();"  type="text" value="<?php echo $row->name;?>">
        	<img src="<?php echo base_url();?>uploads/<?php echo $row->media_type;?>/thumb/<?php echo $row->image;?>" height="100"  onclick="setImage(this,<?php echo $row->id;?>)" title="<?php echo $row->name;?>" />
			<input class="img_url" onClick="this.select();"  type="text" value="<?php echo base_url();?>uploads/<?php echo $row->media_type;?>/medium/<?php echo $row->image;?>">
		</div>
    <?php
	}
?>



</div>

