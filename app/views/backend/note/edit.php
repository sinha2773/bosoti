<form name="form" method="post" action="<?php echo base_url($admin_path)?>/common/update/<?php echo $action;?>">
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $data->id;?>">
        <input type="text" name="title" placeholder="Enter page title" value="<?php echo $data->title;?>" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="note_type" placeholder="Enter note type" class="form-control" value="<?php echo $data->note_type;?>">
    </div>

    <div class="form-group">
        <textarea style="min-height: 400px;" class="form-control" name="description"><?php echo $data->description;?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Update">
    </div>
</form>