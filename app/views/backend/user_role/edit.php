<form name="form" method="post" action="<?php echo base_url($admin_path);?>/user/update_user_role">
    <input type="hidden" name="id" value="<?php echo $data->user_role_id;?>">
    <div class="form-group">
        <input type="text" name="name" placeholder="Enter name" value="<?php echo $data->name;?>"  class="form-control" required>
    </div>
    <?php 
    $select_permission = unserialize($data->permission);
    ?>
    <div class="col-sm-6">
        <div class="form-group">
            <label style="font-weight: bold; margin-bottom: 5px; font-size: 16px;"><input type="checkbox" class="access_all"> Access</label>
            <?php foreach($permissions as $name){?>
            <?php $selected = ( in_array($name, $select_permission['access']) ) ? 'checked' : '';?>
            <div><input <?php echo $selected;?> class="permission_access" type="checkbox" name="permission_access[]" value="<?php echo $name;?>"> <?php echo $name;?></div>
            <?php } ?>
        </div>
    </div>

    <div class="col-sm-6 hide">
        <div class="form-group">
            <label style="font-weight: bold; margin-bottom: 5px; font-size: 16px;"><input type="checkbox" class="modify_all"> Modify</label>
            <?php foreach($permissions as $name){?>
            <?php $selected = ( in_array($name, $select_permission['modify']) ) ? 'checked' : '';?>
            <div><input <?php echo $selected;?> class="permission_modify" type="checkbox" name="permission_modify[]" value="<?php echo $name;?>"> <?php echo $name;?></div>
            <?php } ?>
        </div>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Update">
    </div>
</form>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('.access_all').click(function(){
            if( $(this).is(':checked') ){
                $('.permission_access').each(function(value, key){
                    $(this).prop('checked', true);
                });
            }else{
                $('.permission_access').each(function(value, key){
                    $(this).prop('checked', false);
                });
            }
        });

        $('.modify_all').click(function(){
            if( $(this).is(':checked') ){
                $('.permission_modify').each(function(value, key){
                    $(this).prop('checked', true);
                });
            }else{
                $('.permission_modify').each(function(value, key){
                    $(this).prop('checked', false);
                });
            }
        });
    });
</script>