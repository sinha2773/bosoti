<form name="form" method="post" action="<?php echo base_url($admin_path)?>/update/page">
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $lists[0]->id;?>">
        <input type="text" name="title" placeholder="Enter Page Name" value="<?php echo $lists[0]->title;?>" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="slug" placeholder="Enter Page Url" value="<?php echo $lists[0]->slug;?>" class="form-control" required>
    </div>
    <div class="form-group">
        <select type="text" name="parent_id" class="form-control">
            <option value="0">Parent</option>
            <?php $pages = $this->master->get_all($this->master->page_table);
            foreach ($pages as $key => $obj) {
                $selected = $obj->id == $lists[0]->parent_id ? "selected" : "";
                echo "<option {$selected} value='{$obj->id}'>{$obj->title}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input <?php echo $lists[0]->status == 1 ? "checked" : "";?> type="radio" name="status" value="1"> Active  
        <input <?php echo $lists[0]->status == 0 ? "checked" : "";?> type="radio" name="status" value="0">  In active
    </div>
    <div class="form-group hide">
        <textarea name="content" id="ck_editor" cols="30" rows="15" ><?php echo $lists[0]->content;?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Update">
    </div>
</form>