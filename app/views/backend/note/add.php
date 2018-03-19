<form name="form" method="post" action="<?php echo base_url($admin_path);?>/common/save/<?php echo $action;?>">
    <div class="form-group">
        <input type="text" name="title" placeholder="Enter title"  class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="note_type" placeholder="Enter note type" class="form-control">
    </div>

    <div class="form-group">
        <textarea style="min-height: 400px;" class="form-control" name="description"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Save">
    </div>
</form>