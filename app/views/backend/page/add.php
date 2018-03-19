<form name="form" method="post" action="<?php echo base_url($admin_path);?>/save/page">
    <div class="form-group">
        <input type="text" name="title" placeholder="Enter page title"  class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="slug" placeholder="Enter page slug" class="form-control">
    </div>
    <div class="form-group">
        <select type="text" name="parent_id" class="form-control">
            <option value="0">Parent</option>
            <?php $pages = $this->master->get_all($this->master->page_table);
            foreach ($pages as $key => $obj) {
                echo "<option value='{$obj->id}'>{$obj->title}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
            <input checked="true" type="radio" name="status" value="1"> Enable  
            <input type="radio" name="status" value="0">  Disable
    </div>
    <div class="form-group">
            <input type="text" name="order_id" placeholder="Enter order" class="form-control" />
    </div>
    <div class="form-group">
        <textarea name="content" id="ck_editor" cols="30" rows="15" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Save">
    </div>
</form>
<script type="text/javascript">     
    $(document).ready(function() {
        CKEDITOR.replace( 'ck_editor', { 
            height: '200px', 
            startupFocus : true,
            "filebrowserImageUploadUrl": "<?php echo base_url();?>assets/_back/js/plugin/ckeditor/plugins/imgupload.php"
        });
    });
</script>