<form name="form" method="post" action="<?php echo base_url($admin_path)?>/update/menu">
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $data->id;?>">
        <input type="text" name="title" placeholder="Enter Page Name" value="<?php echo $data->title;?>" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="slug" placeholder="Enter Page Url" value="<?php echo $data->slug;?>" class="form-control" required>
    </div>

    <div class="form-group">
        <input <?php echo $data->status == 1 ? "checked" : "";?> type="radio" name="status" value="1"> Active  
        <input <?php echo $data->status == 0 ? "checked" : "";?> type="radio" name="status" value="0">  In active
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Update">
    </div>
</form>