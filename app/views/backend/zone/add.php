<form name="form" method="post" action="<?php echo base_url($admin_path);?>/common/save/<?php echo $action;?>">
    <div class="form-group">
        <input type="text" name="title" placeholder="Enter title"  class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="slug" placeholder="Enter slug" class="form-control">
    </div>

    <div class="form-group">
        <input checked="true" type="radio" name="status" value="1"> Enable  
        <input type="radio" name="status" value="0">  Disable
    </div>
    <div class="form-group">
        <input type="text" name="order_id" placeholder="Enter order" class="form-control" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Save">
    </div>
</form>