<style type="text/css">
	.tree_items ul { list-style: none; margin:0; padding: 0; }
	.tree_items ul li { display: block; padding: 3px 5px; background: #ddd; border: 1px solid #dcdcdc; margin:2px 0; }
	.tree_items ul li.active { background: #F1DA91; }
	.tree_items ul li span { float: right; }
	.tree_items ul ul { margin-left: 50px; }

</style>
<script type="text/javascript">
	function fn_edit(id){
		window.location.href = "<?php echo base_url($admin_path)?>/menu/edit/<?php echo $menu_id;?>/"+id;
	}
	function fn_delete(id){
		if(confirm("Are you sure to Delete?")){
			window.location.href = "<?php echo base_url($admin_path)?>/menu/delete/<?php echo $menu_id;?>/"+id;
		}
	}
	function changePage(){
		$("#title").val($("#page_id option:selected").text());
		$("#slug").val($("#page_id option:selected").attr("slug"));
	}
</script>

<div id="widget-grid" class="row">
	<div class="col-md-5">
		<div class="section">
            <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Pages</h2>
                </header>
                <div class="widget-body section_content">
                    <form name="form" method="post" action="<?php echo base_url($admin_path)?>/menu/<?php echo isset($data)? 'update' : 'save';?>">
                    	<input type="hidden" name="menu_id" value="<?php echo $menu_id;?>">
                    	<?php if(isset($data)){ ?>
                    		<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
                    	<?php } ?>
					    <div class="form-group">
					        <input type="text" id="title" name="title" placeholder="Enter page name" value="<?php echo isset($data) ? $data->title : '';?>" class="form-control">
					    </div>
					    <div class="form-group">
					        <input type="text" id="slug" name="slug" placeholder="Enter page slug" value="<?php echo isset($data) ? $data->slug : '';?>" class="form-control">
					    </div>

					    <div class="form-group">
					        <select onchange="changePage(this)" type="text" id="page_id" name="page_id" class="form-control" required>
					            <option value="">Select Page</option>
					            <?php 
					            foreach ($pages as $key => $obj) {
					            	$selected = (isset($data) && $data->page_id == $obj->id) ? 'selected' : '';
					                echo "<option {$selected} slug='{$obj->slug}' value='{$obj->id}'>{$obj->title}</option>";
					            }
					            ?>
					        </select>
					    </div>

					    <div class="form-group">
					        <select type="text" name="parent_id" class="form-control">
					            <option value="0">Parent</option>
					            <?php 
					            foreach ($parent_pages as $key => $obj) {
					            	$selected = (isset($data) && $data->parent_id == $obj->id) ? 'selected' : '';
					                echo "<option {$selected} value='{$obj->id}'>{$obj->title}</option>";
					            }
					            ?>
					        </select>
					    </div>
					    <div class="form-group">
					        <input type="text" id="order_id" name="order_id" placeholder="Enter page order" value="<?php echo isset($data) ? $data->order_id : '';?>" class="form-control">
					    </div>
					    <div class="form-group">					    	
					    	<select type="text" name="status" class="form-control">
					    		<option <?php echo (isset($data) && $data->status == 1) ? 'selected' : '';?> value="1">Active</option>
					    		<option <?php echo (isset($data) && $data->status == 0) ? 'selected' : '';?> value="0">In active</option>
					    	</select>
					    </div>

					    <div class="form-group">
					        <input type="submit" class="btn btn-primary" style="width: 100% " value="Update">
					    </div>
					</form>
                </div>
            </div>
        </div>

	</div>
	<div class="col-md-7">
		<div class="section">
            <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Assigned Pages</h2>
                </header>
                <div class="widget-body section_content">
                    <div id='selected_pages_container' class="tree_items">
	                    <?php 
	                    if(!empty($assigned_pages))
	                    	createTree($assigned_pages);
	                    else 
	                    	echo "No any assigned pages yet"; 
	                    ?>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
