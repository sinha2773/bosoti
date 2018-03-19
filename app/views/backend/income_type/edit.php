<form name="form" method="post" action="<?php echo base_url($admin_path)?>/common/update/<?php echo $action;?>">
    <div class="form-group">
        <label>Category Name</label>
        <input type="hidden" name="id" value="<?php echo $data->id;?>">
        <input type="text" name="title" placeholder="Enter title" value="<?php echo $data->title;?>" class="form-control" required>
    </div>
    <div class="form-group hide">
        <input type="text" name="slug" placeholder="Enter slug" value="<?php echo $data->slug;?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Main Category/Parent Category</label>
        <?php $all_incomes = $this->master->get_all('tbl_expense_types', array('output'=>'result_array')); 
        $all_incomes = $this->master->buildTree($all_incomes, 'parent_id', 'id');?>
        <select name="parent_id" class="form-control">
            <option value="0">Main Category</option>
            <?php treeOption($all_incomes, $data->parent_id);?>
        </select>
    </div>
    
    <div class="form-group">
        <input <?php echo $data->status == 1 ? "checked" : "";?> type="radio" name="status" value="1"> Enable  
        <input <?php echo $data->status == 0 ? "checked" : "";?> type="radio" name="status" value="0">  Disable
    </div>
    <div class="form-group">
            <input type="text" value="<?php echo $data->order_id;?>" name="order_id" placeholder="Enter order" class="form-control" />
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Update">
    </div>
</form>