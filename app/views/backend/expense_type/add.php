<form name="form" method="post" action="<?php echo base_url($admin_path);?>/common/save/<?php echo $action;?>">
    <div class="form-group">
        <label>Category Name</label>
        <input type="text" name="title" placeholder="Enter title"  class="form-control" required>
    </div>
    <div class="form-group hide">
        <input type="text" name="slug" placeholder="Enter slug" class="form-control">
    </div>

    <div class="form-group">
        <label>Main Category/Parent Category</label>
        <?php $all_expenses = $this->master->get_all('tbl_expense_types', array('output'=>'result_array')); 
        $all_expenses = $this->master->buildTree($all_expenses, 'parent_id', 'id');?>
        <select name="parent_id" class="form-control">
            <option value="0">Main Category</option>
            <?php treeOption($all_expenses);?>
            <?php /* foreach($all_expenses as $obj){ ?>
            <option value="<?php echo $obj->id;?>"><?php echo $obj->parent_id>0?'--':'';?><?php echo $obj->title;?></option>
            <?php } */?>
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
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Save">
    </div>
</form>