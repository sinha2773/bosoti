<form name="form" method="post" action="<?php echo base_url($admin_path);?>/save/page">
    <div class="form-group">
        <input type="text" name="title" placeholder="Enter Page Name"  class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="slug" placeholder="Enter Page Url" class="form-control" required>
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
        <input checked="true" type="radio" name="status" value="1"> Active  
        <input type="radio" name="status" value="0">  In active
    </div>
    <div class="form-group hide">
        <textarea name="content" id="ck_editor" cols="30" rows="15" class="bangla"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Save">
    </div>
</form>