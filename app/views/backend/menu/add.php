<form name="form" method="post" action="<?php echo base_url($admin_path);?>/save/menu">
    <div class="form-group">
        <input type="text" name="title" placeholder="Enter Page Name"  class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="slug" placeholder="Enter Page Url" class="form-control" required>
    </div>
    <div class="form-group">
        <input checked="true" type="radio" name="status" value="1"> Active  
        <input type="radio" name="status" value="0">  In active
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Save">
    </div>
</form>