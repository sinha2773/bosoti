<form name="form" method="post" action="<?php echo base_url($admin_path)?>/common/update/<?php echo $action;?>">
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $data->id;?>">
        <label>Package Name</label>
        <input type="text" name="title" placeholder="Enter Package Name"  class="form-control" value="<?php echo $data->title;?>" required>
        <input type="hidden" name="slug">
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label>Price</label>
            <input value="<?php echo $data->price;?>" onkeyup="vatCalculate()" id="price" type="number" step="any" name="price" placeholder="Enter Package Price"  class="form-control" required>
        </div>
        <div class="col-sm-4">
            <label>Vat(%)</label>
            <input value="<?php echo $data->vat;?>" onkeyup="vatCalculate()" id="vat" type="number" name="vat" placeholder="Enter Package Vat (ex: 15)"  class="form-control" required>
        </div>
        <div class="col-sm-4">
            <label>Total</label>
            <input value="<?php echo $data->total;?>" id="total" type="number" step="any" name="total" placeholder="Enter Price Total"  class="form-control" required>
        </div>
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
<script type="text/javascript">
    function vatCalculate(){
        var price = $('#price').val();
        var vat = $('#vat').val();
        var total = parseFloat(price) + parseFloat((price * vat)/100);
        if(total>0)
            $('#total').val(total);
        else
            $('#total').val('');
    }
</script>